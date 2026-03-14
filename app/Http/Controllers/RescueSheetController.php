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
            'title'         => 'required|string|max:255',
            'vehicle_model' => 'nullable|string|max:255',
            'file'          => 'required|file|mimes:pdf,png,jpg,jpeg',
            'language'      => 'nullable',
            'category'      => 'nullable|in:car,truck,bus,ev',
        ]);

        // Ensure folders exist
        $rescuePath = public_path('rescue_sheets');
        $qrPathDir  = public_path('qr_codes');

        if (!file_exists($rescuePath)) {
            mkdir($rescuePath, 0755, true);
        }

        if (!file_exists($qrPathDir)) {
            mkdir($qrPathDir, 0755, true);
        }

        // Upload file to public/rescue_sheets
        $file      = $request->file('file');
        $fileName  = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($rescuePath, $fileName);

        $filePath = 'rescue_sheets/' . $fileName; // DB path

        // Generate unique slug
        $slug = Str::slug($request->title) . '-' . time();

        // Generate QR Code (SVG)
        $qrFileName = $slug . '.svg';
        $qrFullPath = $qrPathDir . '/' . $qrFileName;

        $qrImage = QrCode::format('svg')
            ->size(200)
            ->generate(route('rescue.sheet.show', $slug));

        // Save QR code to public/qr_codes
        file_put_contents($qrFullPath, $qrImage);

        $qrPath = 'qr_codes/' . $qrFileName; // DB path

        // Save record
        RescueSheet::create([
            'title'         => $request->title,
            'vehicle_model' => $request->vehicle_model,
            'language'     => $request->language, // (typo preserved from your model)
            'slug'          => $slug,
            'file_path'     => $filePath,
            'qr_code_path'  => $qrPath,
            'status'        => 'published',
            'category'      => $request->category,
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
    $rescueSheet = RescueSheet::findOrFail($id);

    $request->validate([
        'title'         => 'required|string|max:255',
        'vehicle_model' => 'nullable|string|max:255',
        'file'          => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
        'language'      => 'nullable|string|max:50',
        'category'      => 'nullable|in:car,truck,bus,ev',
    ]);

    $data = [
        'title'         => $request->title,
        'vehicle_model' => $request->vehicle_model,
        'language'      => $request->language,
        'category'      => $request->category,
    ];

    $rescuePath = public_path('rescue_sheets');
    $qrPathDir  = public_path('qr_codes');

    if (!file_exists($rescuePath)) {
        mkdir($rescuePath, 0755, true);
    }

    if (!file_exists($qrPathDir)) {
        mkdir($qrPathDir, 0755, true);
    }

    /*
    |--------------------------------------------------------------------------
    | SLUG + QR CODE REGENERATION
    |--------------------------------------------------------------------------
    */

    if ($request->title !== $rescueSheet->title) {

        $slug = Str::slug($request->title) . '-' . time();
        $data['slug'] = $slug;

        $qrFileName = $slug . '.svg';
        $qrFullPath = $qrPathDir . '/' . $qrFileName;

        $qrImage = QrCode::format('svg')
            ->size(200)
            ->generate(route('rescue.sheet.show', $slug));

        // delete old QR
        if ($rescueSheet->qr_code_path && file_exists(public_path($rescueSheet->qr_code_path))) {
            unlink(public_path($rescueSheet->qr_code_path));
        }

        file_put_contents($qrFullPath, $qrImage);

        $data['qr_code_path'] = 'qr_codes/' . $qrFileName;
    }

    /*
    |--------------------------------------------------------------------------
    | FILE REPLACEMENT
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('file') && $request->file('file')->isValid()) {

        // delete old file
        if ($rescueSheet->file_path && file_exists(public_path($rescueSheet->file_path))) {
            unlink(public_path($rescueSheet->file_path));
        }

        $file = $request->file('file');

        $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

        $file->move($rescuePath, $fileName);

        $data['file_path'] = 'rescue_sheets/'.$fileName;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATABASE
    |--------------------------------------------------------------------------
    */

    $rescueSheet->update($data);

    return redirect()->back()->with('success', 'Rescue sheet updated successfully!');
}

    /**
     * Remove the specified rescue sheet
     */
    public function destroy($id)
    {
        $sheet = RescueSheet::findOrFail($id);

        // Delete file
        if ($sheet->file_path && file_exists(public_path($sheet->file_path))) {
            unlink(public_path($sheet->file_path));
        }

        // Delete QR code
        if ($sheet->qr_code_path && file_exists(public_path($sheet->qr_code_path))) {
            unlink(public_path($sheet->qr_code_path));
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

        // Count QR scans
        $sheet->increment('scan_count');

        $filePath = public_path($sheet->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->file($filePath);
    }


    public function publicIndex(Request $request)
    {
        $query = RescueSheet::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('vehicle_model', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $sheets = $query->latest()->paginate(12);


        return view('front.rescue_sheets', compact('sheets'));
    }
}
