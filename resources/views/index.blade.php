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
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($note["title"]) ?>
                                </h3>
                                <span class="text-sm text-gray-500">by
                                    <?= htmlspecialchars($note["author_name"]) ?></span>
                            </div>
                            <p class="text-gray-600"><?= htmlspecialchars($note["body"]) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    @if(count($pinnedNotes) == 0)
                        <p class="ml-4 text-gray-500">No pinned notes at the moment.</p>
                    @endif
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
</x-layout>