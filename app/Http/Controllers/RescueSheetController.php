<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RescueSheet;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class RescueSheetController extends Controller
{
    /**
     * Display a listing of rescue sheets (Admin view)
     */
    public function index()
    {
        $sheets = RescueSheet::orderBy('created_at', 'desc')->get();
        return view('admin.rescuesheet.index', compact('sheets'));
    }

    /**
     * Store a newly created rescue sheet in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'vehicle_model' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg',
        ]);

        // Ensure qr_codes folder exists
        if (!Storage::disk('public')->exists('qr_codes')) {
            Storage::disk('public')->makeDirectory('qr_codes');
        }

        // Upload file
        $filePath = $request->file('file')->store('rescue_sheets', 'public');

        // Generate unique slug
        $slug = Str::slug($request->title) . '-' . time();

        // Generate QR Code
        $qrFileName = $slug . '.svg';
        $qrPath = 'qr_codes/' . $qrFileName;

        $qrImage = QrCode::format('svg')
            ->size(200)
            ->generate(route('rescue.sheet.show', $slug));

        Storage::disk('public')->put($qrPath, $qrImage);   // ✅ FIX

        // Save record
        RescueSheet::create([
            'title' => $request->title,
            'vehicle_model' => $request->vehicle_model,
            'slug' => $slug,
            'file_path' => $filePath,
            'qr_code_path' => $qrPath,
            'status' => 'published',
        ]);

        return back()->with('success', 'Rescue sheet uploaded successfully!');
    }


    /**
     * Show the form for editing the specified sheet (optional if using modal)
     */
    public function edit($id)
    {
        $sheet = RescueSheet::findOrFail($id);
        return view('admin.rescue_sheets.edit', compact('sheet'));
    }

    /**
     * Update the specified rescue sheet
     */
    public function update(Request $request, $id)
    {
        $sheet = RescueSheet::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'vehicle_model' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg',
        ]);

        $sheet->title = $request->title;
        $sheet->vehicle_model = $request->vehicle_model;

        // If a new file is uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            if ($sheet->file_path && Storage::disk('public')->exists($sheet->file_path)) {
                Storage::disk('public')->delete($sheet->file_path);
            }
            $filePath = $request->file('file')->store('rescue_sheets', 'public');
            $sheet->file_path = $filePath;

            // Regenerate QR code
            $publicUrl = url('/rescue/' . $sheet->slug);
            $qrFileName = $sheet->slug . '.png';
            $qrPath = 'qr_codes/' . $qrFileName;
            QrCode::format('png')->size(300)->generate($publicUrl, storage_path('app/public/' . $qrPath));
            $sheet->qr_code_path = $qrPath;
        }

        $sheet->save();

        return back()->with('success', 'Rescue sheet updated successfully!');
    }

    /**
     * Remove the specified rescue sheet
     */
    public function destroy($id)
    {
        $sheet = RescueSheet::findOrFail($id);

        // Delete file
        if ($sheet->file_path && Storage::disk('public')->exists($sheet->file_path)) {
            Storage::disk('public')->delete($sheet->file_path);
        }

        // Delete QR code
        if ($sheet->qr_code_path && Storage::disk('public')->exists($sheet->qr_code_path)) {
            Storage::disk('public')->delete($sheet->qr_code_path);
        }

        $sheet->delete();

        return back()->with('success', 'Rescue sheet deleted successfully!');
    }

    /**
     * Public view accessed via QR code
     */
    public function view($slug)
    {
        $sheet = RescueSheet::where('slug', $slug)->firstOrFail();
        $sheet->increment('scan_count');
        return response()->file(storage_path('app/public/' . $sheet->file_path));
    }

    public function publicIndex(Request $request)
    {
        $query = RescueSheet::query()->where('status', 'published');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('vehicle_model', 'like', '%' . $request->search . '%');
        }

        $sheets = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('front.rescue_sheets', compact('sheets'));
    }
}
