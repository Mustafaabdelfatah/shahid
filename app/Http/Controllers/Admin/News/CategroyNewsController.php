<?php

namespace App\Http\Controllers\Admin\News;

use pagination;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryNewsRequest;

class CategroyNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categoryNews = CategoryNews::query()->with('trans')->paginate(10);
        return view('admin.pages.categoryNews.index' , compact('categoryNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.categoryNews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryNewsRequest $request)
    {
        $data = $request->getSanitized();
        // dd($data);
        $CategoryNews = CategoryNews::create($data);
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
        $categoryNews = categoryNews::findOrFail($id);
        $categoryNews->load('trans');
       

        return view('admin.pages.categoryNews.edit', compact('categoryNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryNewsRequest $request, $id)
    {
        $data = $request->getSanitized();
        $categoryNews = categoryNews::findOrFail($id);
        $categoryNews->update($data);
        // dd($categoryNews);

        return redirect()->route('admin.categories_news.index')->with('success',__('Updated Sucessfully'));
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryNews $categoryNews)
    {
        $categoryNews->delete();
        return redirect()->route('admin.categories_news.index')->with('success',__('Deleted Successfully'));
    }
    public function actions(Request $request)
    {
       
        if ($request['publish'] == 1) {
             $categoryNews = categoryNews::findMany($request['record']);
            foreach ( $categoryNews as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
             $categoryNews = categoryNews::findMany($request['record']);
            foreach ( $categoryNews as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
             $categoryNews = categoryNews::findMany($request['record']);
            foreach ( $categoryNews as $item) {
                $item->delete();
            }

            return redirect()->route('admin.categories_news.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
