<?php

namespace App\Http\Controllers\Admin\gates;

use App\Models\Gates;
use Illuminate\Http\Request;
use App\Http\Requests\GatesRequest;
use App\Http\Controllers\Controller;
use App\Interface\Gates\GatesInterface;

use Illuminate\Support\Facades\Storage;

class GatesController extends Controller
{

    public GatesInterface $Gates;
    public function __construct(GatesInterface $Gates)
    {
        $this->Gates = $Gates;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        return  $this->Gates->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  $this->Gates->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GatesRequest $request)
    {
        return  $this->Gates->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  $this->Gates->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  $this->Gates->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GatesRequest $request, string $id)
    {
        return  $this->Gates->update($request,$id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return  $this->Gates->destroy($id);

    }
    public function update_status($id)
    {
        return  $this->Gates->update_status($id);

    }
}
