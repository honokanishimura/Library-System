<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\User;

class AdminReturnController extends Controller
{
   
    public function index($id)
    {
        $user = User::findOrFail($id);

        $borrowedBooks = BorrowRecord::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->with(['book', 'book.genre'])
            ->get();

        return view('admin.return.index', compact('user', 'borrowedBooks'));
    }

  
    public function updateDueDate(Request $request)
    {
        $validatedData = $request->validate([
            'due_date' => 'array',
            'due_date.*' => 'required|date|after_or_equal:today',
        ]);

        foreach ($validatedData['due_date'] as $borrowId => $newDueDate) {
            $borrowedRecord = BorrowRecord::find($borrowId);
            if ($borrowedRecord) {
                $borrowedRecord->due_date = $newDueDate;
                $borrowedRecord->save();
            }
        }

        return redirect()->back()->with('success', '返却期限を更新しました。');
    }

  
    public function confirm(Request $request)
    {
        $request->validate([
            'returned_books_ids' => 'required|array|min:1',
            'returned_books_ids.*' => 'exists:borrow_records,id',
        ]);

        $records = BorrowRecord::with(['book', 'book.genre'])
                    ->whereIn('id', $request->returned_books_ids)
                    ->get();

        $user = $records->first()?->user;

        return view('admin.return.confirm', [
            'borrowedBooks' => $records,
            'user' => $user,
        ]);
    }

   
    public function showComplete()
    {
        return view('admin.return.complete');
    }

  
    public function complete(Request $request)
    {
        $validated = $request->validate([
            'returned_books_ids' => 'required|array|min:1',
            'returned_books_ids.*' => 'exists:borrow_records,id',
        ]);

        BorrowRecord::whereIn('id', $validated['returned_books_ids'])
                    ->update(['returned_at' => now()]);

        return redirect()->route('admin.return.complete')
                         ->with('success', '返却処理が正常に完了しました。');
    }
}
