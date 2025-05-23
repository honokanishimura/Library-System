<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class AdminGenresController extends Controller
{
    // Display a list of all genres
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    // Show form for creating a new genre
    public function create()
    {
        return view('admin.genres.create');
    }

    // Store a newly created genre in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre has been added successfully.');
    }

    // Show form for editing the specified genre
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    // Update the specified genre in the database
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre has been updated successfully.');
    }

    // Delete the specified genre
    public function destroy(Genre $genre)
    {
        // Prevent deletion of specific default genres
        if (in_array($genre->name, ['General Works', 'Philosophy', 'History'])) {
            return redirect()->route('admin.genres.index')->with('error', 'This genre cannot be deleted.');
        }

        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Genre has been deleted successfully.');
    }
}
