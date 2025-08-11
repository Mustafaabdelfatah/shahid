<?php

namespace App\Repository\City;

use pagination;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Http\Requests\CityRequest;
use App\Interface\City\CityInterface;

class CityRepository implements CityInterface
{
 
    public function index($pagination_count)
    {
        $cities = City::query()->with(['trans','country','state'])->paginate($pagination_count);
        return view('admin.pages.City.index' , compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::query()->with('trans')->get();
        $countries= Country::query()->with(['trans'])->get();
        return view('admin.pages.city.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $data = $request->getSanitized();
        
        $City = City::create($data);
        return redirect()->route('admin.cities.index')->with('success',__('Created Sucessfully'));
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cities = City::findOrFail($id);
        $cities->load('trans');
        $countries= Country::query()->with(['trans'])->get();
        
        return view('admin.pages.city.edit',compact('cities','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $data = $request->getSanitized();
        $cities = City::findOrFail($id);
        $cities->update($data);
        return redirect()->route('admin.cities.index')->with('success',__('Updated Sucessfully'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { $City = City::findOrFail($id);
        $City->delete();
        return redirect()->route('admin.cities.index')->with('success',__('Deleted Successfully'));
    }
    public function actions($request)
    {
       
        if ($request['publish'] == 1) {
            $City = City::findMany($request['record']);
            foreach ($City as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $City = City::findMany($request['record']);
            foreach ($City as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $City = City::findMany($request['record']);
            foreach ($City as $item) {
                $item->delete();
            }

            return redirect()->route('admin.cities.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
