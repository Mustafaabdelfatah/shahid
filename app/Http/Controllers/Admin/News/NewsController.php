<?php

namespace App\Http\Controllers\Admin\News;

use App\Models\News;
use App\Models\TagNews;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Models\NewAttachment;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::query()->with('trans')->paginate(10);
        // dd($news);
        return view('admin.pages.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryNews::query()->with('trans')->get();
        $tags = TagNews::query()->with('trans')->get();
        return view('admin.pages.news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getSanitized();

            if (isset($data['image'])) {
                unset($data['image']); 
            }
            $news = News::create($data);
            $news->categories()->sync($data['category']);
            $news->tags()->sync($data['tags']);

            if ($request->hasFile('image')) {
                $news->images()->delete();
                foreach ($request->file('image') as $image) {
                    $imagePath = 'attachments/news/' . $image->getClientOriginalName(); 
                    $image->move(public_path('attachments/news'), $image->getClientOriginalName()); 
                    NewAttachment::create([
                        'new_id' => $news->id,
                        'image' => $imagePath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', __('Created Successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
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

        $categories = CategoryNews::query()->with('trans')->get();
        $tags = TagNews::query()->with('trans')->get();
        $news = News::findOrFail($id);
        $news->load(['trans', 'images']);

        return view('admin.pages.news.edit', compact('news', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->getSanitized();
        $news = News::findOrFail($id);
        $news->update($data);
        $news->categories()->sync($data['category']);
        $news->tags()->sync($data['tags']);

        if ($request->hasFile('image')) {
            $news->images()->delete();
            foreach ($request->file('image') as $image) {
                $imagePath = 'attachments/news/' . $image->getClientOriginalName(); 
                $image->move(public_path('attachments/news'), $image->getClientOriginalName()); 
                NewAttachment::create([
                    'new_id' => $news->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.news.index')->with('success', __('Updated Successfully'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', __('Deleted Successfully'));
    }
    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
            $news = news::findMany($request['record']);
            foreach ($news as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $news = news::findMany($request['record']);
            foreach ($news as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $news = news::findMany($request['record']);
            foreach ($news as $item) {
                $item->delete();
            }

            return redirect()->route('admin.news.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
