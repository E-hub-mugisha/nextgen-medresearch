<?php

namespace App\Http\Controllers;

use App\Models\ResearchKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchKitController extends Controller
{
    public function index()
    {
        $kits = ResearchKit::where('status', 'active')->orderBy('display_order')->get();
        return view('research_kits.index', compact('kits'));
    }

    public function show($id)
    {
        $kit = ResearchKit::findOrFail($id);
        return view('research_kits.show', compact('kit'));
    }

    // Optional: Download file
    public function download($id)
    {
        $kit = ResearchKit::findOrFail($id);

        if (!$kit->file_path || !file_exists(public_path($kit->file_path))) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download(public_path($kit->file_path));
    }

    public function indexAdmin()
    {
        $kits = ResearchKit::orderBy('display_order')->get();
        return view('admin.research_kits.index', compact('kits'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'status'        => 'required|in:active,inactive',
            'display_order' => 'nullable|integer',
            'file'          => 'nullable|file|mimes:pdf,zip,doc,docx',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $destinationPath = public_path('research_kits');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file     = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            $data['file_path'] = 'research_kits/' . $fileName;
        }

        ResearchKit::create($data);

        return redirect()->back()->with('success', 'Research kit created successfully');
    }

    public function update(Request $request, ResearchKit $researchKit)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'status'        => 'required|in:active,inactive',
            'display_order' => 'nullable|integer',
            'file'          => 'nullable|file|mimes:pdf,zip,doc,docx',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            // Delete old file
            if ($researchKit->file_path && file_exists(public_path($researchKit->file_path))) {
                unlink(public_path($researchKit->file_path));
            }

            $destinationPath = public_path('research_kits');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file     = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            $data['file_path'] = 'research_kits/' . $fileName;
        }

        $researchKit->update($data);

        return redirect()->back()->with('success', 'Research kit updated');
    }

    public function destroy(ResearchKit $researchKit)
    {
        if ($researchKit->file_path && file_exists(public_path($researchKit->file_path))) {
            unlink(public_path($researchKit->file_path));
        }

        $researchKit->delete();

        return redirect()->back()->with('success', 'Research kit deleted');
    }
}
