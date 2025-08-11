<?php

namespace App\Http\Controllers\Admin\Service;

use App\Models\Feature;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\CategoryService;
use App\Models\AttachmentProduct;
use App\Models\ServiceAttachment;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services= Service::query()->with(['trans','category_service', 'images','create_by'])->paginate(10);
        return view('admin.pages.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_service = CategoryService::query()->with('trans')->get();
        $features = Feature::query()->with('trans')->get();
        return view('admin.pages.service.create' ,  compact('category_service','features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->getSanitized();

        $service=Service::create($data);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $attachmentservice = ServiceAttachment::create([
                    'service_id' => $service->id,
                    'image' => $image,
                ]);
            }
        }
        if ($request->has('features')) {
            $service->features()->attach($data['features']);
        }
        return redirect()->back()->with('success',__('Created Sucessfully'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $currentPage = request('page', default: 1);
        $category_service = CategoryService::query()->with('trans')->get();
        $features = Feature::query()->with('trans')->get();
        return view('admin.pages.service.edit',compact('service','currentPage', 'category_service','features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->getSanitized();

        $service->update($data);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $attachmentservice = ServiceAttachment::create([
                    'service_id' => $service->id,
                    'image' => $image,
                ]);
            }
        }
        if ($request->has('features')) {
            $service->features()->sync($data['features']);
        }
        // return redirect()->back()->with('success',__('Updated Sucessfully'));
        return redirect()->route('admin.services.index',['page' => $request->input('page', 1)])->with('success', __('Updated Successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('success',__('Deleted Sucessfully'));
    }


    public function update_status($id)
    {
        $service = Service::findOrfail($id);
        $service->status == 1 ? $service->status = 0 : $service->status = 1;
        $service->save();
        session()->flash('success', __('Updated Sucessfully'));
        return redirect()->back();
    }
    public function delete_sigle_image($id)
    {
        $image = ServiceAttachment::findOrFail($id);
        @unlink($image->link_image);
        $image->delete();

        return redirect()->back();
    }
}
