<?php
namespace App\Http\Controllers\Admin\ServiceProvided;



use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\ServiceProvided;
use App\Http\Controllers\Controller;

class ServiceProvidedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service_provided = ServiceProvided::query()->get();
        return view('admin.pages.service_provided.index', compact('service_provided'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service_provided = ServiceProvided::findOrFail($id);

        return view('admin.pages.service_provided.show', compact('contservice_providedact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service_provided = ServiceProvided::findOrFail($id);
        $service_provided->delete();
        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }
}
