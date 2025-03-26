<x-layout>
    <div class="my-12 px-8 max-w-7xl mx-auto">
        <div class="w-full p-8 pt-4 bg-white rounded-3xl ring-1 ring-gray-900/10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ Auth::user()->type == 2 ? "All Notes" : "My Notes" }}
                </h2>
                <a href="/notes/create"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Note
                </a>
            </div>

            @livewire('note-list')
        </div>
    </div>

    <script>
        function toggleNote(id) {
            const bodyElement = document.getElementById(`note-body-${id}`);
            const arrowElement = document.getElementById(`arrow-${id}`);

            bodyElement.classList.toggle('hidden');
            arrowElement.style.transform = bodyElement.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
    </script>
</x-layout>