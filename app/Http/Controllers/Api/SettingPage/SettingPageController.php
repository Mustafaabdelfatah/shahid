<?php

namespace App\Http\Controllers\Api\SettingPage;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\HomeSettingPage;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingPage\SettingPageResource;

class SettingPageController extends Controller
{
    public HomeSettingPage $mdoel;

    public function __construct(HomeSettingPage $mdoel)
    {
        $this->mdoel = $mdoel;
    }
    public function home()
    {
        $home = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'home')->first();
        if (!$home) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting home', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting home retrieved successfully', new SettingPageResource($home));
    }
    public function about()
    {
        $about = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'about')->first();
        if (!$about) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting about retrieved successfully', new SettingPageResource($about));
    }
    public function vission()
    {
        $vission = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'vission')->first();
    
        if (!$vission) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting vission about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting vission retrieved successfully', new SettingPageResource($vission));
    }

    public function mission()
    {
        $mission = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'mission')->first();
        if (!$mission) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting mission about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting mission retrieved successfully', new SettingPageResource($mission));
    }
    public function our_message()
    {
        $our_message = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'our_message')->first();
        if (!$our_message) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting our_message about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting our_message retrieved successfully', new SettingPageResource($our_message));
    }
    public function why_choose_us()
    {
        $why_choose_us = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'why_choose_us')->first();
        if (!$why_choose_us) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting why_choose_us about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting why_choose_us retrieved successfully', new SettingPageResource($why_choose_us));
    }
    public function contact_us()
    {
        $contact_us = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'contact_us')->first();
        if (!$contact_us) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting contact_us about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting contact_us retrieved successfully', new SettingPageResource($contact_us));
    }
    public function footer()
    {
        $footer = $this->mdoel->query()->with('trans')->active(1)->where('title_section', 'footer')->first();
        if (!$footer) {
            return ApiResponse::apiResponse(JsonResponse::HTTP_NOT_FOUND,  'No setting footer about', []);
        }
        return ApiResponse::apiResponse(JsonResponse::HTTP_OK,  'Setting footer retrieved successfully', new SettingPageResource($footer));
    }
}
