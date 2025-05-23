<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    // Display a list of all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show user details
    public function details($id)
    {
        $user = User::findOrFail($id);

        // Retrieve all books borrowed by the user (both returned and unreturned)
        $borrowRecords = BorrowRecord::where('user_id', $user->id)
            ->with('book')
            ->orderBy('borrowed_at', 'desc')
            ->get();

        return view('admin.users.details', compact('user', 'borrowRecords'));
    }

    // Show user edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user information
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User information has been updated.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User has been deleted.');
    }

    // Display borrowing history
    public function history($id)
    {
        $user = User::findOrFail($id);
        
        // Retrieve borrowed books and their associated book info
        $borrowedBooks = BorrowRecord::where('user_id', $id)
            ->with('book')
            ->orderBy('borrowed_at', 'desc')
            ->paginate(10);

        // Calculate total and currently borrowed book counts
        $totalBorrowed = $borrowedBooks->count();
        $currentlyBorrowed = $borrowedBooks->filter(function ($borrowedBook) {
            return !$borrowedBook->returned_at; // Count books not yet returned
        })->count();

        return view('admin.users.history', compact('user', 'borrowedBooks', 'totalBorrowed', 'currentlyBorrowed'));
    }
}
