<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function list()
    {
        $items = Item::all();
        
        return response()->json($items);
    }

    public function create(Request $request)
    {
        $item = new Item;

        $item->fill($request->all())->save();

        return $item;
    }

    public function token()
    {
        return csrf_field();
    }
}
