<?php

namespace App\Http\Controllers\Admin\State;

use pagination;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StateRequest;
use App\Http\Controllers\Controller;
use App\Interface\State\StateInterface;

class StateController extends Controller
{
    public StateInterface $states;

    public function __construct(StateInterface $states)
    {
        $this->states = $states;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->states->index($this->pagination_count);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->states->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        return $this->states->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->states->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, $id)
    {

        return $this->states->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->states->destroy($id);
    }
    public function actions(Request $request){
        return $this->states->actions($request);
    }
}
