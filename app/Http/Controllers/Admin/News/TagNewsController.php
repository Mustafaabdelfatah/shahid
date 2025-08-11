<?php

namespace App\Http\Controllers\Admin\News;

use pagination;
use App\Models\TagNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagNewsRequest;

class TagNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tegs_news = TagNews::query()->with('trans')->paginate(10);
        return view('admin.pages.TagNews.index', compact('tegs_news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.TagNews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagNewsRequest $request)
    {
        $data = $request->getSanitized();
        // dd($data);
        $tegs_news = TagNews::create($data);
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
        $tegs_news = TagNews::findOrFail($id);
        $tegs_news->load('trans');

        return view('admin.pages.TagNews.edit', compact('tegs_news'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TagNewsRequest $request, $id)
    {
        $data = $request->getSanitized();
        $tegs_news = TagNews::findOrFail($id);
        $tegs_news->update($data);
        // dd($tegs_news);

        return redirect()->route('admin.tegs_news.index')->with('success',__('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagNews $tegs_news)
    {
        $tegs_news->delete();
        return redirect()->route('admin.tegs_news.index')->with('success',__('Deleted Successfully'));
    }
    public function actions(Request $request)
    {
       
        if ($request['publish'] == 1) {
             $tegs_news = TagNews::findMany($request['record']);
            foreach ( $tegs_news as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
             $tegs_news = TagNews::findMany($request['record']);
            foreach ( $tegs_news as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
             $tegs_news = TagNews::findMany($request['record']);
            foreach ( $tegs_news as $item) {
                $item->delete();
            }

            return redirect()->route('admin.tegs_news.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
