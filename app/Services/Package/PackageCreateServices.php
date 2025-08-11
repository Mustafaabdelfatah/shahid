<?php

namespace App\Services\Package;

use App\Models\Package;
use App\Models\DatePackage;
use Illuminate\Support\Facades\DB;

class PackageCreateServices
{
    public function validateRequest($request)
    {
        $data = $request->getSanitized();
        return $data;
    }

    public function createPackage($data)
    {
        $package = Package::create($data);
        return $package;
    }

    public function createDatePackage($data, $package)
    {
       
        if (isset($data['list']) && $data['list'] != null) {
            foreach ($data['list'] as $item) {
                $date_Package = new DatePackage();
                $date_Package->price = $item['price'];
                $date_Package->duration = $item['duration'];
                $date_Package->package_id = $package->id;
                $date_Package->save();
            }
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $data = $this->validateRequest($request);
            $package = $this->createPackage($data);
            $this->createDatePackage($data, $package);
            DB::commit();
           
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
