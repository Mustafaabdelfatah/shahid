<?php

namespace App\Interface\District;

interface DistrictInterface
{
    public function index($pagination_count);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function actions($request);
}
