<div>
    @if(count($notes) == 0)
        <p class="text-gray-500 text-center py-8">No notes found. Create your first note!</p>
    @else
        <ul class="space-y-3">
            @foreach($notes as $note)
                <li class="bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center justify-between cursor-pointer"
                            onclick="toggleNote({{ $note->id }})">
                            <div class="flex items-center space-x-3">
                                
                                @if ($note->is_pinned)
                                    <button wire:click.stop="togglePin({{ $note->id }})" class="p-1">📌</button>
                                @else
                                    <button wire:click.stop="togglePin({{ $note->id }})" class="p-1 text-2xl">☐</button>
                                @endif
                                
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $note->title }}
                                    </h3>
                                    @if(Auth::user()->type == 2)
                                        <p class="text-sm text-gray-500">by {{ $note->author_name }}</p>
                                    @endif
                                    <p class="text-sm text-gray-500">
                                        Created: {{ date('M j, Y', strtotime($note->created_at)) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="transform transition-transform duration-200" id="arrow-{{ $note->id }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                @if($note->user_id == Auth::id())
                                    <a href="/note/edit?id={{ $note->id }}"
                                        class="text-sm text-gray-600 hover:text-indigo-600"
                                        onclick="event.stopPropagation()">
                                        Edit
                                    </a>
                                @endif
                                
                                @if($note->user_id == Auth::id() || Auth::user()->type == 2)
                                    <button wire:click.stop="$dispatch('openModal', { noteId: {{ $note->id }} })" 
                                        class="text-red-400 hover:text-red-500">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="hidden mt-4 pl-8 text-gray-600" id="note-body-{{ $note->id }}">
                            {!! nl2br(e($note->body)) !!}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        
        <div x-data="{ show: false, noteId: null }"
             x-show="show"
             x-on:openmodal.window="show = true; noteId = $event.detail.noteId"
             x-on:click.away="show = false"
             x-transition
             class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center"
             style="display: none;">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full mx-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Note</h3>
                <p class="text-gray-500 mb-6">Are you sure you want to delete this note? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4">
                    <button x-on:click="show = false"
                            class="px-4 py-2 text-gray-500 hover:text-gray-700">
                        Cancel
                    </button>
                    <button x-on:click="$wire.deleteNote(noteId); show = false"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
