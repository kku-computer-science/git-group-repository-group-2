<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลแบนเนอร์ทั้งหมดจากฐานข้อมูล
        $banners = Banner::all();
        return view('image_management.index', compact('banners'));
    }

    public function store(Request $request)
    {
        // ตรวจสอบว่าไฟล์ถูกส่งมาหรือไม่
        if (!$request->hasFile('image_zh')) {
            return redirect()->back()->withErrors(['image_zh' => 'ไฟล์รูปภาพภาษาจีนหายไป']);
        }
        // ตรวจสอบการอัพโหลดไฟล์ภาพทั้ง 3 ภาษา
        $request->validate([
            'image_th' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_en' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_zh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // เพิ่มการตรวจสอบสำหรับภาษาจีน
        ]);

        // ใช้ Storage เพื่อเก็บไฟล์ใน public disk
        $imagePathTh = $request->file('image_th')->storeAs('banners', time() . '_th.' . $request->file('image_th')->getClientOriginalExtension(), 'public');
        $imagePathEn = $request->file('image_en')->storeAs('banners', time() . '_en.' . $request->file('image_en')->getClientOriginalExtension(), 'public');
        $imagePathZh = $request->file('image_zh')->storeAs('banners', time() . '_zh.' . $request->file('image_zh')->getClientOriginalExtension(), 'public');

        // สร้างแบนเนอร์ใหม่ในฐานข้อมูล
        Banner::create([
            'image_path_th' => $imagePathTh,
            'image_path_en' => $imagePathEn,
            'image_path_zh' => $imagePathZh, // เพิ่มการบันทึก path ของภาพภาษาจีน
        ]);

        return redirect()->route('banners.index')->with('success', 'อัปโหลดรูปภาพสำเร็จ');
    }
    // ตรวจสอบการอัพโหลดไฟล์ภาพทั้ง 3 ภาษา
    $request->validate([
        'image_th' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_en' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_zh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // เพิ่มการตรวจสอบสำหรับภาษาจีน
    ]);

    // ใช้ Storage เพื่อเก็บไฟล์ใน public disk
    $imagePathTh = $request->file('image_th')->storeAs('banners', time().'_th.'.$request->file('image_th')->getClientOriginalExtension(), 'public');
    $imagePathEn = $request->file('image_en')->storeAs('banners', time().'_en.'.$request->file('image_en')->getClientOriginalExtension(), 'public');
    $imagePathZh = $request->file('image_zh')->storeAs('banners', time().'_zh.'.$request->file('image_zh')->getClientOriginalExtension(), 'public');

    // สร้างแบนเนอร์ใหม่ในฐานข้อมูล
    Banner::create([
        'image_path_th' => $imagePathTh,
        'image_path_en' => $imagePathEn,
        'image_path_zh' => $imagePathZh, // เพิ่มการบันทึก path ของภาพภาษาจีน
    ]);

    return redirect()->route('banners.index')->with('success', 'อัปโหลดรูปภาพสำเร็จ');
}



    public function destroy($id)
    {
        // ค้นหาข้อมูลแบนเนอร์ที่ต้องการลบ
        $banner = Banner::findOrFail($id);

        // ลบไฟล์ภาพจาก storage
        Storage::delete('public/' . $banner->image_path_th);
        Storage::delete('public/' . $banner->image_path_en);
        Storage::delete('public/' . $banner->image_path_zh); // ลบไฟล์ภาพภาษาจีน

        // ลบข้อมูลจากฐานข้อมูล
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'ลบรูปภาพสำเร็จ');
    }
}
