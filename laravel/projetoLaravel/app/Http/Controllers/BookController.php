<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
    {
        // Validar os parâmetros de entrada
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'nullable|string',
            'author' => 'nullable|string',
            'genre' => 'nullable|in:Romance,Classic,Fiction,Mystery,Action,Drama',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Iniciar a query
        $query = Book::query();

        // Filtrar por ID
        if ($request->has('id')) {
            $book = $query->where('id', $request->id)->first();

            if ($book) {
                return response()->json($book);
            } else {
                return response()->json(['message' => 'livro não encontrado com esse id'], 404);
            }
        }

        // Filtrar por título
        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Filtrar por autor
        if ($request->has('author')) {
            $query->where('author', 'LIKE', '%' . $request->author . '%');
        }

        // Filtrar por gênero
        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }

        // Filtrar por intervalo de datas
        if ($request->has('start_date')) {
            $query->where('release_date', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query->where('release_date', '<=', $request->end_date);
        }

        // Executar a query e obter os livros
        $books = $query->get();

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Nenhum livro encontrado com base nessa busca'], 404);
        }

        // Retornar os livros filtrados
        return response()->json($books);
    }

    // Criar um novo livro
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date|before_or_equal:today',
            'genre' => 'required|in:Romance,Classic,Fiction,Mystery,Action,Drama',
            'pages' => 'required|integer|min:1',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    // Atualizar um livro
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'release_date' => 'date|before_or_equal:today',
            'genre' => 'in:Romance,Classic,Fiction,Mystery,Action,Drama',
            'pages' => 'integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book);
    }

    // Excluir um livro
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
