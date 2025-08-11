<?php

namespace App\Http\Controllers\Admin\WishList;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WishList;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlist = Wishlist::query()->with(['product','user'])->get();

        return view('admin.pages.wishList.index' , compact('wishlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $product = Product::query()->with('trans')->get();
        $product = Product::query()->with('trans')->get();
        $user = User::query()->get();
        return view('admin.pages.wishList.create', compact('product','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {

        // dd($request->all());
        WishList::create($request->all());
        return redirect()->route('admin.wish-list.index')->with('success','');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        WishList::destroy($id);
        return redirect()->route('admin.wish-list.index')->with('success','Deleted Succesfully');
    }
}
