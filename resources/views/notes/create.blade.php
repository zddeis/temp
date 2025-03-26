<x-layout>

    <x-slot:heading>
        Create note
    </x-slot:heading>

    <form method="POST" action="/notes" class="mt-4 w-full max-w-2xl shadow sm:overflow-hidden sm:rounded-md mx-auto">
        @csrf

        <div class="space-y-6 bg-white p-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>

                <div class="mt-1">
                    <input type="text" name="title" id="title"
                        class="bg-gray-100 p-2 w-full rounded-md @error('title') border-red-500 @enderror"
                        placeholder="Note title..." value="{{ old('title') }}">

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
                        placeholder="Here's an idea for a note...">{{ old('body') }}</textarea>

                    @error('body')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_pinned" id="is_pinned" class="h-4 w-4 rounded" {{ old('is_pinned') ? 'checked' : '' }}>
                <label for="is_pinned" class="ml-2 block text-sm text-gray-900">
                    Pin this note
                </label>
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">

            <a href="/notes"
                class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</x-layout>