<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events.index', [
            'events' => Event::with('category')->orderBy('start_date', 'desc')->get(),
            'categories' => Category::where('status', 'active')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'trainer'           => 'nullable|string|max:255',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'location'          => 'nullable|string|max:255',
            'capacity'          => 'nullable|integer|min:0',
            'banner'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'registration_link' => 'nullable|string|max:255',
            'status'            => 'required|in:draft,scheduled,published,archived',
            'publish_at'        => 'nullable|date',
        ]);


        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $data['banner'] = $request
                ->file('banner')
                ->store('events', 'public');
        }

        Event::create($data);

        return back()->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'trainer'           => 'nullable|string|max:255',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'location'          => 'nullable|string|max:255',
            'capacity'          => 'nullable|integer|min:0',
            'banner'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
            'registration_link' => 'nullable|string|max:255',
            'status'            => 'required|in:draft,scheduled,published,archived',
            'publish_at'        => 'nullable|date',
        ]);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $data['banner'] = $request
                ->file('banner')
                ->store('events', 'public');
        }

        $event->update($data);

        return back()->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {

        $event->delete();

        return back()->with('success', 'Event deleted successfully.');
    }
}
