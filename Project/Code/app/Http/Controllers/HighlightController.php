<?php
// app/Http/Controllers/HighlightController.php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
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
}
