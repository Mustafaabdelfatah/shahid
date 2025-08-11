<?php

namespace App\Http\Controllers\Publisher\Project;





use App\Models\Product;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Publisher\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $projects = Project::query()->with('trans')->where('user_id', $user_id)->get();
        return view('publisher.pages.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publisher.pages.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {

        $data = $request->getSanitized();
        dd($data);
        $project = Project::create($data);
        return redirect()->route('publisher.projects.index')->with('success', 'Created Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function show(project $project)
    {
        $project->load(['trans', 'country', 'state', 'city', 'district']);

        return view('publisher.pages.project.show', compact('project'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load(['trans', 'country', 'state', 'city', 'district']);
        // dd($project);
        return view('publisher.pages.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $Project)
    {
        $data = $request->getSanitized();
        $Project->update($data);

        return redirect()->route('publisher.projects.index')->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function update_status($id)
    {
        $project = Project::findOrfail($id);
        $project->status == 1 ? $project->status = 0 : $project->status = 1;
        $project->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }
}
