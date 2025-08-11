<?php

namespace App\Interface;

use App\Models\Product;

interface BrokerProductIntrerface
{
    public function index($request, $pagination_count);
    public function create();
    public function store($request);
    public function edit(Product $product);
    public function update(Product $product,$request);
    public function show(Product $product);
    public function destroy(Product $product);
    public function actions($request);
   
}
