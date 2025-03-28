<div class="my-12 px-8 max-w-7xl mx-auto">
    <div class="w-full p-8 pt-4 bg-white rounded-3xl ring-1 ring-gray-900/10">

        @if($showCreateForm || $editingNote)

            <div class="my-8 bg-gray-100 p-6 rounded-lg">
                <form wire:submit="{{ $editingNote ? 'update' : 'create' }}">
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-500">Title</label>
                            <input type="text" wire:model="title" id="title" class="py-2 px-4 mt-1 block w-full rounded-md"
                                placeholder="Note title...">
                            @error('title') <span class="text-red-500 text-xs">{{ $message ?? "" }}</span> @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-500">Body</label>
                            <textarea wire:model="body" id="body" rows="3" class="py-2 px-4 mt-1 block w-full rounded-md"
                                placeholder="Here's an idea for a note..."></textarea>
                            @error('body') <span class="text-red-500 text-xs">{{ $message ?? "" }}</span> @enderror
                        </div>

                        <div class="flex">

                            <input type="checkbox" wire:model="isPinned" id="isPinned" {{ $isPinned ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="isPinned" class="ml-2 block text-sm text-gray-900">
                                Pin this note 📌
                            </label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="cancelForm()"
                                class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                                {{ $editingNote ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ Auth::user()->type == 2 ? "All Notes" : "My Notes" }}
                </h2>
                <button wire:click="$toggle('showCreateForm')"
                    class="px-4 py-2 rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Create Note
                </button>
            </div>

            @if(count($notes) == 0)
                <p class="text-gray-500 text-center py-8">No notes found. Create your first note!</p>
            @endif

            <ul class="space-y-3">
                @foreach($notes as $note)
                    <li class="bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if ($note->is_pinned)
                                        <button type="button" wire:click="togglePin({{ $note->id }})"
                                            class="p-4 text-xl">📌</button>
                                    @else
                                        <button type="button" wire:click="togglePin({{ $note->id }})"
                                            class="p-4 text-3xl">▢</button>
                                    @endif

                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 flex gap-2">
                                            {{ $note->title }}
                                            <img src="https://cdn.weatherapi.com/weather/64x64/{{ $note->condition }}.png"
                                                class="w-8 h-8">
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
                                    @if($note->user_id == Auth::id())
                                        <button wire:click="edit({{ $note->id }})"
                                            class="text-sm text-gray-600 hover:text-indigo-600">
                                            Edit
                                        </button>
                                    @endif

                                    @if($note->user_id == Auth::id() || Auth::user()->type == 2)
                                        <button wire:click="confirmDelete({{ $note->id }})" class="text-red-400 hover:text-red-500">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 pl-8 text-gray-600">
                                {!! nl2br(e($note->body)) !!}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($showDeleteModal)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full mx-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Note</h3>
                    <p class="text-gray-500 mb-6">Are you sure you want to delete this note? This action cannot be undone.
                    </p>
                    <div class="flex justify-end space-x-4">
                        <button wire:click="cancelDelete" class="px-4 py-2 text-gray-500 hover:text-gray-500">
                            Cancel
                        </button>
                        <button wire:click="delete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>