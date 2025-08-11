<?php

namespace App\Http\Controllers\Admin\Country;

use pagination;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Interface\Country\CountryInterface;

class CountryController extends Controller
{
    public CountryInterface $countries;

    public function __construct(CountryInterface $countries)
    {
        $this->countries = $countries;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->countries->index($this->pagination_count);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      return $this->countries->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request) 
    {
        return $this->countries->store($request);
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
        return $this->countries->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request,$id)
    {
        return $this->countries->update($request,$id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->countries->destroy($id);
    }

    public function actions(Request $request){
        return $this->countries->actions($request);
    }
}
