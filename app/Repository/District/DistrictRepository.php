<?php

namespace App\Repository\District;

use App\Models\District;
use App\Interface\District\DistrictInterface;

class DistrictRepository implements DistrictInterface
{
    public function index($pagination_count)
    {
        $districts = District::query()->with(['trans','country','state','city'])->get();
        return view('admin.pages.district.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return view('admin.pages.district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $data = $request->getSanitized();
        $district = District::create($data);
        return redirect()->back()->with('success',__('Created Sucessfully'));
    }

    
    public function edit($id)
    {
        $district = District::findOrFail($id);
        $district->load('trans','country','city','state');
        return view('admin.pages.district.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $data = $request->getSanitized();
        $district = District::findOrFail($id);
        $district->update($data);
        return redirect()->route('admin.districts.index')->with('success',__('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {  
        $district = District::findOrFail($id);
       $district->delete();
        return redirect()->back()->with('success',__('Deleted Sucessfully'));
    }
    public function actions($request)
    {
       
        if ($request['publish'] == 1) {
            $district = District::findMany($request['record']);
            foreach ($district as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $district = District::findMany($request['record']);
            foreach ($district as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $district = District::findMany($request['record']);
            foreach ($district as $item) {
                $item->delete();
            }

            return redirect()->route('admin.districts.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}

