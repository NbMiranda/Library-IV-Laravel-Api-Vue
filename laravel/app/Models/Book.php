<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name', 
        'genre', 
        'book_cover', 
        'writer_id', 
        'synopsis',
        'status'
    ];
    public function writer() {
        return $this->belongsTo('App\Models\Writer');
    }

    public function rules(){

        return [
            'book_name' => 'required|unique:books,book_name,'.$this->id.'|min:3',
            'book_cover' => 'file|mimes:png,jpg',
            'genre' => 'min:3',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'book_name.unique' => 'Livro já cadastrado',
            'book_name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'genre.min' => 'O genero deve ter no mínimo 3 caracteres'
        ];
    }
}
