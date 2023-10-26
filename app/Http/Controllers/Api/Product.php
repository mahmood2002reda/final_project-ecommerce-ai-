<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Product extends Controller
{
    public function index()
    {
        $books=User::get();
       
        return view('book.index',compact('books'));
    }
}
