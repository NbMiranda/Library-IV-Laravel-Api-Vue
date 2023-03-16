<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    use HasFactory;

    protected $fillable = ['writer_name'];

    public function books() {
        return $this->hasMany('App\Models\Book');
    }

    public function rules(){

        return $regras = [
            'writer_name' => 'required|unique:writers,writer_name|min:3',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo nome do escritor é obrigatório',
            'writer_name.unique' => 'Escritor já cadastrado',
            'writer_name.min' => 'O nome deve ter no mínimo 3 caracteres'
        ];
    }
}
