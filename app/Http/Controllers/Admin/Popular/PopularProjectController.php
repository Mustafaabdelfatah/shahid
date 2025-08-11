<?php

namespace App\Http\Controllers\Admin\Popular;

use App\Http\Controllers\Controller;
use App\Http\Requests\Popular\PopularProjectCityRequest;
use App\Models\PopularCityProject;
use App\Models\PopularCityProjectMulity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopularProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popular_city = PopularCityProject::query()->with(['popular_city_project', 'city'])->paginate($this->pagination_count);

        return view('admin.pages.popular.project.index', compact('popular_city'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.popular.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PopularProjectCityRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $popular_city_project = PopularCityProject::Create($data);
            // dd($data['unit_id']);
            foreach ($data['project_id'] as $item) {
                $popularCityUnitMulity = new PopularCityProjectMulity();
                $popularCityUnitMulity->project_id = $item;
                $popularCityUnitMulity->popular_city_id = $popular_city_project->id;
                $popularCityUnitMulity->save();
            }
            DB::commit();

            return redirect()->route('admin.popular-project.index')->with('success', 'Popular City Created Successfully');
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
    public function edit($id)
    {
        $popularCity = PopularCityProject::findOrfail($id);
        $popularCity->load(['popular_city_project', 'city']);

        return view('admin.pages.popular.project.edit', compact('popularCity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PopularProjectCityRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $projectIds = $data['project_id'];
            $popularCity = PopularCityProject::findOrfail($id);

            // Delete existing PopularCityUnit records for the popular city
            $popularCity->popular_city_project()->delete();

            // Create new PopularCityUnit records
            foreach ($projectIds as $projectId) {
                PopularCityProjectMulity::updateOrCreate(
                    [
                        'popular_city_id' => $popularCity->id,
                        'project_id' => $projectId,
                    ],
                    [
                        'popular_city_id' => $popularCity->id,
                        'project_id' => $projectId,
                    ]
                );
            }
            DB::commit();

            return redirect()->route('admin.popular-project.index')->with('success', 'Popular City Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $popularCityProject = PopularCityProject::findOrfail($id);
        $popularCityProject->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function update_status($id)
    {
        $popularCity = PopularCityProject::findOrfail($id);
        $popularCity->status == 1 ? $popularCity->status = 0 : $popularCity->status = 1;
        $popularCity->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $popularCity = PopularCityProject::findMany($request['record']);

            foreach ($popularCity as $item) {
                $item->update(['status' => 1]);

            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $popularCity = PopularCityProject::findMany($request['record']);
            foreach ($popularCity as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $popularCity = PopularCityProject::findMany($request['record']);
            foreach ($popularCity as $item) {
                $item->delete();
            }

            return redirect()->route('admin.popular-project.index')->with('success', __('Deleted Sucessfully'));
        }

        return redirect()->back();
    }
}
