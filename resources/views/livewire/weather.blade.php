<div>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    @if (isset($weather['current']))
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="location" wire:keydown.enter="fetchWeather"
                                        placeholder="Enter city, country"
                                        class="rounded-md w-full bg-gray-100 py-2 px-4 text-2xl text-gray-900">
                                    <button wire:click="fetchWeather"
                                        class="rounded-md pb-1 px-4 text-3xl text-gray-900 hover:text-gray-700">
                                        ⟳
                                    </button>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $weather['location']['name'] }}, {{ $weather['location']['region'] }}, {{ $weather['location']['country'] }} - {{ $weather['location']['localtime'] }}
                                </p>
                            </div>
                            <div class="text-right">
                                <img src="https:{{ $weather['current']['condition']['icon'] }}"
                                    alt="{{ $weather['current']['condition']['text'] }}" class="w-20 h-20 inline-block">
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Temperature</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['temp_c'] }}°C
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Feels Like</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['feelslike_c'] }}°C
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Condition</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['condition']['text'] }}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Humidity</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['humidity'] }}%
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Wind</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['wind_kph'] }} km/h
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">Precipitation</div>
                                <div class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $weather['current']['precip_mm'] }} mm
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-500">
                            Unable to fetch weather data at the moment.
                        </div>

                        <div class="mx-auto gap-2 max-w-xl py-24">
                            <p class="text-2xl">Enter a different location</p>

                            <div class="flex">
                                <input type="text" wire:model="location" wire:keydown.enter="fetchWeather"
                                    placeholder="Enter city, country"
                                    class="rounded-md w-full bg-gray-100 py-2 px-4 text-2xl text-gray-900">
                                <button wire:click="fetchWeather" 
                                    class="rounded-md pb-1 px-4 text-3xl text-gray-900 hover:text-gray-700">
                                    ⟳
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>