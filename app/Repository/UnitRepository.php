<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Admin;
use App\Models\Gates;
use App\Models\Product;
use App\Models\Project;
use App\Models\Category;
use App\Models\District;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Interface\UntiIntrerface;
use App\Models\AttachmentProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UnitRepository implements UntiIntrerface
{
    public function index($request)
    {
        $categories = Category::query()->with('trans')->get();
        $products = Product::query()
            ->with(['trans', 'category', 'create_by'])
            ->approve(1)
            ->filter($request->query())
            ->paginate(10);

        return view('admin.pages.unit.index', compact('products', 'categories'));
    }

    public function create()
    {
        $propertys = PropertyType::query()->with('trans')->get();
        $categories = Category::query()->with('trans')->active(1)->get();
        $gates = Gates::query()->with('trans')->get();
        $projects = Project::query()->with('trans')->active(1)->get();
        $districts = District::query()->with('trans')->active(1)->get();
        $owners = User::whereIn('role', ['agency', 'broker', 'unit_onwer'])->get();
   
        $admins = Admin::query()->get();
    
        return view('admin.pages.unit.create', compact('categories', 'propertys', 'projects', 'districts', 'gates', 'owners', 'admins'));
    }
    

    public function store($request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            // $data['admin_id'] = Auth::guard('admin')->id();
            $product = Product::create($data);
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $attachmentProduct = AttachmentProduct::create([
                        'product_id' => $product->id,
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('properties')) {
                $product->property()->attach($data['properties']);
            }

            if ($request->has('gates')) {
                $product->gates()->attach($data['gates']);
            }
            DB::commit();

            return redirect()->route('admin.units.edit', $product->id)->with('success', __('Created Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $propertys = PropertyType::query()->with('trans')->get();
        $unit = Product::findOrFail($id);
        $unit->load(['trans', 'country', 'state', 'city', 'district', 'images', 'gates']);
        $projects = Project::query()->with('trans')->get();
        $categories = Category::query()->with('trans')->active(1)->get();
        $gates = Gates::query()->with('trans')->get();
        $districts = District::query()->with('trans')->active(1)->get();
        $currentPage = request('page', 1);
        $owners = User::whereIn('role', ['agency', 'broker', 'unit_onwer'])->get();
        $admins = Admin::query()->get();

        // product == unit
        return view('admin.pages.unit.edit', compact('unit', 'categories', 'propertys', 'gates', 'projects', 'districts', 'currentPage', 'owners', 'admins'));
    }

    public function update($id, $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $data = $request->getSanitized();
            $unit = Product::findOrFail($id);
            $unit->update($data);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $attachmentProduct = AttachmentProduct::create([
                        'product_id' => $unit->id,
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('properties')) {
                $unit->property()->sync($data['properties']);
            }
            if ($request->has('gates')) {
                $unit->gates()->sync($data['gates']);
            } else {
                $unit->gates()->detach();
            }

            DB::commit();

            // return redirect()->back()->with('success', __('Updated Sucessfully'));
            return redirect()->route('admin.units.index', ['page' => $request->input('page', 1)])->with('success', __('Updated Sucessfully'));

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $projects = Project::query()->with('trans')->get();
        $unit = Product::findOrFail($id);
        $unit->load(['trans', 'country', 'state', 'city', 'gates', 'district', 'images', 'property']);
        // dd($unit);
        // product == unit
        return view('admin.pages.unit.show', compact('unit', 'projects'));
    }

    public function destroy($id)
    {
        $unit = Product::findOrFail($id);

        @unlink($unit->video);
        // @unlink($product->images()->image);
        $unit->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function actions($request)
    {

        if ($request['publish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->delete();
            }

            return redirect()->route('admin.units.index')->with('success', __('Deleted Sucessfully'));
        }

        return redirect()->back();
    }

}
