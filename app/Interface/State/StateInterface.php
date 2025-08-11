<?php

namespace App\Interface\State;

interface StateInterface
{
    public function index($pagination_count);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function actions($request);
}
