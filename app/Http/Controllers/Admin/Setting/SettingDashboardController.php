<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\SettingDashboard;
use App\Http\Controllers\Controller;

class SettingDashboardController extends Controller
{
    public function index()
    {
        $setting = Setting::query()->where('type','dashboard')->first();

        return view('admin.pages.setting.dashboard_setting',compact('setting'));
    }

    public function update(Request $request , Setting $setting){
        // dd($setting);
        $this->validate($request,[
            'image_main_light_mode' => 'nullable|image',
            'image_sm_light_mode' => 'nullable|image',
            'image_main_dark_mode' => 'nullable|image',
            'image_sm_dark_mode' => 'nullable|image',
        ]);
        $setting->update($request->all());
        return redirect()->back()->with('success','Setting Dashboard Updated Successfully');
    }
}
