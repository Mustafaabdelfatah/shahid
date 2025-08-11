<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;

class SettingWebController extends Controller
{
    public function index()
    {
        $setting = Setting::query()->where('type','websit')->first();
        return view('admin.pages.setting.web_setting',compact('setting'));
    }

    public function update(UpdateSettingsRequest $request,Setting $setting){
        $data = $request->getSanitized();

        $data['type'] = 'websit';
        $setting->UpdateOrCreate(['type' => 'websit'], $data);
        return redirect()->back()->with('success','Setting Dashboard Updated Successfully');
    }
}
