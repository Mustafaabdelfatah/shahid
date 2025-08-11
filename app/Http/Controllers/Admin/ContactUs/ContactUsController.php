<?php

namespace App\Http\Controllers\Admin\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = ContactUs::query()->get();
        return view('admin.pages.contact.index', compact('contact'));
    }



    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contact)
    {
        $contact->load;
        return view('admin.pages.contact.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contact  )
    {
        $contact->delete();
        return redirect()->back()->with('success', __('Deleted Sucessfully'));
    }
}
