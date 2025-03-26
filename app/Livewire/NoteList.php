<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NoteList extends Component
{
    public $notes;

    public function mount()
    {
        $this->loadNotes();
    }

    public function loadNotes()
    {
        if (Auth::user()->type == 2) {
            $this->notes = Note::join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $this->notes = Note::where('user_id', Auth::id())
                ->join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as author_name')
                ->orderBy('is_pinned', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
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

    public function deleteNote($noteId)
    {
        $note = Note::findOrFail($noteId);
        
        if ($note->user_id === Auth::id() || Auth::user()->type == 2) {
            $note->delete();
            $this->loadNotes();
        }
    }

    public function render()
    {
        return view('livewire.note-list');
    }
}