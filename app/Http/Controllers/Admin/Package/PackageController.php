<?php

namespace App\Http\Controllers\Admin\Package;

use App\Models\Package;
use App\Models\DatePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Interface\Package\PackageInterface;
use App\Services\Package\PackageCreateServices;
use App\Services\Package\PackageUpdateServices;

class PackageController extends Controller
{
    public PackageInterface $packages;

    public function __construct(PackageInterface $packages)
    {
        $this->packages = $packages;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->packages->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->packages->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request,PackageCreateServices $packageCreateServices)
    {
        return $this->packages->store($request,$packageCreateServices);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->packages->show($id);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->packages->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, $id,PackageUpdateServices $packageUpdateServices)
    {
        return $this->packages->update($request,$id,$packageUpdateServices);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->packages->destroy($id);
    }

    public function delete_data($id)
    {
        return $this->packages->delete_data($id);
    }
}
