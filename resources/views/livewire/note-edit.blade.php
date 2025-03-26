<div class="mt-4 w-full max-w-2xl shadow sm:overflow-hidden sm:rounded-md mx-auto">
    <form method="POST" id="destroy" action="{{ route('notes.destroy') }}" class="mr-auto">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $note->id }}">
    </form>

    <form method="POST" id="update" action="{{ route('notes.update') }}">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $note->id }}">

        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>

                <div class="mt-1">
                    <input type="text" name="title" id="title"
                        class="bg-gray-100 p-2 w-full rounded-md @error('title') border-red-500 @enderror"
                        placeholder="Note title..." value="{{ old('title', $note->title) }}">

                    @error('title')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>

                <div class="mt-1">
                    <textarea id="body" name="body" rows="3"
                        class="bg-gray-100 p-2 w-full rounded-md @error('body') border-red-500 @enderror"
                        placeholder="Here's an idea for a note...">{{ old('body', $note->body) }}</textarea>

                    @error('body')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_pinned" id="is_pinned"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_pinned', $note->is_pinned) ? 'checked' : '' }}>
                <label for="is_pinned" class="ml-2 block text-sm text-gray-900">
                    Pin this note 📌
                </label>
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
            <button type="button" wire:click.stop="toggleDeleteModal()" class="text-red-500">
                Delete
            </button>

            <a href="/notes"
                class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Update
            </button>
        </div>
    </form>

    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full mx-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Note</h3>
                <p class="text-gray-500 mb-6">Are you sure you want to delete this note? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4">
                    <button wire:click="toggleDeleteModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700">
                        Cancel
                    </button>
                    <button form="destroy" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>