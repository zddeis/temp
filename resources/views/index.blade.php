<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <?php if (!empty($pinnedNotes)): ?>
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">📌 Pinned Notes</h2>
                <div class="space-y-4">
                    <?php    foreach ($pinnedNotes as $note): ?>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="p-4 flex justify-between">
                            <div class="mb-2">
                                <h3 class="text-lg font-medium text-gray-900">
                                    <?= htmlspecialchars($note["title"]) ?>
                                    <span class="ml-1 text-sm text-gray-500">by
                                        <?= htmlspecialchars($note["author_name"]) ?></span>
                                </h3>
                                <p class="ml-4 text-gray-600"><?= htmlspecialchars($note["body"]) ?></p>
                            </div>

                            <div class="">
                                <img src="https://cdn.weatherapi.com/weather/64x64/{{ $note->condition }}.png"
                                        class="ml-auto w-16 h-16">
                                        
                                <p class="text-sm text-gray-500">                                        
                                    Created: {{ date('M j, Y', strtotime($note->created_at)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php    endforeach; ?>

                    @if(count($pinnedNotes) == 0)
                        <p class="ml-4 text-gray-500">No pinned notes at the moment.</p>
                    @endif
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
</x-layout>