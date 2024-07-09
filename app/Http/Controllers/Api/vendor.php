<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class vendor extends Controller
{
    public function index()
    {
        $clothingItems = User::all();

        return view('dressing',compact('clothingItems'));
    }
}
