<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\RejectedProductRequest;
use App\Interface\UntiIntrerface;
use App\Models\AttachmentProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\RejectedProduct;
use App\Notifications\UnitApprovedNotification;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public UntiIntrerface $untiIntrerface;

    public function __construct(UntiIntrerface $untiIntrerface)
    {
        $this->untiIntrerface = $untiIntrerface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return $this->untiIntrerface->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->untiIntrerface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        return $this->untiIntrerface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        return $this->untiIntrerface->show($id);
    }

    /**
     * Show the form for editing the specified resource.U
     */
    public function edit($id)
    {

        return $this->untiIntrerface->edit($id);
    }

    /**
     * Update the specified resource in storage.d
     */
    public function update(ProductRequest $request, $id)
    {
        return $this->untiIntrerface->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->untiIntrerface->destroy($id);
    }

    public function delete_sigle_image($id)
    {
        $image = AttachmentProduct::findOrFail($id);
        @unlink($image->link_image);
        $image->delete();

        return redirect()->back();
    }

    public function update_status($id)
    {
        $product = Product::findOrfail($id);
        $product->status == 1 ? $product->status = 0 : $product->status = 1;
        $product->save();
        if ($product->status == 1) {
            $user = $product->user;  // Use the relationship as a property

            if ($user) {
                $user->notify(new UnitApprovedNotification($product));
            }
        }
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function rejected(RejectedProductRequest $request)
    {
        $data = $request->getSanitized();
        RejectedProduct::create($data);

        return redirect()->back()->with('success', 'Created succesfully');
    }

    public function active_product(Request $request)
    {
        $products = Product::query()->with(['trans', 'category'])->where('status', 1)->filter($request->query())->paginate(10);
        $categories = Category::query()->with('trans')->get();

        return view('admin.pages.unit.index', compact('products', 'categories'));
    }

    public function in_active_product(Request $request)
    {
        $products = Product::query()->with(['trans', 'category'])->where('status', 0)->approve(1)->filter($request->query())->paginate(10);
        $categories = Category::query()->with('trans')->get();

        return view('admin.pages.unit.index', compact('products', 'categories'));
    }

    public function actions(Request $request)
    {
        return $this->untiIntrerface->actions($request);
    }

    public function for_sale($id)
    {
        $product = Product::findOrfail($id);
        $product->for_sale == 1 ? $product->for_sale = 0 : $product->for_sale = 1;
        $product->save();

        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function showDeleted()
    {
        $product = Product::getAllDeleted();

        return view('admin.pages.unit.deleted.index', compact('product'));
    }

    public function restore($id)
    {
        try {
            $product = Product::restoreProduct($id);
            return redirect()->back()->with('success', 'product restored successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore product: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $product = Product::forceDeleteProduct($id);
            return redirect()->back()->with('success', 'product permanently deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
