<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $file = $request->file('upload');

            $destinationPath = public_path('image/posts');

            // Create folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Move file
            $file->move($destinationPath, $filename);

            // Return image URL for CKEditor
            return response()->json([
                'url' => asset('image/posts/' . $filename)
            ]);
        }
    }
}
