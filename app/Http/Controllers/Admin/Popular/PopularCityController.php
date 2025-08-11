<?php

namespace App\Http\Controllers\Admin\Popular;

use App\Http\Controllers\Controller;
use App\Http\Requests\Popular\PopularCityRequest;
use App\Models\PopularCity;
use App\Models\PopularCityUnit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopularCityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularCity = PopularCity::query()->with(['popular_city_unit', 'city'])->paginate($this->pagination_count);

        return view('admin.pages.popular.city.index', compact('popularCity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.popular.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PopularCityRequest $request)
    {
        // dd($data);
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $popular_city = PopularCity::Create($data);
            // dd($data['unit_id']);
            foreach ($data['unit_id'] as $item) {
                $popularCityUnit = new PopularCityUnit();
                $popularCityUnit->unit_id = $item;
                $popularCityUnit->popular_city_id = $popular_city->id;
                $popularCityUnit->save();
            }
            DB::commit();

            return redirect()->route('admin.popular_cities.index')->with('success', 'Popular City Created Successfully');
        } catch (Exception $e) {
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
    public function edit(PopularCity $popularCity)
    {
        $popularCity->load(['popular_city_unit', 'city']);

        return view('admin.pages.popular.city.edit', compact('popularCity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PopularCityRequest $request, PopularCity $popularCity)
    {
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $unitIds = $data['unit_id'];

            // Delete existing PopularCityUnit records for the popular city
            $popularCity->popular_city_unit()->delete();

            // Create new PopularCityUnit records
            foreach ($unitIds as $unitId) {
                PopularCityUnit::updateOrCreate(
                    [
                        'popular_city_id' => $popularCity->id,
                        'unit_id' => $unitId,
                    ],
                    [
                        'popular_city_id' => $popularCity->id,
                        'unit_id' => $unitId,
                    ]
                );
            }
            DB::commit();

            return redirect()->route('admin.popular_cities.index')->with('success', 'Popular City Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PopularCity $popularCity)
    {
        $popularCity->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function update_status($id)
    {
        $popularCity = PopularCity::findOrfail($id);
        $popularCity->status == 1 ? $popularCity->status = 0 : $popularCity->status = 1;
        $popularCity->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $popularCity = PopularCity::findMany($request['record']);

            foreach ($popularCity as $item) {
                $item->update(['status' => 1]);

            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $popularCity = PopularCity::findMany($request['record']);
            foreach ($popularCity as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $popularCity = PopularCity::findMany($request['record']);
            foreach ($popularCity as $item) {
                $item->delete();
            }

            return redirect()->route('admin.popular_cities.index')->with('success', __('Deleted Sucessfully'));
        }

        return redirect()->back();
    }
}
