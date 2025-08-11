<?php

namespace App\Interface\Package;

use App\Services\Package\PackageCreateServices;
use App\Services\Package\PackageUpdateServices;

interface PackageInterface
{
    public function index();
    public function create();
    public function store($request,PackageCreateServices $packageCreateServices);
    public function edit($id);
    public function show($id);
    public function update($request,$id,PackageUpdateServices $packageUpdateServices);
    public function destroy($id);
    public function delete_data($id);
}
