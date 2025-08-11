<?php

namespace App\Http\Controllers\Admin\Land;

use App\Models\Land;
use Illuminate\Http\Request;
use App\Http\Requests\LandRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LandController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lands = Land::query()->with('trans')->paginate(10);
        return view('admin.pages.land.index', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        return view('admin.pages.land.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LandRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->getSanitized();

            $lands = Land::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Land: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Failed to create Land: ');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land $land)
    {
        $currentPage = request('page', default: 1);

        return view('admin.pages.land.edit', compact('land','currentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LandRequest $request, Land $land)
    {
        $data = $request->getSanitized();
        $land->update($data);
        return redirect()->route('admin.lands.index',['page' => $request->input('page', 1)])->with('success', __('Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land $land)
    {
        $land->delete();
        return redirect()->route('admin.lands.index')->with('success', __('Deleted Successfully'));
    }

    public function update_status($id)
    {
        $lands = Land::findOrFail($id);
        $lands->status = $lands->status == 1 ? 0 : 1;
        $lands->save();
        session()->flash('success', __('Updated Successfully'));
        return redirect()->back();
    }



    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
            $lands = Land::findMany($request['record']);
            foreach ($lands as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $lands = Land::findMany($request['record']);
            foreach ($lands as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $lands = Land::findMany($request['record']);
            foreach ($lands as $item) {
                $item->delete();
            }

            return redirect()->route('admin.lands.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
}
