<?php
namespace App\Interface\Gates;


interface GatesInterface 
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function show($id);
    public function destroy($id);
    public function update_status($id);  
}
