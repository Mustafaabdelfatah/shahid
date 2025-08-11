<?php

namespace App\Http\Controllers\Broker;

use App\Models\Product;
use App\Models\Category;
use App\Models\AttachmentProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interface\ProductIntrerface;
use Illuminate\Support\Facades\Auth;
use App\Interface\BrokerProductIntrerface;
use App\Http\Requests\Broker\ProductRequest;

class ProductController extends Controller
{

    public BrokerProductIntrerface $products;
    /**
     * Display a listing of the resource.
     */

     public function __construct(BrokerProductIntrerface $products)
     {
         $this->products = $products;
     }

     public function index()
    {
        return $this->products->index();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->products->create();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        return $this->products->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->products->show($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return $this->products->edit($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,Product $product)
    {
        return $this->products->update($product, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->products->destroy($product);
    }
}
