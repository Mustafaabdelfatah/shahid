<?php

namespace App\Http\Controllers\Admin\Commint;

use App\Models\UnitCommint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class UnitCommintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitCommint = UnitCommint::query()->with(['user','product'])->get();
        return view("admin.pages.unitCommint.index" , compact("unitCommint"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::query()->get();
        $user = User::query()->get();
        return view("admin.pages.unitCommint.create",  compact("product","user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        UnitCommint::create($request->all()) ;
        return redirect()->route('admin.unit-commint.create')->with('success', 'Created Succesfully') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitCommint $UnitCommint)
    {
        $UnitCommint->delete();
        return redirect()->route('admin.unit-commint.index')->with('success',__('Deleted Successfully'));
    }
}
