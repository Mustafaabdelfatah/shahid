<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Team;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class BrokerController extends Controller
{
    //
    public function index()
    {
        $brokers = User::query()
            ->whereRole('broker')
            ->withCount('products')
            ->get();

        return view('admin.pages.broker.index', compact('brokers'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $team = Team::query()->with(['user', 'teams'])->where('manger_id', $user->id)->first();

        // Check if the team exists
        if (!$team) {
            return redirect()->back()->with('error', __('No team found for the manager.'));
        }

        // Check if the team has members
        if (!$team->teams()->exists()) {
            return redirect()->back()->with('success', __('No units here!'));
        }

        // Get members of the team
        $my_members = $team->teams()->pluck('user_id')->toArray();

        // Get products associated with the team members
        $units = Product::query()->with(['trans', 'category'])->whereIn('user_id', $my_members)->active(1)->approve(1)->get();

        return view('admin.pages.broker.show', compact('user', 'team', 'units'));
    }

}
