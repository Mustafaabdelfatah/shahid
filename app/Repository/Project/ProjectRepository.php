<?php

namespace App\Repository\Project;

use Log;
use pagination;
use App\Models\User;
use App\Models\Project;
use App\Models\PropertyType;
use App\Models\AttachmetProject;
use Illuminate\Support\Facades\DB;
use App\Interface\Project\ProjectInterface;

class ProjectRepository implements ProjectInterface
{
    public function index($request)
    {
        $buildings = Project::query()->with('trans')->filter($request->query())
            ->paginate(10);
        return view('admin.pages.project.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'agency')->get();
        $propertys = PropertyType::query()->with('trans')->get();
        return view('admin.pages.project.create', compact('users', 'propertys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getSanitized();
            $project = Project::create($data);
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    AttachmetProject::create([
                        'project_id' => $project->id,
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('properties')) {
                $project->property()->attach($data['properties']);
            }
            DB::commit();
            return redirect()
                ->route('admin.buildings.edit', $project->id)
                ->with('success', __('Created Successfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Project Store Method', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()
                ->back()
                ->with('error', __('Error: ') . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $propertys = PropertyType::query()->with('trans')->get();
        $project = Project::findOrFail($id);
        $project->load(['trans', 'user', 'attachments']);
        $roles = ['agency', 'broker'];
        $users = User::whereIn('role', $roles)->get();
        $currentPage = request('page', default: 1);

        return view('admin.pages.project.edit', compact('project', 'users', 'propertys', 'currentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {

        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $project = Project::findOrFail($id);
            $project->update($data);
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $attachmentProject = AttachmetProject::create([
                        'project_id' => $project->id,
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('properties')) {
                $project->property()->sync($data['properties']);
            }
            DB::commit();
            return redirect()->route('admin.buildings.index', ['page' => $request->input('page', 1)])->with('success', __('Updated Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $project->load(['trans', 'user', 'create_by', 'attachments', 'type_units', 'units', 'property']);
        return view('admin.pages.project.show', compact('project'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
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
    public function actions($request)
    {

        if ($request['publish'] == 1) {
            $project = Project::findMany($request['record']);
            foreach ($project as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $project = Project::findMany($request['record']);
            foreach ($project as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $project = Project::findMany($request['record']);
            foreach ($project as $item) {
                $item->delete();
            }

            return redirect()->route('admin.project.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }

    public function delete_sigle_image($id)
    {
        $image = AttachmetProject::findOrFail($id);
        @unlink($image->link_image);
        $image->delete();
        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

}
