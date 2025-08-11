<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::query()->get();
        return view('admin.pages.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        $data = $request->getSanitized();
        Feature::create($data);
        return redirect()->back()->with('success', __('Created Sucessfully'));
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
      $feature=   Feature::with('trans')->findOrFail($id);
      return view('admin.pages.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request, string $id)
    {
        $feature=   Feature::findOrFail($id);
        $data = $request->getSanitized();
        $feature->update($data);
        return redirect()->back()->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feature=   Feature::findOrFail($id);
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', __('Deleted Sucessfully'));
    }
}