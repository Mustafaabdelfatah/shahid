<?php

namespace App\Http\Controllers\Admin\Project;

use Exception;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Interface\Project\ProjectInterface;

class ProjectController extends Controller
{
    public ProjectInterface $projects;
    public function __construct(ProjectInterface $projects)
    {
        $this->projects = $projects;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return $this->projects->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->projects->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // dd($request->all());
        return $this->projects->store($request);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->projects->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, $id)
    {
        return $this->projects->update($request, $id);
    }



    /**
     * Remove the specified resource from storage.
     */

    public function show($id)
    {
        return $this->projects->show($id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->projects->destroy($id);
    }

    public function update_status($id)
    {
        return $this->projects->update_status($id);
    }
    public function delete_sigle_image($id)
    {
        return $this->projects->delete_sigle_image($id);
    }
    public function actions(Request $request)
    {

        return $this->projects->actions($request);
    }
    public function showDeleted()
    {
        $projects = Project::getAllDeleted();

        return view('admin.pages.project.deleted.index', compact('projects'));
    }
    public function restore($id)
    {
        try {
            $projects = Project::restoreProject($id);
            return redirect()->back()->with('success', 'Project restored successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore Project: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $projects = Project::forceDeleteProject($id);
            return redirect()->back()->with('success', 'Project permanently deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Project: ' . $e->getMessage());
        }
    }
}