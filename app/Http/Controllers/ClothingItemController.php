<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClothingItem;
class ClothingItemController extends Controller
{
    public function index()
    {
        $clothingItems = ClothingItem::all();

        return view('dressing',compact('clothingItems'));
    }
}
