<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::with(['tags', 'user', 'images'])->get();
        return view('highlight.index', compact('highlights'));
    }

    public function homePage()
    {
        $highlights = Highlight::with(['tags', 'user'])->get();
        return view('home', compact('highlights'));
    }

    public function view()
    {
        $highlights = Highlight::with(['tags', 'user', 'images'])->get();
        return view('highlight.view', compact('highlights'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'thumbnail' => 'required|image',
            'additional_thumbnails.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|string',
        ]);

        // อัปโหลด main thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // สร้าง Highlight ใหม่
        $highlight = Highlight::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'thumbnail' => $thumbnailPath,
            'user_id' => Auth::id(),
        ]);

        // จัดการ tags (ถ้ามี)
        if (!empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $highlight->tags()->attach($tag);
            }
        }

        // อัปโหลดและบันทึกภาพเพิ่มเติมในตาราง images
        if ($request->hasFile('additional_thumbnails')) {
            foreach ($request->file('additional_thumbnails') as $file) {
                $path = $file->store('thumbnails/additional', 'public');
                // บันทึกข้อมูลลงในตาราง images โดยใช้ความสัมพันธ์ใน model Highlight
                $highlight->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('highlight.index')->with('success', 'Highlight uploaded successfully!');
    }

    public function show($id)
    {
        $highlight = Highlight::with('tags', 'user', 'images')->findOrFail($id);
        return view('highlight.show', compact('highlight'));
    }

    public function moreDetails($id)
    {
        $highlight = Highlight::with('tags')->findOrFail($id);
        return view('highlight.more', compact('highlight')); // ส่งข้อมูลไปยังหน้า more.blade.php
    }


    public function edit($id)
    {
        $highlight = Highlight::findOrFail($id);
        return view('highlight.edit', compact('highlight'));
    }

    public function update(Request $request, $id)
    {
        $highlight = Highlight::findOrFail($id);

        if ($highlight->user_id !== Auth::id()) {
            return redirect()->route('highlights.index')->with('error', 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'thumbnail' => 'nullable|image',
            'tags' => 'required|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $highlight->thumbnail = $thumbnailPath;
        }

        $highlight->title = $request->title;
        $highlight->detail = $request->detail;
        $highlight->save();

        $tags = explode(',', $request->tags);
        $highlight->tags()->detach();
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $highlight->tags()->attach($tag);
        }

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully!');
    }

    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);

        if ($highlight->user_id !== Auth::id()) {
            return redirect()->route('highlights.index')->with('error', 'Unauthorized action.');
        }

        if ($highlight->thumbnail) {
            Storage::disk('public')->delete($highlight->thumbnail);
        }

        $highlight->tags()->detach();
        $highlight->delete();

        return redirect()->route('highlights.index')->with('success', 'Highlight deleted successfully!');
    }
}
