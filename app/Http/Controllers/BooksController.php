<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Homepage: List of books
     */
    public function index()
    {
        $books = Book::with('genre')->paginate(10);
        return view('user.index', compact('books'));
    }

    /**
     * Book search by title or author
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'like', "%{$query}%")
            ->orWhere('author_name', 'like', "%{$query}%")
            ->with('genre')
            ->paginate(8);

        return view('user.books.search', compact('books'));
    }

    /**
     * Book details page
     */
    public function details($id)
    {
        $book = Book::with(['genre', 'borrowRecords.user'])->findOrFail($id);
        return view('user.books.details', compact('book'));
    }

    /**
     * Borrow a book
     */
    public function borrow(Request $request, $book_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        // Check if the user has already borrowed this book and not returned it yet
        $alreadyBorrowed = BorrowRecord::where('user_id', $user->id)
            ->where('book_id', $book_id)
            ->whereNull('returned_at')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'You have already borrowed this book.');
        }

        // Update book status and set return date
        $book = Book::findOrFail($book_id);
        $book->status = 'Borrowed';
        $book->return_date = now()->addDays(14);
        $book->save();

        // Create borrow record
        BorrowRecord::create([
            'user_id' => $user->id,
            'book_id' => $book_id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14),
        ]);

        return redirect()->route('mypage.current')->with('success', 'You have successfully borrowed the book.');
    }
}
