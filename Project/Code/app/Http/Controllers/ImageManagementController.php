<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageManagementController extends Controller
{
    public function index()
    {
        return view('image_management.index'); // ส่งไปที่ Blade Template
    }
}
