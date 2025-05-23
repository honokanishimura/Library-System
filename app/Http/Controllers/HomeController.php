<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class HomeController extends Controller
{
    
    public function index()
    {
        $books = Book::paginate(8);
        return view('home', compact('books'));
    }

    
    public function mypage()
    {
        $user = Auth::user();
        return view('mypage.current', compact('user'));
    }
}
