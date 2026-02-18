<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookApiController extends Controller
{
    // 🟢 Get all books
    public function index()
    { 
        $books = Book::all()->map(function ($book) {
            //  dd($book);
            $book->image_url = $book->image ? asset('storage/' . $book->image) : null;
            return $book;
        });

        return response()->json($books, 200);
    }

    // 🟡 Create new book (with optional image upload)
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category' => 'nullable|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Book created successfully!',
            'data' => $book,
            'image_url' => $book->image ? asset('storage/' . $book->image) : null,
        ], 201);
    }

    // 🔵 Show a single book
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->image_url = $book->image ? asset('storage/' . $book->image) : null;

        return response()->json($book, 200);
    }

    // 🟠 Update book (with optional image update)
 
 public function update(Request $request, $id)
{
    $book = Book::find($id);

    $book->title = $request->title;
    $book->author = $request->author;
    $book->category = $request->category;
    $book->quantity = $request->quantity;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('books', $filename, 'public');
        $book->image = $filename;
    }

    $book->save();

    return response()->json([
        "message" => "Book updated successfully!",
        "data" => $book
    ]);
}


    // 🔴 Delete book
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // 🗑 Delete stored image if exists
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully!'], 200);
    }
}
