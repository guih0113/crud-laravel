<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['titulo', 'autor', 'genero', 'numero_paginas', 'avaliacao', 'data_lancamento'])]
#[Hidden([])]
class Livro extends Model
{
    protected function casts(): array
    {
        return [
            'numero_paginas' => 'integer',
            'avaliacao' => 'decimal:1',
            'data_lancamento' => 'date',
        ];
    }
}