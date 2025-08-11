<?php

namespace App\Http\Controllers\Publisher\Package;


use App\Models\Package;
use App\Models\Product;
use App\Models\DatePackage;
use Illuminate\Http\Request;
use App\Models\DatePackageProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Publisher\PackageRequest;

class PackageController extends Controller
{
    public function choose_package($id)
    {

        $unit = Product::query()->with('trans')->where('id', $id)->first();

        return view('publisher.pages.package.choose_package',compact('unit'));
    }

    public function store(PackageRequest $request)
    {
        $data = $request->getSanitized();
           // Get duration
            $duration = DatePackage::query()->where('id', $data['date_package_id'])->first();
            // Calculate end date based on duration
            $end_date = now()->addDays($duration->duration);
            $date_package_product = new DatePackageProduct();
            $date_package_product->user_id = $data['user_id'];
            $date_package_product->package_id = $data['package_id'];
            $date_package_product->product_id = $data['unit_id'];
            $date_package_product->date_id = $data['date_package_id'];
            // Assign start date and end date
            $date_package_product->start_date = now();
            $date_package_product->end_date = $end_date;
            $date_package_product->save();
            //add the virable in sesstions 

            return redirect()->route('publisher.advertisements.index')->with('success', __('Choose Package Success'));
    }


    public function my_ads()
    {
        $user_id = Auth::user()->id;
        $unit_package = DatePackageProduct::query()->with(['package', 'date', 'product'])->active(1)->where('user_id', $user_id)->get();

        return view('publisher.pages.package.my_ads',compact('unit_package'));
    }
}
