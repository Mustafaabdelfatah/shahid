<?php

namespace App\Http\Controllers\Publisher\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publisher\TeamRequest;
use App\Models\Product;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public User $model;

    public Team $team;

    public function __construct(User $model, Team $team)
    {
        $this->model = $model;
        $this->team = $team;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = $this->team->query()->with(['user', 'teams'])->where('manger_id', Auth::user()->id)->first();

        return view('publisher.pages.team.index', compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $employees = $this->model->query()->active(1)->where('role', 'employee')->where('parent_id', $user_id)->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('team_users');
        })->get();

        if ($this->team->where('manger_id', $user_id)->exists()) {
            return redirect()->route('publisher.teams.index')->with('error', __('You Have Team Already'));
        } else {
            return view('publisher.pages.team.create', compact('employees'));
        }
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

            return redirect()->route('publisher.teams.index')->with('success', __('Created Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team_user = TeamUser::with('team')->where('user_id', $id)->first();
        if (! $team_user) {
            return redirect()->back()->with('error', __('You do not manage any team.'));
        }

        return view('publisher.pages.team.show', compact('team_user', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $team->load(['teams', 'user']);
        $user_id = Auth::user()->id;
        $my_members = $team->teams()->get();

        $team_members_author = $this->model->query()->active(1)->where('role', 'employee')->where('parent_id', $user_id)->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('team_users');
        })->get();
        $members = $team_members_author->merge($my_members);

        return view('publisher.pages.team.edit', compact('team', 'members'));
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

            return redirect()->route('publisher.teams.index')->with('success', __('Updated Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
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

    public function delete_mebmers(Request $request)
    {
        $employee_teams = TeamUser::where('user_id', $request->id)->first();
        $employee_teams->delete();
        session()->flash('success', __('Deleted Sucessfully'));

        return redirect()->back();
    }

    public function employee_projects($id)
    {
        $user = $this->model->where('id', $id)->first();
        $products = Product::query()->with(['trans', 'category'])->where('user_id', $user->id)->get();
        return view('publisher.pages.team.product_employee', compact('products'));
    }
}
