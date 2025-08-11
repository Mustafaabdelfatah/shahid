<?php

namespace App\Http\Controllers\Admin\Commint;

use App\Models\News;
use App\Models\User;
use App\Models\NewsCommint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsCommintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsCommint = NewsCommint::query()->with(['user', 'news'])->get();
        return view('admin.pages.newsCommint.index', compact('newsCommint'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = News::query()->with('trans')->get();
        $user = User::query()->get();
        return view("admin.pages.newsCommint.create",  compact("news", "user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        NewsCommint::create($request->all());
        return redirect()->route('admin.news-commint.create')->with('success', 'Created Succesfully');
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
    public function destroy(NewsCommint $NewsCommint)
    {
        $NewsCommint->delete();
        return redirect()->route('admin.news-commint.index')->with('success',__('Deleted Successfully'));
    }
}
