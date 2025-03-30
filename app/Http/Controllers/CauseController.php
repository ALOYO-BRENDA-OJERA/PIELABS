<?php
// app/Http/Controllers/CauseController.php
namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // For authorize()
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class CauseController extends Controller
{
    use AuthorizesRequests; // Enable authorize()

    /**
     * Display a listing of the causes.
     */
    public function index()
    {
        $this->authorize('view_causes');
        $causes = Cause::all();
        return view('admin.causes.index', compact('causes'));
    }

    /**
     * Show the form for creating a new cause.
     */
    public function create()
    {
        $this->authorize('create_causes');
        return view('admin.causes.create');
    }

    /**
     * Store a newly created cause in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create_causes');

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|nullable|max:2048', // Max 2MB
            'donation_link' => 'url|nullable',
            'published_at' => 'date|nullable',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('causes', 'public');
        }

        Cause::create($data);
        return redirect()->route('causes.index')->with('success', 'Cause created successfully.');
    }

    /**
     * Show the form for editing the specified cause.
     */
    public function edit(Cause $cause)
    {
        $this->authorize('create_causes'); // Or define 'edit_causes' permission if needed
        return view('layouts.admin.causes.edit', compact('cause'));
    }

    /**
     * Update the specified cause in storage.
     */
    public function update(Request $request, Cause $cause)
    {
        $this->authorize('create_causes'); // Or define 'edit_causes' permission if needed

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|nullable|max:2048', // Max 2MB
            'donation_link' => 'url|nullable',
            'published_at' => 'date|nullable',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($cause->image) {
                Storage::disk('public')->delete($cause->image); // Now works with import
            }
            $data['image'] = $request->file('image')->store('causes', 'public');
        }

        $cause->update($data);
        return redirect()->route('causes.index')->with('success', 'Cause updated successfully.');
    }

    /**
     * Remove the specified cause from storage.
     */
    public function destroy(Cause $cause)
    {
        $this->authorize('create_causes'); // Or define 'delete_causes' permission if needed

        // Delete image if it exists
        if ($cause->image) {
            Storage::disk('public')->delete($cause->image); // Now works with import
        }

        $cause->delete();
        return redirect()->route('causes.index')->with('success', 'Cause deleted successfully.');
    }
}
