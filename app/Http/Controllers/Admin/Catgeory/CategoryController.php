<?php

namespace App\Http\Controllers\Admin\Catgeory;

use pagination;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interface\Category\CategoryInterface;

class CategoryController extends Controller
{
    public CategoryInterface $category;
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->category->index($this->pagination_count);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->category->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
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
        return $this->category->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        return $this->category->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->category->destroy($id);
    }

    public function update_status($id)
    {
        return $this->category->update_status($id);
    }
    public function actions(Request $request){
        return $this->category->actions($request);
    }
    public function showDeleted()
    {
        $categories = Category::getAllDeleted();
        return view('admin.pages.category.deleted.index', compact('categories'));
    }

    public function restore($id)
    {
        try {
            $category = Category::restoreCategory($id);
            return redirect()->back()->with('success', 'Category restored successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore Category: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $category = Category::forceDeleteCategory($id);
            return redirect()->back()->with('success', 'Category permanently deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Category: ' . $e->getMessage());
        }
    }
}
