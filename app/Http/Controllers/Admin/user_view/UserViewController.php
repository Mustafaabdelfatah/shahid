<?php
namespace App\Http\Controllers\Admin\user_view;



use App\Models\User;
use App\Models\View;
use App\Models\Product;
use App\Models\UserView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserViewController extends Controller
{
    public function index()
    {
        $user_view = UserView::query()->with(['product', 'user'])->get();

        return view('admin.pages.view.index', compact('user_view'));
    }

    public function create()
    {
        $product = Product::query()->with('trans')->get();
        $user = User::query()->get();
        return view('admin.pages.view.create', compact('product', 'user'));
    }

    public function store(Request $request)
    {
        UserView::create($request->all());
        return redirect()->route('admin.user_view.index')->with('success', 'Created Succesfully');
    }

    public function destroy($id)
    {
        UserView::destroy($id);
        return redirect()->route('admin.user_view.index')->with('success', 'Deleted Succesfully');
    }
}
