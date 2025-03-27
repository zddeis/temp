<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\WeatherService;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // If user is admin (type 2), show all notes
        if ($user->type == 2) {
            $notes = Note::join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Regular users only see their own notes
            $notes = Note::where('user_id', $user->id)
                ->join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('notes.index', [
            'notes' => $notes
        ]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string'],
        ]);

        $weatherService = app(WeatherService::class);
        $location = $request->query('location', 'Coimbra, Portugal');
        $weather = $weatherService->getCurrentWeather($location);

        $note = new Note();
        $note->title = $validated['title'];
        $note->body = $validated['body'];
        $note->is_pinned = $request->has('is_pinned');
        $note->user_id = Auth::id();
        $note->condition = $weatherService->extractIconName($weather["current"]["condition"]["icon"]);
        $note->save();

        return redirect('/notes');
    }

    public function edit(Request $request)
    {
        $note = Note::findOrFail($request->query('id'));

        if ($note->user_id != Auth::id()) {
            abort(403);
        }

        return view('notes.edit', [
            'note' => $note
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'exists:notes,id'],
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string'],
        ]);

        $note = Note::findOrFail($validated['id']);

        if ($note->user_id != Auth::id()) {
            abort(403);
        }

        $note->title = $validated['title'];
        $note->body = $validated['body'];
        $note->is_pinned = $request->has('is_pinned');
        $note->save();

        return redirect('/notes');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'exists:notes,id']
        ]);

        $note = Note::findOrFail($validated['id']);

        // Allow admins to delete any note, but regular users can only delete their own
        if ($note->user_id != Auth::id() && Auth::user()->type != 2) {
            abort(403);
        }

        $note->delete();

        return redirect('/notes');
    }
}