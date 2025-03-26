<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NoteList extends Component
{
    public $notes;
    public $expandedNotes = [];
    public $showDeleteModal = false;
    public $noteToDelete = null;

    public function mount()
    {
        $this->loadNotes();
    }

    public function loadNotes()
    {
        if (Auth::user()->type == 2) {
            $this->notes = Note::join('users', 'notes.user_id', '=', 'users.id') // Admin
                ->select('notes.*', 'users.name as author_name')
                // ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $this->notes = Note::where('user_id', Auth::id())
                ->join('users', 'notes.user_id', '=', 'users.id') // Regular
                ->select('notes.*', 'users.name as author_name')
                // ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function toggleNote($noteId)
    {
        if (in_array($noteId, $this->expandedNotes)) {
            $this->expandedNotes = array_diff($this->expandedNotes, [$noteId]);
        } else {
            $this->expandedNotes[] = $noteId;
        }
    }

    public function togglePin($noteId)
    {
        $note = Note::findOrFail($noteId);

        if ($note->user_id === Auth::id()) {
            $note->is_pinned = !$note->is_pinned;
            $note->save();

            $this->loadNotes();
        }
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

    public function deleteNote($noteId)
    {
        $note = Note::findOrFail($noteId);

        if ($note->user_id === Auth::id() || Auth::user()->type == 2) {
            $note->delete();
            $this->loadNotes();
        }

        $this->showDeleteModal = false;
        $this->noteToDelete = null;
    }

    public function render()
    {
        return view('livewire.note-list');
    }
}