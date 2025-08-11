<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->filter($request->query())
            ->withCount('products')
            ->get();

        return view('admin.pages.publisher.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->getSanitized();
        $user = User::create($data);

        return redirect()->back()->with('success', __('Created Sucessfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.pages.publisher.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->getSanitized();
        $user = User::findOrFail($id);
        if ($request->password == null) {
            $data['password'] = $user->password;
        }

        $user->update($data);

        return redirect()->back()->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }

    public function update_status($id)
    {
        $user = User::findOrfail($id);
        $user->status == 1 ? $user->status = 0 : $user->status = 1;
        $user->save();
        session()->flash('success', __('Updated Sucessfully'));

        return redirect()->back();
    }

    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $user = User::findMany($request['record']);
            foreach ($user as $item) {
                $item->update(['status' => 1]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $user = User::findMany($request['record']);
            foreach ($user as $item) {
                $item->update(['status' => 0]);
            }
            session()->flash('success', __('Updated Sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $user = User::findMany($request['record']);
            foreach ($user as $item) {
                $item->delete();
            }

            return redirect()->route('admin.pages.publisher.index')->with('success', __('Deleted Sucessfully'));

        }

        return redirect()->back();
    }
    public function showUnits(User $user)
    {
        $products = Product::where('user_id', $user->id)->get();
        $categories = Category::query()->with('trans')->get();

        return view('admin.pages.broker.units', compact('products', 'user', 'categories'));
    }
}
