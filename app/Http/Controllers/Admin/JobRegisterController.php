<?php

namespace App\Http\Controllers\Admin;

use App\Models\JopRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobRegisterController extends Controller
{
public function index()
{
        $jobs= JopRegister::with('job')->get();
        return view('admin.pages.job_register.index',compact('jobs'));
}

public function destroy($id)
{
    $job= JopRegister::findOrFail($id);
    $job->delete();
    session()->flash('success', __('Deleted Sucessfully'));
    return redirect()->back();
}
}
