<?php

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Interface\City\CityInterface;

class CityController extends Controller
{
    public CityInterface $cities;

    public function __construct(CityInterface $cities)
    {
        $this->cities = $cities;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cities->index($this->pagination_count);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->cities->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        return $this->cities->store($request);
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
        return $this->cities->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $id)
    {
        return $this->cities->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->cities->destroy($id);
    }
    public function actions(Request $request){
        return $this->cities->actions($request);
    }
}

