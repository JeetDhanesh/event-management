<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(){
        // We need the categories for the dropdown menu
        $categories = Category::where('is_active', true)->get();
        return view('events.create', compact('categories'));
    }

    //save the data
    public function store(Request $request){
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Must be a valid category ID
            'start_time' => 'required|date|after:today',      // Event must be in the future
            'location' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|string',
        ]);

        // B. Create the Event
        Event::create([
            'user_id' => Auth::id(), // Automatically link to the logged-in user
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'price' => $request->price,
            'capacity' => $request->capacity,
        ]);

        // C. Redirect back to Dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Event created successfully!');
    }

    public function index()
    {
        // Fetch all events with their associated category and creator
        $events = Event::with(['category', 'user'])->get();

        return view('events.index', compact('events'));
    }

    public function edit($id)
    {
        // Find the event
        $event = Event::findOrFail($id);

        // SECURITY CHECK: Ensure the logged-in user owns this event
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // We need categories again for the dropdown
        $categories = Category::where('is_active', true)->get();

        return view('events.edit', compact('event', 'categories'));
    }

    // 5. Save the Updates
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // SECURITY CHECK
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate (similar to create, but strictly speaking specific fields)
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'start_time' => 'required|date',
            'location' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'required',
        ]);

        // Update the data
        $event->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'price' => $request->price,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('dashboard')->with('success', 'Event updated!');
    }

    // 6. Delete the Event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // SECURITY CHECK
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event deleted successfully.');
    }
}