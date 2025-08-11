<?php
namespace App\Http\Controllers\Admin\CategoryJob;


use App\Models\CategoryJob;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryJobRequest;

class CategoryJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_job = CategoryJob::query()->with('trans')->get();
        return view('admin.pages.category_job.index', compact('category_job'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category_job.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryJobRequest $request)
    {
        // dd($request);
        $data = $request->getSanitized();
        // dd($data);
        $category_job = CategoryJob::create($data);
        return redirect()->back()->with('success', __('Created Sucessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category_job = CategoryJob::with('trans')->findOrFail($id);
        return view('admin.pages.category_job.edit', compact('category_job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryJobRequest $request, string $id)
    {
        $data = $request->getSanitized();
        $category_job = CategoryJob::findOrfail($id);
        $category_job->update($data);
        return redirect()->route('admin.category_job.index')->with('success', __('Updated Sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category_job = CategoryJob::findOrfail($id);
        $category_job->delete();
        return redirect()->route('admin.category_job.index')->with('success', __('Deleted Sucessfully'));
    }
    public function showDeleted()
    {
        $category_job = CategoryJob::getAllDeleted();

        return view('admin.pages.category_job.deleted.index', compact('category_job'));
    }
    public function restore($id)
    {
        try {
            $category_job = CategoryJob::restoreCategory_job($id);
            return redirect()->back()->with('success', 'category job restored successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore category job: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $category_job = CategoryJob::forceDeleteCategory_job($id);
            return redirect()->back()->with('success', 'category_job permanently deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete category job: ' . $e->getMessage());
        }
    }
}
