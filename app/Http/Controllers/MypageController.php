<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * Mypage top (shows currently borrowed books and due date info)
     */
    public function mypage()
    {
        $user = Auth::user();

        // Check authentication
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        // Currently borrowed books (not yet returned)
        $currentBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->orderBy('borrowed_at', 'asc')
            ->get();

        // Books with upcoming due date (within 3 days)
        $upcomingDueBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '>=', now())
            ->whereDate('due_date', '<=', now()->addDays(3))
            ->get();

        // Overdue books
        $overdueBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereDate('due_date', '<', now())
            ->get();

        return view('user.mypage.current', compact(
            'user',
            'currentBooks',
            'upcomingDueBooks',
            'overdueBooks'
        ));
    }

    /**
     * Current borrowed books page
     */
    public function current()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        // Currently borrowed books with pagination
        $currentBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->orderBy('borrowed_at', 'desc')
            ->paginate(10);

        // Books due soon (within 3 days)
        $upcomingDueBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->whereBetween('due_date', [now(), now()->addDays(3)])
            ->get();

        // Overdue books
        $overdueBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->get();

        $totalBorrowed = BorrowRecord::where('user_id', $user->id)->count();
        $currentlyBorrowed = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->count();

        return view('user.mypage.current', compact(
            'currentBooks',
            'user',
            'totalBorrowed',
            'currentlyBorrowed',
            'upcomingDueBooks',
            'overdueBooks'
        ));
    }

    /**
     * Past borrow history page
     */
    public function borrowed()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        // Get all borrow records with pagination
        $borrowedBooks = BorrowRecord::with('book')
            ->where('user_id', $user->id)
            ->orderBy('borrowed_at', 'desc')
            ->paginate(10);

        // Stats
        $totalBorrowed = BorrowRecord::where('user_id', $user->id)->count();
        $currentlyBorrowed = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->count();

        return view('user.mypage.borrowed', compact(
            'borrowedBooks',
            'user',
            'totalBorrowed',
            'currentlyBorrowed'
        ));
    }

    /**
     * Process book return
     */
    public function returnBook($id)
    {
        $user = Auth::user();

        // Check if the book was really borrowed by this user
        $record = BorrowRecord::where('id', $id)
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->first();

        if (!$record) {
            return back()->with('error', 'The book to be returned could not be found.');
        }

        // Process return
        $record->returned_at = now();
        $record->save();

        return back()->with('success', 'The book has been successfully returned.');
    }
}
