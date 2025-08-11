<?php

namespace App\Repository\Category;

use App\Models\Category;
use App\Interface\Category\CategoryInterface;

class CategoryRepository implements CategoryInterface

{

    public function index($pagination_count)
    {
        $categories = Category::query()->with('trans')->paginate($pagination_count)->appends(request()->query());
        return view('admin.pages.category.index',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $data = $request->getSanitized();
        // dd($data);
        $Category = Category::create($data);
        return redirect()->back()->with('success',__('Created Sucessfully'));
    }

    public function edit($id)
    {
        $category = Category::findOrfail($id);
        $category->load('trans');
        $currentPage = request('page', 1);
        return view('admin.pages.category.edit',compact('category','currentPage'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update($request,$id)
    {
        $data = $request->getSanitized();
        $category = Category::findOrfail($id);
        $category->update($data);
        return redirect()->route('admin.categories.index', ['page' => $request->input('page', 1)])->with('success',__('Updated Sucessfully'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success',__('Deleted Sucessfully'));
    }
    public function update_status($id)
    {
        $category = Category::findOrfail($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $category->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }
    public function actions($request)
    {

        if ($request['publish'] == 1) {
            $category = Category::findMany($request['record']);
            foreach ($category as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $category = Category::findMany($request['record']);
            foreach ($category as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $category = Category::findMany($request['record']);
            foreach ($category as $item) {
                $item->delete();
            }

            return redirect()->route('admin.categories.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
