<?php

namespace App\Http\Controllers\Publisher\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\DatePackageProduct;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        //get team manger
        $data_package_unit = DatePackageProduct::query()->where('user_id', $user_id)->get()->pluck('product_id');
        // dd($data_package_unit);
        $team = Team::query()->where('manger_id', $user_id)->first();
        if ($team) {
            $my_members = $team->teams()->pluck('user_id')->toArray();
            $units = Product::query()->with(['images', 'trans'])
                ->whereNotIn('id', $data_package_unit)
                ->where(function ($query) use ($user_id, $my_members) {
                    $query->where('user_id', $user_id)
                        ->orWhereIn('user_id', $my_members);
                })->active(1)->approve(1)
                ->filter($request->query())
                ->get();

            return view('publisher.pages.advertisement.index', compact('units'));
        } else {
            return view('publisher.dashboard')->with('error', 'You are not have a team manger');
        }
    }
}
