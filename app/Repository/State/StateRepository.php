<?php

namespace App\Repository\State;

use pagination;
use App\Models\State;
use App\Models\Country;
use App\Interface\State\StateInterface;

class StateRepository implements StateInterface
{
    public function index($pagination_count)
    {
        $states = State::query()->with(['country','trans'])->paginate($pagination_count);
        return view('admin.pages.state.index',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::query()->with('trans')->get();    
        return view('admin.pages.state.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $data = $request->getSanitized();
        State::create($data);
        return redirect()->back()->with('success',__('Created Sucessfully'));
    }
    public function edit($id)
    {
        $state = State::findOrfail($id);
        $state->load('country');
        $countries = Country::query()->with('trans')->get();
        return view('admin.pages.state.edit',compact('state','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request,$id)
    {
        $state = State::findOrfail($id);
        $data = $request->getSanitized();
        $state->update($data);
        return redirect()->back()->with('success',__('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $state = State::findOrfail($id);
        $state->delete();
        return redirect()->back()->with('success',__('Deleted Sucessfully'));
    }
    public function actions($request)
    {
       
        if ($request['publish'] == 1) {
            $state = State::findMany($request['record']);
            foreach ($state as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $state = State::findMany($request['record']);
            foreach ($state as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $state = State::findMany($request['record']);
            foreach ($state as $item) {
                $item->delete();
            }

            return redirect()->route('admin.countries.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
