<?php

namespace App\Repository\Package;

use App\Interface\Package\PackageInterface;
use App\Models\DatePackage;
use App\Models\Package;
use App\Services\Package\PackageCreateServices;
use App\Services\Package\PackageUpdateServices;
use Illuminate\Support\Facades\DB;

class PackageRepository implements PackageInterface
{
    public function index()
    {
        $packages = Package::query()
            ->with('trans')
            ->whereNotIn('type', ['normal'])
            ->get();

        return view('admin.pages.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request, PackageCreateServices $packageCreateServices)
    {
        $packageCreateServices->create($request);

        return redirect()->back()->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        $package->load(['trans', 'package_data']);

        return view('admin.pages.package.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $package->load(['trans', 'package_data']);

        return view('admin.pages.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id, PackageUpdateServices $packageUpdateServices)
    {
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $package = Package::findOrFail($id);
            $package->update($data);
            foreach ($data['list'] as $item) {
                if ($item['price'] != null) {
                    $date_Package = new DatePackage();
                    $date_Package->price = $item['price'];
                    $date_Package->duration = $item['duration'];
                    $date_Package->package_id = $package->id;
                    $date_Package->save();
                }
            }
            DB::commit();

            return redirect()->back()->with('success', 'Created succesfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->package_data()->delete();
        $package->delete();

        return redirect()->back()->with('success', 'Deleted succesfully');
    }

    public function delete_data($id)
    {
        $package_data = DatePackage::findOrFail($id);
        $package_data->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }
}
