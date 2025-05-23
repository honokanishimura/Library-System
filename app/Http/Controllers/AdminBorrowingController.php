<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BorrowRecord;
use Illuminate\Support\Facades\Session;

class AdminBorrowingController extends Controller
{
    /**
     * Display the borrowing management index page.
     * If a member number is provided, fetch the user and their currently borrowed books.
     */
    public function index(Request $request)
    {
        $user = null;
        $borrowedBooks = collect();
        $borrowing = null;

        if ($request->has('member_number')) {
            $memberNumber = $request->input('member_number');
            $user = User::where('member_number', $memberNumber)->first();

            if ($user) {
                $borrowedBooks = BorrowRecord::where('user_id', $user->id)
                    ->whereNull('returned_at')
                    ->with('book')
                    ->get();

                $borrowing = BorrowRecord::where('user_id', $user->id)
                    ->whereNull('returned_at')
                    ->first();
            }
        }

        return view('admin.borrowing.index', compact('user', 'borrowedBooks', 'borrowing'));
    }

    /**
     * Store selected member information in session.
     */
    public function selectMember(Request $request)
    {
        $request->validate([
            'member_number' => 'required|exists:users,member_number',
        ]);

        $user = User::where('member_number', $request->member_number)->first();

        session()->put('selected_user', $user);

        return redirect()->route('admin.borrowing.select')->with('success', 'Member selected.');
    }

    /**
     * Display book selection view with optional ISBN filtering.
     */
    public function select(Request $request)
    {
        $books = Book::all();
        $user = session('selected_user');

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', 'No user selected.');
        }

        if ($request->has('isbn')) {
            $books = Book::where('isbn', 'like', "%{$request->isbn}%")->get();
        }

        return view('admin.borrowing.select', compact('books', 'user'));
    }

    /**
     * Add a book to the borrowing list stored in session.
     */
    public function addBook(Request $request, $book_id)
    {
        if (!is_numeric($book_id)) {
            return redirect()->route('admin.borrowing.list')->with('error', 'Invalid book ID.');
        }

        $borrowedBookIds = session()->get('borrowed_books', []);

        if (!in_array($book_id, $borrowedBookIds)) {
            $borrowedBookIds[] = $book_id;
        }

        session()->put('borrowed_books', $borrowedBookIds);

        return redirect()->route('admin.borrowing.list');
    }

    /**
     * Display the current borrowing list.
     */
    public function list()
    {
        $borrowedBookIds = session()->get('borrowed_books', []);
        $user = session('selected_user');

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', 'No user selected.');
        }

        $borrowedBooks = Book::whereIn('id', $borrowedBookIds)->get();

        return view('admin.borrowing.list', compact('borrowedBooks', 'user'));
    }

    /**
     * Handle confirmation of borrow dates and redirect to confirmation view.
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after:borrowed_at',
        ]);

        session([
            'borrowed_at' => $request->borrowed_at,
            'due_date' => $request->due_date,
        ]);

        return $this->showConfirm();
    }

    /**
     * Display the borrow confirmation view.
     */
    public function showConfirm()
    {
        $borrowed_at = session('borrowed_at');
        $due_date = session('due_date');
        $borrowedBookIds = session('borrowed_books', []);
        $userData = session('selected_user');

        if (!$borrowed_at || !$due_date) {
            return redirect()->route('admin.borrowing.list')->with('error', 'Borrow and due dates required.');
        }

        $user = User::find(is_array($userData) ? $userData['id'] : ($userData->id ?? null));

        if (!$user) {
            return redirect()->route('admin.borrowing.index')->with('error', 'User not found.');
        }

        $borrowedBooks = Book::whereIn('id', $borrowedBookIds)->get();

        return view('admin.borrowing.confirm', compact('borrowed_at', 'due_date', 'borrowedBooks', 'user'));
    }

    /**
     * Complete the borrowing process and save records to database.
     */
    public function complete()
    {
        $borrowed_at = session('borrowed_at');
        $due_date = session('due_date');
        $borrowedBookIds = session('borrowed_books', []);
        $userData = session('selected_user');
        $userId = is_array($userData) ? $userData['id'] : ($userData->id ?? null);

        if (!$userId || !$borrowed_at || !$due_date || empty($borrowedBookIds)) {
            return redirect()->route('admin.borrowing.list')->with('error', 'Missing required data.');
        }

        try {
            BorrowRecord::insert(array_map(fn($bookId) => [
                'user_id' => $userId,
                'book_id' => $bookId,
                'borrowed_at' => $borrowed_at,
                'due_date' => $due_date,
                'created_at' => now(),
                'updated_at' => now(),
            ], $borrowedBookIds));

            session()->forget(['borrowed_at', 'due_date', 'borrowed_books']);

        } catch (\Exception $e) {
            return redirect()->route('admin.borrowing.list')->with('error', 'Failed to complete borrowing.');
        }

        return redirect()->route('mypage.current')->with('success', 'Borrowing completed.');
    }

    /**
     * Show the completion confirmation view (optional).
     */
    public function showComplete()
    {
        return view('admin.borrowing.complete');
    }
}
