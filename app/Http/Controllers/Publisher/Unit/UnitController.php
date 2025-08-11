<?php

namespace App\Http\Controllers\Publisher\Unit;

use App\Models\Team;
use App\Models\Gates;
use App\Models\Product;
use App\Models\Project;
use App\Models\Category;
use App\Models\District;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\AttachmentProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UnitNotification;
use Illuminate\Support\Facades\Session;
use App\Notifications\ProductNotification;
use App\Http\Requests\Publisher\UnitRequest;
use Illuminate\Database\Eloquent\Collection;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {
        // $user_id = Auth::user()->id;

        $categories = Category::query()->with('trans')->get();
        //get team manger

        $isManager = Team::where('manger_id', Auth::id())->exists();

        $products = Product::query()->ownedByUser()->filter($request->query())->paginate(10);

        return view('publisher.pages.unit.index', compact('products', 'categories', 'isManager'));
    }

    public function all_unit_teams(Request $request)
    {
        $user_id = Auth::user()->id;
        $categories = Category::query()->with('trans')->get();
        // Get the team managed by the current user
        $team = Team::query()->where('manger_id', $user_id)->first();
        // Check if the team exists
        if (!$team) {
                return redirect()->back()->with('error', __('You do not manage any team.'));
            }

            // Check if the team has any members
            if (!$team->teams()->exists()) {
                return redirect()->back()->with('success', __('Please select a team to view its units'));
            }

            // Retrieve the members of the team
            $my_members = $team->teams()->pluck('user_id')->toArray();
            // Get products associated with the team members
            $products = Product::query()->whereIn('user_id', $my_members)->filter($request->query())->get();

        return view('publisher.pages.unit.unit_team', compact('products', 'categories', 'team'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $propertys = PropertyType::query()->with('trans')->get();
        $categories = Category::query()->with('trans')->active(1)->get();
        $projects = Project::query()->with('trans')->active(1)->get();
        $gates = Gates::query()->with('trans')->get();
        $districts = District::query()->with('trans')->active(1)->get();

        return view('publisher.pages.unit.create', compact('categories', 'propertys', 'gates', 'projects', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        try {
            DB::beginTransaction();

            // Step 1: Validations
            $data = $request->getSanitized();
            // Step 2: Save Data

            $unit = Product::create($data);

            // Step 3: Save Images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $attachmentProduct = AttachmentProduct::create([
                        'product_id' => $unit->id,
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('properties')) {
                $unit->property()->attach($data['properties']);
            }

            if ($request->has('gates')) {
                $unit->gates()->attach($data['gates']);
            }
            // Step 4: Save Pivot Table in properties

            // // Step 5: Save Packages Date
            // // Get Auth user
            // $user = Auth::user();

            // $unit =  $unit->id;
            // $date_package_product = $date_package_product->id;
            // Session::put('date_package_product', $date_package_product);

            //send ProductNotification
            // $user->notify(new UnitNotification($unit));

            DB::commit();

            return redirect()->back()->with('success', __('Created Successfully'));
            // return redirect()->route('publisher.orders.index');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = Product::query()->ownedByUser()->findOrFail($id);
        $unit->load(['trans', 'country', 'state', 'city', 'district', 'images', 'property', 'datePackageProduct.date','gates']);
        $propertys = PropertyType::query()->with('trans')->get();

        return view('publisher.pages.unit.show', compact('unit', 'propertys'));
    }

    /**س
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Product::query()->ownedByUser()->findOrFail($id);
        $unit->load(['trans', 'country', 'state', 'city', 'district', 'images','gates']);
        $categories = Category::query()->with('trans')->active(1)->get();
        $propertys = PropertyType::query()->with('trans')->get();
        $gates = Gates::query()->with('trans')->get();
        $districts = District::query()->with('trans')->active(1)->get();

        return view('publisher.pages.unit.edit', compact('unit', 'propertys','gates', 'categories', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, $id)
    {

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

            return redirect()->back()->with('success', __('Updated Sucessfully'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Product::findOrFail($id);

        @unlink($unit->video);
        $unit->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function delete_single_image($id)
    {
        $image = AttachmentProduct::findOrFail($id);
        @unlink($image->link_image);
        $image->delete();

        return redirect()->back();
    }

    public function update_approve($id)
    {
        $unit = Product::findOrFail($id);
        $unit->approve == 1 ? $unit->approve = 0 : $unit->approve = 1;
        $unit->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function for_sale($id)
    {
        $unit = Product::findOrfail($id);
        $unit->for_sale == 1 ? $unit->for_sale = 0 : $unit->for_sale = 1;
        $unit->save();

        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function prodcut_active(Request $request)
    {
        $user_id = Auth::user()->id;
        $products = Product::query()->with(['trans', 'category'])->where('status', 1)->where('user_id', $user_id)->filter($request->query())->get();

        $categories = Category::query()->with('trans')->get();

        return view('publisher.pages.unit.index', compact('products', 'categories'));
    }

    public function prodcut_inactive(Request $request)
    {
        $user_id = Auth::user()->id;
        $products = Product::query()->with(['trans', 'category'])->where('status', 0)->where('user_id', $user_id)->filter($request->query())->get();
        $categories = Category::query()->with('trans')->get();

        return view('publisher.pages.unit.index', compact('products', 'categories'));
    }

    public function actions(Request $request)
    {

        if ($request['publish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->update(['approve' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->update(['approve' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $item) {
                $item->delete();
            }

            return redirect()->route('publisher.units.index')->with('success', __('Deleted Sucessfully'));
        }

        return redirect()->back();
    }
}
