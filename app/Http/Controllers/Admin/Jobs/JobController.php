<?php
namespace App\Http\Controllers\Admin\Jobs;


use App\Models\Job;
use App\Models\CategoryJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::query()->paginate(10);
        return view('admin.pages.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_job = CategoryJob::query()->with('trans')->get();

        return view('admin.pages.jobs.create' , compact('category_job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'address' => 'nullable',
            'description' => 'nullable',
            'category_job_id' => 'nullable|exists:category_jobs,id',

        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::find($id);
        $Jop_Registers = $job->Jop_Registers; // سيجلب جميع الطلبات المرتبطة بهذه الوظيفة

        return view('admin.pages.jobs.show', compact('job', 'Jop_Registers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category_job = CategoryJob::query()->with('trans')->get();
        $job = Job::find($id);
        $currentPage = request('page', 1);

        return view('admin.pages.jobs.edit', compact('job', 'currentPage' ,'category_job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable',
            'address' => 'nullable',
            'description' => 'nullable',
            'category_job_id' => 'nullable|exists:category_jobs,id',

        ]);

        Job::find($id)->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Job::find($id)->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
