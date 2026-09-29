<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'CRUD Laravel API',
    description: 'API para gerenciamento de livros.'
)]
#[OA\Server(
    url: '/api',
    description: 'Servidor da API'
)]
#[OA\Tag(
    name: 'Livros',
    description: 'Operacoes de CRUD para livros.'
)]
#[OA\Schema(
    schema: 'Livro',
    required: ['id', 'titulo', 'autor', 'genero', 'numero_paginas', 'avaliacao', 'data_lancamento'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'titulo', type: 'string', example: 'O Hobbit'),
        new OA\Property(property: 'autor', type: 'string', example: 'J. R. R. Tolkien'),
        new OA\Property(property: 'genero', type: 'string', example: 'Fantasia'),
        new OA\Property(property: 'numero_paginas', type: 'integer', format: 'int32', example: 310),
        new OA\Property(property: 'avaliacao', type: 'number', format: 'float', minimum: 0, maximum: 10, example: 9.5),
        new OA\Property(property: 'data_lancamento', type: 'string', format: 'date', example: '1937-09-21'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'LivroInput',
    required: ['titulo', 'autor', 'genero', 'numero_paginas', 'avaliacao', 'data_lancamento'],
    properties: [
        new OA\Property(property: 'titulo', type: 'string', maxLength: 255, example: 'O Hobbit'),
        new OA\Property(property: 'autor', type: 'string', maxLength: 255, example: 'J. R. R. Tolkien'),
        new OA\Property(property: 'genero', type: 'string', maxLength: 255, example: 'Fantasia'),
        new OA\Property(property: 'numero_paginas', type: 'integer', minimum: 1, example: 310),
        new OA\Property(property: 'avaliacao', type: 'number', format: 'float', minimum: 0, maximum: 10, example: 9.5),
        new OA\Property(property: 'data_lancamento', type: 'string', format: 'date', example: '1937-09-21'),
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'ValidationError',
    properties: [
        new OA\Property(property: 'status', type: 'boolean', example: false),
        new OA\Property(
            property: 'errors',
            type: 'object',
            additionalProperties: new OA\AdditionalProperties(
                type: 'array',
                items: new OA\Items(type: 'string')
            )
        ),
    ],
    type: 'object'
)]
#[OA\Get(
    path: '/livros',
    tags: ['Livros'],
    summary: 'Lista os livros',
    responses: [
        new OA\Response(
            response: 200,
            description: 'Lista paginada de livros',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(
                        property: 'livros',
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(ref: '#/components/schemas/Livro')
                            ),
                            new OA\Property(property: 'current_page', type: 'integer', example: 1),
                            new OA\Property(property: 'last_page', type: 'integer', example: 1),
                            new OA\Property(property: 'per_page', type: 'integer', example: 2),
                            new OA\Property(property: 'total', type: 'integer', example: 1),
                        ]
                    ),
                ]
            )
        )
    ]
)]
#[OA\Post(
    path: '/livros',
    tags: ['Livros'],
    summary: 'Cadastra um livro',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: '#/components/schemas/LivroInput')
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: 'Livro cadastrado com sucesso',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Livro cadastrado com sucesso!'),
                    new OA\Property(property: 'livro', ref: '#/components/schemas/Livro'),
                ]
            )
        ),
        new OA\Response(response: 422, description: 'Dados inválidos', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')),
    ]
)]
#[OA\Get(
    path: '/livros/{livro}',
    tags: ['Livros'],
    summary: 'Exibe um livro',
    parameters: [
        new OA\Parameter(name: 'livro', in: 'path', required: true, description: 'ID do livro', schema: new OA\Schema(type: 'integer', format: 'int64'), example: 1),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Livro encontrado',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(property: 'livro', ref: '#/components/schemas/Livro'),
                ]
            )
        ),
        new OA\Response(response: 404, description: 'Livro não encontrado'),
    ]
)]
#[OA\Put(
    path: '/livros/{livro}',
    tags: ['Livros'],
    summary: 'Atualiza um livro',
    parameters: [
        new OA\Parameter(name: 'livro', in: 'path', required: true, description: 'ID do livro', schema: new OA\Schema(type: 'integer', format: 'int64'), example: 1),
    ],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: '#/components/schemas/LivroInput')
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: 'Livro editado com sucesso',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Livro editado com sucesso!'),
                    new OA\Property(property: 'livro', ref: '#/components/schemas/Livro'),
                ]
            )
        ),
        new OA\Response(response: 404, description: 'Livro não encontrado'),
        new OA\Response(response: 422, description: 'Dados inválidos', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')),
    ]
)]
#[OA\Delete(
    path: '/livros/{livro}',
    tags: ['Livros'],
    summary: 'Exclui um livro',
    parameters: [
        new OA\Parameter(name: 'livro', in: 'path', required: true, description: 'ID do livro', schema: new OA\Schema(type: 'integer', format: 'int64'), example: 1),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Livro excluído com sucesso',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Livro excluído com sucesso!'),
                    new OA\Property(property: 'livro', ref: '#/components/schemas/Livro'),
                ]
            )
        ),
        new OA\Response(response: 404, description: 'Livro não encontrado'),
    ]
)]
class ProductControllerDocs
{
}
