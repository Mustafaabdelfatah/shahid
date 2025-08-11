<?php

namespace App\Repository\Country;

use pagination;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Interface\Country\CountryInterface;

class CountryRepository implements CountryInterface
{
    public function index($pagination_count)
    {
        $countries = Country::query()->with('trans')->paginate($pagination_count);
        return view('admin.pages.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {

        $data = $request->getSanitized();

        $country = Country::create($data);
        return redirect()->back()->with('success', __('Created Sucessfully'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $country->load('trans');
        return view('admin.pages.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $country = Country::findOrFail($id);
        $data = $request->getSanitized();
        $country->update($data);
        return redirect()->route('admin.countries.index')->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('admin.countries.index')->with('success', __('Deleted Successfully'));
    }
    public function actions($request)
    {
       
        if ($request['publish'] == 1) {
            $country = Country::findMany($request['record']);
            foreach ($country as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $country = Country::findMany($request['record']);
            foreach ($country as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $country = Country::findMany($request['record']);
            foreach ($country as $item) {
                $item->delete();
            }

            return redirect()->route('admin.countries.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
