<?php
// app/Http/Controllers/HighlightController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Highlight; // Make sure you import the Highlight model

class HighlightController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
            'upload_date' => 'required|date',
            'tags' => 'required|string',
        ]);

        // Handle the file upload
        $thumbnail = $request->file('thumbnail');
        $extension = $thumbnail->getClientOriginalExtension();

        // If the file is .avif, convert it to .jpg or .png
        if ($extension == 'avif') {
            $image = Image::make($thumbnail);
            $thumbnailPath = $image->encode('jpg')->store('thumbnails', 'public');
        } else {
            // If the file is not .avif, store it as is
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
        }

        // Save the data to the database
        Highlight::create([
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
            'thumbnail' => $thumbnailPath,
            'upload_date' => $request->input('upload_date'),
            'tags' => $request->input('tags'),
        ]);

        return redirect()->route('highlight.index')->with('success', 'Highlight uploaded successfully!');
    }
}
