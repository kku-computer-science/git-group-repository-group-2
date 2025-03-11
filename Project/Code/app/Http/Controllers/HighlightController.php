<?php
// app/Http/Controllers/HighlightController.php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::with('tags')->get();
        return view('highlight.view', compact('highlights'));
    }

    public function view()
    {
        $highlights = Highlight::with('tags')->get(); // ดึง Highlight พร้อม Tags
        return view('highlight.view', compact('highlights'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'thumbnail' => 'required|image',
            'tags' => 'required|string',
        ]);

        // Handle the file upload
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Create a new Highlight record
        $highlight = Highlight::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'thumbnail' => $thumbnailPath,
        ]);

        // Process the tags
        $tags = explode(',', $request->tags); // Split tags by comma
        foreach ($tags as $tagName) {
            // Trim whitespace and check if tag exists, otherwise create it
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $highlight->tags()->attach($tag);
        }

        // Redirect or return a response
        return redirect()->route('highlight.index')->with('success', 'Highlight uploaded successfully!');
    }

    public function show($id)
    {
        $highlight = Highlight::with('tags')->findOrFail($id);
        return view('highlight.show', compact('highlight'));
    }

    // 📌 ฟังก์ชันสำหรับเปิดหน้าแก้ไข Highlight
    public function edit($id)
    {
        $highlight = Highlight::findOrFail($id);
        return view('highlight.edit', compact('highlight'));
    }

    // 📌 ฟังก์ชันสำหรับอัปเดต Highlight
    public function update(Request $request, $id)
    {
        $highlight = Highlight::findOrFail($id);

        // Validate ข้อมูล
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'thumbnail' => 'image|nullable',
            'tags' => 'required|string',
        ]);

        // อัปเดตข้อมูล
        $highlight->title = $request->title;
        $highlight->detail = $request->detail;

        // อัปโหลดรูปใหม่ (ถ้ามี)
        if ($request->hasFile('thumbnail')) {
            // ลบไฟล์เดิมก่อน
            Storage::disk('public')->delete($highlight->thumbnail);

            // อัปโหลดรูปใหม่
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $highlight->thumbnail = $thumbnailPath;
        }

        // อัปเดต Tags
        $tags = explode(',', $request->tags);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $tagIds[] = $tag->id;
        }
        $highlight->tags()->sync($tagIds);

        $highlight->save();

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully!');
    }

    // 📌 ฟังก์ชันสำหรับลบ Highlight
    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);

        // ลบรูปที่เก็บไว้
        if ($highlight->thumbnail) {
            Storage::disk('public')->delete($highlight->thumbnail);
        }

        // ลบความสัมพันธ์กับ Tags
        $highlight->tags()->detach();

        // ลบ Highlight
        $highlight->delete();

        return redirect()->route('highlights.index')->with('success', 'Highlight deleted successfully!');
    }
}
