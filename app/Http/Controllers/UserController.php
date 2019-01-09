<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class UserController extends Controller
{    
    public function index()
    {
        $books = Book::with('category')->get();
        return view('users.index', compact('books'));
    }
}
