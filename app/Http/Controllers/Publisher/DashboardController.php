<?php
namespace App\Http\Controllers\Publisher;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['teamManger','teams']);
   
        return view('publisher.pages.index',compact('user'));
    }
}
