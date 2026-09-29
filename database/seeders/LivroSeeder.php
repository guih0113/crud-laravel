<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    public function run(): void
    {
        $livros = [
            [
                'titulo' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'genero' => 'Romance',
                'numero_paginas' => 256,
                'avaliacao' => 9.2,
                'data_lancamento' => '1899-01-01',
            ],
            [
                'titulo' => 'O Senhor dos Aneis',
                'autor' => 'J. R. R. Tolkien',
                'genero' => 'Fantasia',
                'numero_paginas' => 1216,
                'avaliacao' => 9.8,
                'data_lancamento' => '1954-07-29',
            ],
            [
                'titulo' => '1984',
                'autor' => 'George Orwell',
                'genero' => 'Ficcao distopica',
                'numero_paginas' => 328,
                'avaliacao' => 9.4,
                'data_lancamento' => '1949-06-08',
            ],
            [
                'titulo' => 'Cem Anos de Solidao',
                'autor' => 'Gabriel Garcia Marquez',
                'genero' => 'Realismo magico',
                'numero_paginas' => 448,
                'avaliacao' => 9.5,
                'data_lancamento' => '1967-05-30',
            ],
            [
                'titulo' => 'O Pequeno Principe',
                'autor' => 'Antoine de Saint-Exupery',
                'genero' => 'Fabula',
                'numero_paginas' => 96,
                'avaliacao' => 9.0,
                'data_lancamento' => '1943-04-06',
            ],
            [
                'titulo' => 'A Revolucao dos Bichos',
                'autor' => 'George Orwell',
                'genero' => 'Satira',
                'numero_paginas' => 152,
                'avaliacao' => 9.1,
                'data_lancamento' => '1945-08-17',
            ],
            [
                'titulo' => 'Harry Potter e a Pedra Filosofal',
                'autor' => 'J. K. Rowling',
                'genero' => 'Fantasia',
                'numero_paginas' => 264,
                'avaliacao' => 9.3,
                'data_lancamento' => '1997-06-26',
            ],
            [
                'titulo' => 'O Hobbit',
                'autor' => 'J. R. R. Tolkien',
                'genero' => 'Fantasia',
                'numero_paginas' => 310,
                'avaliacao' => 9.6,
                'data_lancamento' => '1937-09-21',
            ],
        ];

        foreach ($livros as $livro) {
            Livro::firstOrCreate([
                'titulo' => $livro['titulo'],
                'autor' => $livro['autor'],
            ], $livro);
        }
    }
}