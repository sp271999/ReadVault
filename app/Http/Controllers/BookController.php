<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view books')
            ->only(['index', 'show', 'gallery']);

        $this->middleware('permission:create books')
            ->only(['create', 'store']);

        $this->middleware('permission:edit books')
            ->only(['edit', 'update']);

        $this->middleware('permission:delete books')
            ->only(['destroy']);
    }

    /* ================= INDEX ================= */

    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cat) use ($search) {

                      $cat->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->latest()->get();

        return view('books.index', compact('books'));
    }

    /* ================= PDF DOWNLOAD ================= */

    public function downloadPdf()
    {
        $books = Book::with('category')->get();

        $pdf = Pdf::loadView('books.pdf', compact('books'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('books-list.pdf');
    }

    /* ================= CREATE ================= */

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $request->file('image')
                ->store('books', 'public');
        }

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book added successfully');
    }

    /* ================= SHOW ================= */

    public function show(string $id)
    {
        $book = Book::with('category')->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /* ================= EDIT ================= */

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($book->image &&
                Storage::disk('public')->exists($book->image)) {

                Storage::disk('public')->delete($book->image);
            }

            $validated['image'] = $request->file('image')
                ->store('books', 'public');
        }

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    /* ================= DELETE ================= */

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->image &&
            Storage::disk('public')->exists($book->image)) {

            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Book deleted successfully');
    }

    /* ================= GALLERY ================= */

    public function gallery()
    {
        $books = Book::with('category')
                     ->latest()
                     ->get();

        return view('books.gallery', compact('books'));
    }
}