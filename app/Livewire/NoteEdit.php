<?php

namespace App\Livewire;

use Livewire\Component;

class NoteEdit extends Component
{
    public $note;
    public $showDeleteModal = false;

    public function mount($note)
    {
        $this->note = $note;
        
        // Add authorization check
        if ($this->note->user_id != auth()->id() && auth()->user()->type != 2) {
            abort(403);
        }
    }

    public function toggleDeleteModal()
    {
        $this->showDeleteModal = !$this->showDeleteModal;
    }

    public function render()
    {
        return view('livewire.note-edit');
    }
}
