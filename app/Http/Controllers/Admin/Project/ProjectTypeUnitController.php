<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use App\Models\TypesUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeUnitRequest;

class ProjectTypeUnitController extends Controller
{
    public function create($projectId)
    {
        $project = Project::with('type_units')->findOrFail($projectId);
        return view('admin.pages.project.type_unit.create',compact('project'));
    }


    public function store(TypeUnitRequest $request)
    {

        $data = $request->getSanitized();
        $type_unit= TypesUnit::create($data);

        $projectId = $type_unit->project_id;
        return redirect()->route('admin.type-units.create',$projectId)->with('success', __('Created successfully'));

    }


    public function update(TypeUnitRequest $request, $id)
    {
        $type_unit = TypesUnit::findOrFail($id);

        $data = $request->getSanitized();
        $type_unit->update($data);
        return redirect()->route('admin.type-units.create',$type_unit->project_id)->with('success', __('Updated successfully'));
    }


    public function destroy($id)
    {
        $type_unit = TypesUnit::findOrFail($id);

        $type_unit->delete();
        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
