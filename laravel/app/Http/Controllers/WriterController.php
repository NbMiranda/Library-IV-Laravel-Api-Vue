<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    protected $writer;
    public function __construct(Writer $writer) {
        $this->writer = $writer;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->writer->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->writer->rules(), $this->writer->feedback());
        
        $writer = Writer::create($request->all());
        return $writer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $writer = $this->writer->with('books')->find($id);
        if ($writer) {
            return $writer;
        } else {
            return response()->json(['oops' => 'looks like no'], 404);
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function edit(Writer $writer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate($this->writer->rules(), $this->writer->feedback());

        $writer = $this->writer->find($id);
        if ($writer) {
            $writer->update($request->all());
            return $writer;
        } else {
            return response()->json(['oops' => 'looks like no'], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $writer = $this->writer->with('books')->find($id);        

        if($writer === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }  
        
        if (count($writer->books) === 0) {
            // O array "books" está vazio
            $writer->delete();
            return response()->json(['msg' => 'Escritor deletado com sucesso!'], 200);

        } else {
            $bookName = $writer->books->first()->book_name;

            
            return response()->json(['erro' => "Não é possivel deletar, escritor acossiado ao livro $bookName"]);
        }
   
    }
}
