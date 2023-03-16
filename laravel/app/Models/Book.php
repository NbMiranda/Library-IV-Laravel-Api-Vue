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

        return $regras = [
            'book_name' => 'required|unique:books,book_name|min:3',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribuite é obrigatório',
            'book_name.unique' => 'Livro já cadastrado',
            'book_name.min' => 'O nome deve ter no mínimo 3 caracteres'
        ];
    }
}
