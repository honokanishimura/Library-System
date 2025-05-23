<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminBooksController extends Controller
{
    /**
     * Display a list of books
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the book creation form
     */
    public function create()
    {
        return view('admin.books.add');
    }

    /**
     * Handle book creation
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_id' => 'required|integer',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->isbn = $request->isbn;
        $book->genre_id = $request->genre_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $book->image = basename($path);
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book has been added.');
    }

    /**
     * Show book details
     */
    public function show(Book $book)
    {
        return view('admin.books.details', compact('book'));
    }

    /**
     * Show the book editing form
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Handle book update
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_id' => 'required|integer',
        ]);

        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->isbn = $request->isbn;
        $book->genre_id = $request->genre_id;

        // Update image
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::delete('public/images/' . $book->image);
            }
            $path = $request->file('image')->store('public/images');
            $book->image = basename($path);
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book has been updated.');
    }

    /**
     * Handle book deletion
     */
    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::delete('public/images/' . $book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book has been deleted.');
    }

    /**
     * Show the import view
     */
    public function importView()
    {
        return view('admin.books.import');
    }

    /**
     * Handle bulk import from CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csvFile');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_shift($csvData);

        $booksToInsert = [];
        $errors = [];

        $validationRules = [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|max:20',
            'genre_id' => 'required|integer',
        ];

        DB::beginTransaction();

        try {
            foreach ($csvData as $index => $row) {
                if (count($row) < 4) {
                    $errors[] = "Row " . ($index + 2) . " is missing required data.";
                    break;
                }

                $bookData = [
                    'title' => trim($row[0]),
                    'author_name' => trim($row[1]),
                    'isbn' => trim($row[2]),
                    'genre_id' => (int) trim($row[3]),
                ];

                $validator = Validator::make($bookData, $validationRules);

                if ($validator->fails()) {
                    $errors[] = "Row " . ($index + 2) . " contains invalid data: " . implode(", ", $validator->errors()->all());
                    break;
                }

                $booksToInsert[] = $bookData;
            }

            if (!empty($errors)) {
                DB::rollBack();
                return redirect()->route('admin.books.import')->withErrors($errors);
            }

            if (!empty($booksToInsert)) {
                Book::insert($booksToInsert);
            }

            DB::commit();

            $books = Book::latest()->take(count($booksToInsert))->get();
            return view('admin.books.import', compact('books'))->with('success', 'CSV data imported successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.books.import')->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
