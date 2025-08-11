<?php

namespace App\Http\Controllers\Admin\Team;

use App\Models\Team;
use App\Models\User;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public User $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamss = Team::query()->with(['user','teams'])->get();
        return view('admin.pages.team.index',compact('teamss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mangers = $this->model->query()->where('role','agency')->orWhere('role','broker')->get();
        $employees = $this->model->query()->where('role','employee')->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('team_users');
        })->get();
        return view('admin.pages.team.create',compact('mangers','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $teams = Team::create($data);
            $teams->teams()->attach($data['employees']);
            DB::commit();
            return redirect()->back()->with('success',__('Created Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->load('teams');

        return view('admin.pages.team.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $team->load(['teams','user']);
        $my_members = $team->teams()->get();

        $mangers = $this->model->query()->where('role','agency')->orWhere('role','broker')->get();
        $team_members_author  = $this->model->query()->where('role','employee')->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('team_users');
        })->get();
        $members = $team_members_author->merge($my_members);

        return view('admin.pages.team.edit',compact('team','mangers','members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, Team $team)
    {

        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $team->update($data);
            $team->teams()->sync($data['employees']);
            DB::commit();
            return redirect()->back()->with('success',__('Updated Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        $team->teams()->detach();
        session()->flash('success', __('Deleted Sucessfully'));
        return redirect()->back();
    }

    public function delete_mebmers(Request $request){
        $employee_teams = TeamUser::where('user_id',$request->id)->first();
        $employee_teams->delete();
        session()->flash('success', __('Deleted Sucessfully'));
        return redirect()->back();
    }
}
