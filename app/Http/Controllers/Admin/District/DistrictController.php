<?php

namespace App\Http\Controllers\Admin\District;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Interface\District\DistrictInterface;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public DistrictInterface $districts;

    public function __construct(DistrictInterface $districts)
    {
        $this->districts = $districts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->districts->index($this->pagination_count);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->districts->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request)
    {
        return $this->districts->store($request);
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
        return $this->districts->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, $id)
    {

        return $this->districts->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->districts->destroy($id);
    }

    public function actions(Request $request)
    {
        return $this->districts->actions($request);
    }
}
