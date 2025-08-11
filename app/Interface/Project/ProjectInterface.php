<?php

namespace App\Interface\Project;

interface ProjectInterface 
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function show($id);
    public function destroy($id);
    public function update_status($id);
    public function actions($request);
    public function delete_sigle_image($id);
}
