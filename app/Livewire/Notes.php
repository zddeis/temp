<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\WeatherService;

class Notes extends Component
{
    public $notes;
    public $title = '';
    public $body = '';
    public $isPinned = false;
    public $editingNote = null;
    public $showDeleteModal = false;
    public $noteToDelete = null;
    public $showCreateForm = false;

    public function mount()
    {
        $this->loadNotes();
    }

    public function loadNotes()
    {
        $user = Auth::user();

        if ($user->type == 2) {
            $this->notes = Note::join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                // ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $this->notes = Note::where('user_id', $user->id)
                ->join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                // ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function create()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string'],
        ]);

        $weatherService = app(WeatherService::class);
        $location = 'Coimbra, Portugal';
        $weather = $weatherService->getCurrentWeather($location);

        $note = new Note();
        $note->title = $validated['title'];
        $note->body = $validated['body'];
        $note->is_pinned = $this->isPinned;
        $note->user_id = Auth::id();
        $note->condition = $weatherService->extractIconName($weather["current"]["condition"]["icon"]);
        $note->save();

        $this->reset(['title', 'body', 'isPinned', 'showCreateForm']);
        $this->loadNotes();
    }

    public function edit($noteId)
    {
        $note = Note::findOrFail($noteId);

        if ($note->user_id != Auth::id()) {
            abort(403);
        }

        $this->editingNote = $note;
        $this->title = $note->title;
        $this->body = $note->body;
        $this->isPinned = $note->is_pinned;
    }

    public function update()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string'],
        ]);

        if (!$this->editingNote || $this->editingNote->user_id != Auth::id()) {
            abort(403);
        }

        $this->editingNote->title = $validated['title'];
        $this->editingNote->body = $validated['body'];
        $this->editingNote->is_pinned = $this->isPinned;
        $this->editingNote->save();

        $this->reset(['title', 'body', 'isPinned', 'editingNote']);
        $this->loadNotes();
    }

    public function cancelForm()
    {
        $this->editingNote = false;
        $this->showCreateForm = false;
        $this->reset(['title', 'body', 'isPinned']);
    }

    public function togglePin($id)
    {
        $note = Note::findOrFail($id);

        if ($note->user_id != Auth::id() && Auth::user()->type != 2) {
            abort(403);
        }

        $note->is_pinned = !$note->is_pinned;
        $note->save();
        $this->loadNotes();
    }

    public function confirmDelete($noteId)
    {
        $this->noteToDelete = $noteId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->noteToDelete = null;
        $this->showDeleteModal = false;
    }

    public function delete()
    {
        $note = Note::findOrFail($this->noteToDelete);

        if ($note->user_id != Auth::id() && Auth::user()->type != 2) {
            abort(403);
        }

        $note->delete();
        $this->showDeleteModal = false;
        $this->noteToDelete = null;
        $this->loadNotes();
    }

    public function render()
    {
        return view('livewire.notes')->layout('Components.layout');
    }
}