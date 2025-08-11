<?php
namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;
use App\Models\HomeSettingPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomePageRequest;

class HomeSettingpageController extends Controller
{
    public function index(){
        $homeSettings = HomeSettingPage::query()->with('trans')->get();
        return view('admin.pages.page.index',compact('homeSettings'));
    }

    public function edit($id){
        $homeSetting = HomeSettingPage::findOrFail($id);
        return view('admin.pages.page.edit',compact('homeSetting'));
    }

    public function update(HomePageRequest $request, $id)
    {
        $data = $request->getSanitized();
        $homeSetting = HomeSettingPage::findOrFail($id);
        $homeSetting->update($data);
        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.page.index');
    }
    public function update_status($id)
    {
        $homeSetting = HomeSettingPage::findOrfail($id);
        $homeSetting->status == 1 ? $homeSetting->status = 0 : $homeSetting->status = 1;
        $homeSetting->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }
}

