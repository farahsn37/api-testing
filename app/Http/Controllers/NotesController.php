<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // get all, store, update, destroy
    public function index()
    {
        // return notes by id increasing order
        $notes = Note::orderBy('id')->get();

        return response()->json($notes, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
        ]);
        $notes = Note::create($validated);

        return response()->json($notes, 201);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'string',
            'content' => 'string',
        ]);
        $note = Note::findOrFail($id);
        $note->update($validated);

        return response()->json($note, 200);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json([
            'message' => 'Note deleted successfully',
        ], 200);
    }
}
