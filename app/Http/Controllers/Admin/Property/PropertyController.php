<?php

namespace App\Http\Controllers\Admin\Property;

use pagination;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = PropertyType::query()->with('trans')->paginate($this->pagination_count);
        return view('admin.pages.property.index' , compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.property.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        $data = $request->getSanitized();

        $properties = PropertyType::create($data);
        return redirect()->route('admin.properties.index')->with('success','Created Sucessfully');
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
        $properties = PropertyType::find($id);
        return view('admin.pages.property.edit', compact('properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, $id)
    {
        $data = $request->getSanitized();
        $property = PropertyType::findOrFail($id);
        $property->update($data);
        // dd($properties);
        return redirect()->route('admin.properties.index')->with('success',__('Updated Sucessfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success',__('Deleted Successfully'));
    }

    public function update_status($id)
    {
        $properties = PropertyType::findOrfail($id);
        $properties->status == 1 ? $properties->status = 0 : $properties->status = 1;
        $properties->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }

    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
             $properties = PropertyType::findMany($request['record']);
            foreach ( $properties as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
             $properties = PropertyType::findMany($request['record']);
            foreach ( $properties as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
             $properties = PropertyType::findMany($request['record']);
            foreach ( $properties as $item) {
                $item->delete();
            }

            return redirect()->route('admin.properties.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }

}
