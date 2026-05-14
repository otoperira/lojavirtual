<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::all();

        $query = Product::where('quantity', '>', 0);

        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        $products = $query->get();

        return view('home', compact('products', 'types'));
    }
}