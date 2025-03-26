@props(["active" => false])
@props(["mobile" => false])


@if (!$mobile)
    <a class="{{ $active ? "bg-gray-900 text-white" : "text-gray-300"}} hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"
        aria-current="{{ $active ? "page" : "false" }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <a class="{{ $active ? "bg-gray-900 text-white" : "text-gray-300" }} hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium"
        aria-current="{{ $active ? "page" : "false" }}" {{ $attributes }}>
        {{ $slot }}</a>
@endif