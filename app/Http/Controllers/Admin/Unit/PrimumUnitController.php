<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PrimumUnitController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()->with('trans')->get();
        $products = Product::query()
            ->with(['trans', 'category'])
            ->primum(1)
            ->filter($request->query())
            ->get();

        return view('admin.pages.unit.primum.index', compact('products', 'categories'));
    }
}
