<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Service;
use App\Models\Team;
use App\Models\User;
use App\Models\Product;
use App\Models\Project;
use App\Models\Category;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public User $user;

    public function __construct(User $user, Product $Product)
    {
        $this->user = $user;
    }

    public function index()
    {

        $data['brokers'] = $this->user->where('role', 'broker')->count();
        $data['clients'] = $this->user->where('role', 'client')->count();
        $data['team'] = Team::query()->where('status', '1')->count();
        $data['agencies'] = $this->user->where('role', 'agency')->count();
        $data['unit_onwer'] = $this->user->where('role', 'unit_onwer')->count();
        $data['categories'] = Category::query()->count();
        $data['units'] = Product::query()->count();
        $data['published_products'] = Product::query()->where('status', '1')->count();
        $data['unpublished_products'] = Product::query()->where('status', '0')->count();
        $data['approved_products'] = Product::query()->where('approve', '1')->count();
        $data['services'] = Service::query()->where('status', '1')->count();
        $data['projects'] = Project::query()->count();

        return view('admin.pages.index', $data);
    }
}
