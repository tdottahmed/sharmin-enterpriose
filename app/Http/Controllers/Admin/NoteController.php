<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoteRequest;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view notes')->only('index');
        $this->middleware('permission:create notes')->only(['create', 'store']);
        $this->middleware('permission:update notes')->only(['edit', 'update']);
        $this->middleware('permission:delete notes')->only('destroy');
    }

    public function index()
    {
        $notes = Note::where('user_id', auth()->user()->id)->get();
        return view('admin.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('admin.notes.create');
    }

    public function store(NoteRequest $request)
    {
        try {
            $request->handle();
            return redirect()->route('notes.index')->with('success', 'Note created successfully');
        } catch (\Throwable $th) {
            Log::error('Note creation failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function show(Note $note)
    {
        return view('admin.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('admin.notes.edit', compact('note'));
    }

    public function update(NoteRequest $request, Note $note)
    {
        try {
            $request->handle($note);
            return redirect()->route('notes.index')->with('success', 'Note updated successfully');
        } catch (\Throwable $th) {
            Log::error('Note update failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Note $note)
    {
        try {
            $note->delete();
            return redirect()->route('notes.index')->with('success', 'Note deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Note deletion failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
