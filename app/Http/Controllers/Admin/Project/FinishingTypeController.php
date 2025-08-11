<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\FinishingType;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinishingTypeRequest;

class FinishingTypeController extends Controller
{
    public function create($projectId)
    {
        $project = Project::with('finishing_type')->findOrFail($projectId);
        return view('admin.pages.project.finishing_type.create',compact('project'));
    }

    public function store(FinishingTypeRequest $request)
    {
        
        $data = $request->getSanitized();
        $finishing_unit= FinishingType::create($data);
        $projectId = $finishing_unit->project_id;
        return redirect()->route('admin.type-finishing.create',$projectId)->with('success', __('Created successfully'));
 
    }


    public function update(FinishingTypeRequest $request, $id)
    {
        $finishing_unit = FinishingType::findOrFail($id);

        $data = $request->getSanitized();
        $finishing_unit->update($data);
        return redirect()->route('admin.type-finishing.create',$finishing_unit->project_id)->with('success', __('Updated successfully'));
    }


    public function destroy($id)
    {
        $finishing_unit = FinishingType::findOrFail($id);
        
        $finishing_unit->delete();
        return redirect()->back()->with('success', __('Deleted successfully'));
    }
}
