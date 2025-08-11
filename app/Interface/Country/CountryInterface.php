<?php

namespace App\Interface\Country;

interface CountryInterface
{
    public function index($pagination_count);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function actions($request);

}
