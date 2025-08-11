<?php
namespace App\Interface\Category;



interface CategoryInterface
{
    public function index($pagination_count);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    // public function show($id);
    public function destroy($id);
    public function update_status($id);
    public function actions($request);
}
