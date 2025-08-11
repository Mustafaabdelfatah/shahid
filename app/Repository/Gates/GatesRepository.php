<?php

namespace App\Repository\gates;

use pagination;
use App\Models\Gates;
use App\Http\Requests\GatesRequest;
use App\Interface\Gates\GatesInterface;

class GatesRepository implements GatesInterface
{
    public function index()
    {
        $gates = Gates::query()->get();
        return view('admin.pages.gates.index', compact('gates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.gates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $gates = Gates::create($request->all());
        return redirect()->route('admin.gates.index')->with('success', 'Created Successfuly');
    }

    public function edit($id)
    {
        $gates = Gates::findOrFail($id);
        $gates->load('trans');
        return view('admin.pages.gates.edit', compact('gates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $data = $request->getSanitized();
        $gates = gates::findOrFail($id);
        $gates->update($data);
        return redirect()->route('admin.gates.index')->with('success', __('Updated Sucessfully'));
    }

    public function show($id)
    {
        $gates = gates::findOrFail($id);
        $gates->load(['trans','units']);
        return view('admin.pages.gates.show', compact('gates'));
    }
    /**
     * Remove the specified resource from storage. 
     */
    public function destroy($id)
    {
        $gates = gates::findOrFail($id);
        $gates->delete();
        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }
    public function update_status($id)
    {
        $gates = Gates::findOrfail($id);
        $gates->status == 1 ? $gates->status = 0 : $gates->status = 1;
        $gates->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }

}
