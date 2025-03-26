
<x-layout>
    <x-slot:heading>
        Edit note
    </x-slot:heading>
    
    @livewire('note-edit', ['note' => $note])
</x-layout>