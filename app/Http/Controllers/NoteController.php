<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class NoteController extends Controller
{
        public function store(Request $request)
        {
            // Ensure user is authenticated
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please login to create notes.');
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|min:5',
                'cover_image' => 'nullable|image|max:2048',
            ]);

            $coverPath = null;
            if ($request->hasFile('cover_image')) {
                $coverPath = $request->file('cover_image')->store('notes', 'public');
            }

            Note::create([
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'content' => $validated['content'],
                'cover_image' => $coverPath,
                'status' => 'draft',
            ]);


            return redirect()
                ->route('notes.index')
                ->with('status', 'Note saved successfully');
        }


    // List notes for the current user
    public function index()
    {
        
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        
        return view('notes.index', compact('notes'));
    
        }

    // Show create form
    public function create()
    {
        return view('notes.create');
         

        }

    // Show edit form
    public function edit(Note $note)
    {
        // simple ownership check
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }
        return view('notes.edit', compact('note'));
    }

    // Update note
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:5',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('notes', 'public');
        }

        $note->update($data);

        return redirect()->route('notes.index')->with('status', 'Note updated');
    }

}
