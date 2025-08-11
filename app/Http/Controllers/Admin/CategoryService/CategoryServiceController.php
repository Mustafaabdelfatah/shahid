<?php

namespace App\Http\Controllers\Admin\CategoryService;

use Illuminate\Http\Request;
use App\Models\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryServiceRequest;

class CategoryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_service = CategoryService::query()->with('trans')->get();
        return view('admin.pages.category_service.index',compact('category_service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category_service.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryServiceRequest $request)
    {
        // dd($request);
        $data = $request->getSanitized();
        // dd($data);
        $category_service = CategoryService::create($data);
        return redirect()->back()->with('success',__('Created Sucessfully'));
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
    public function edit($id)
    {
        $category_service = CategoryService::with('trans')->findOrFail($id);
      return view('admin.pages.category_service.edit',compact('category_service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryServiceRequest $request, string $id)
    {
        $data = $request->getSanitized();
        $category_service = CategoryService::findOrfail($id);
        $category_service->update($data);
        return redirect()->route('admin.category_service.index')->with('success',__('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category_service = CategoryService::findOrfail($id);
        $category_service->delete();
        return redirect()->route('admin.category_service.index')->with('success',__('Deleted Sucessfully'));
    }
}
