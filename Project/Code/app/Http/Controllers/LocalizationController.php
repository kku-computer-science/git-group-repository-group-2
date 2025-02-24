<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Models\ResearchGroup;
use App\Models\ResearchProject;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function index()
    {
        $resp = ResearchGroup:: all();
        return view('welcome',compact('resp'));
       // return view('welcome');
    }
    public function switchLang($lang)
{
    // ตรวจสอบว่า $lang อยู่ใน array ของภาษาที่รองรับ
    if (array_key_exists($lang, Config::get('languages'))) {
        Session::put('applocale', $lang); // เก็บภาษาที่เลือกใน session
        App::setLocale($lang); // เปลี่ยนภาษาใน app
    }
    return redirect()->back(); // กลับไปหน้าก่อนหน้า
}
}