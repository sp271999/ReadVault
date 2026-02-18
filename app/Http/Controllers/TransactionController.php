<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    


    public function index()
    {
         $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->get();

        return view('transactions.index', compact('transactions'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get only available books
        $books = Book::where('quantity', '>', 0)->get();
        return view('transactions.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

    $request->validate([
        'book_id' => 'required|exists:books,id',
        'borrowed_at' => 'required|date',
        'due_date' => 'required|date|after_or_equal:borrowed_at',
    ]);

    Transaction::create([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
        'borrowed_at' => Carbon::parse($request->borrowed_at),
        'due_date' => Carbon::parse($request->due_date),
    ]);

    return redirect()->route('transactions.index')->with('success', 'Book borrowed successfully!');
}

        
    public function show(string $id)
    {
        $transaction = Transaction::with(['book', 'user'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $data = $request->validate([
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->book) {
            $transaction->book->increment('quantity');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function returnBook(Transaction $transaction)
{
    // prevent double return
    if ($transaction->isReturned()) {
        return back()->with('error', 'Book already returned.');
    }

    $transaction->update([
        'returned_at' => now(),
    ]);

    // increase book quantity
    if ($transaction->book) {
        $transaction->book->increment('quantity');
    }

    return back()->with('success', 'Book returned successfully.');
}

public function exportPdf()
{
    $transactions = Transaction::with('book')->get();

    $pdf = Pdf::loadView('transactions.pdf', compact('transactions'));

    return $pdf->download('transactions-report.pdf');
}



}
