<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all(); // if dataset gets large, paginate(50)
        return response()->json($books);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Book::find($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $book = Book::create($request->validated());
        return response()->json($book, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id, BookService $service)
    {
        $book = $service->updateBook($request, $id);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Book::where('id', $id)->exists()) return response()->json(['error' => 'There is no Book with id ' . $id . ' in our records.'], 400);
        Book::destroy($id);
        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }

    public function attachStores(Request $request, int $id)
    {
        $book = Book::find($id);
        $request->validate(['stores.*' => 'exists:stores,id']);
        $book->stores()->attach($request->stores);
        return response()->json($book);
    }
}
