<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // การตรวจสอบว่าไฟล์เป็นรูปภาพและขนาดไม่เกินที่กำหนด
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ตรวจสอบว่าไฟล์มีอยู่ใน request หรือไม่
        if ($request->hasFile('image')) {
            // อัปโหลดไฟล์ไปยัง storage แล้วเก็บเส้นทางไว้ในตัวแปร $imagePath
            $imagePath = $request->file('image')->store('banners', 'public');
        } else {
            return redirect()->route('banners.index')->with('error', 'กรุณาเลือกไฟล์รูปภาพ');
        }

        // สร้างแบนเนอร์ใหม่แล้วบันทึกเส้นทางรูปภาพลงในฐานข้อมูล
        Banner::create([
            'image_path' => $imagePath,
        ]);

        // ส่งผู้ใช้กลับไปที่หน้าหลักและแสดงข้อความสำเร็จ
        return redirect()->route('banners.index')->with('success', 'อัปโหลดรูปภาพสำเร็จ');
    }

    public function destroy($id)
    {
        // ค้นหาข้อมูลแบนเนอร์ที่ต้องการลบ
        $banner = Banner::findOrFail($id);
        
        // ลบไฟล์ภาพจาก storage
        Storage::delete('public/' . $banner->image_path);
        
        // ลบข้อมูลจากฐานข้อมูล
        $banner->delete();
        
        return redirect()->route('banners.index')->with('success', 'ลบรูปภาพสำเร็จ');
    }

   
}