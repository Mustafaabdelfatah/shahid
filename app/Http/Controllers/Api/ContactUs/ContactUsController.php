<?php

namespace App\Http\Controllers\Api\ContactUs;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:80|min:5',
            'email' => 'required|email',
            'subject' => 'nullable',
            'website' => 'nullable',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $contact = ContactUs::create($data);

        return response()->json([
            'message' => 'Successfully sent',
            'status' => JsonResponse::HTTP_CREATED,
            'data' => $contact,
        ]);
    }
}
