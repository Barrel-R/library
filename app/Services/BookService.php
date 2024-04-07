<?php

namespace App\Services;

use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookService
{
    public function updateBook(BookUpdateRequest $request, int $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'There is no Book on our records with id ' . $id], 400);
        }
        return $book->update($request->validated());
    }
}
