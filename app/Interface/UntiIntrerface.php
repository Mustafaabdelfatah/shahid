<?php

namespace App\Interface;

interface UntiIntrerface
{
    public function index($request);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($id, $request);

    public function show($id);

    public function destroy($id);

    public function actions($request);
}
