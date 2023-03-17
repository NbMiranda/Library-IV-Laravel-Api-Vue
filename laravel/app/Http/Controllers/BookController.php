<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected $book;

    public function __construct(Book $book) {
        $this->book = $book;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return $this->book->all();
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validating
        $request->validate($this->book->rules(), $this->book->feedback());
        
        // Save img on storage > app > public > imagens
        $imagem = $request->file('book_cover');

        if ($imagem) {
            $imagem_urn = $imagem->store('images', 'public');
        }
        else {
            $imagem_urn = "imagemPadrao.png";
        }
        
        // create book
        $book = $this->book->create([
            'book_name' => $request->book_name,
            'genre' => $request->genre,
            'writer_id' => $request->writer_id,
            'book_cover' => $imagem_urn
        ]);
        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->with('writer')->find($id);
        if ($book) {
            return $book;
        } else {
            return response()->json(['oops' => 'looks like no'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate($this->book->rules(), $this->book->feedback());

        $book = $this->book->find($id);

        if($book === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($book->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas, $book->feedback());

        } else {
            $request->validate($book->rules(), $book->feedback());
        }
        
        //remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if($request->file('book_cover')) {
            Storage::disk('public')->delete($book->book_cover);
        }
        
        $imagem = $request->file('book_cover');
        $imagem_urn = $imagem->store('images', 'public');

        //preencher o objeto $marca com os dados do request
        $book->fill($request->all());
        $book->book_cover = $imagem_urn;
        //dd($marca->getAttributes());
        $book->save();

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->book->find($id);        

        if($book === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }  
        
        Storage::disk('public')->delete($book->book_cover);        
        $book->delete();
        return response()->json(['msg' => 'Livro deletado com sucesso']);
    }
}
