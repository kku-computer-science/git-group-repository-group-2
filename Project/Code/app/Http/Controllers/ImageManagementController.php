<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;

class ImageManagementController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('image_management.index', compact('banners')); // ส่งไปที่ Blade Template
    }
}
