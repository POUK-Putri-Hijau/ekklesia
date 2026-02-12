@props([
    'route' => '',
    'title' => '',
    'icon' => ''
])

<a
    href="{{ @route($route) }}"
    class="flex items-center mx-2 px-4 py-2.5 text-md md:text-lg
    font-medium rounded-lg hover:bg-[#4C42BE] {{ request()->routeIs($route) ? 'bg-[#685CFE]' : '' }}
    transition duration-150"
>
    @if($route === 'dashboard')
        <x-icons.dashboard></x-icons.dashboard>
    @elseif($route === 'families')
        <x-icons.families></x-icons.families>
    @elseif($route === 'members')
        <x-icons.members></x-icons.members>
    @elseif($route === 'birthdays')
        <x-icons.birthday></x-icons.birthday>
    @endif
    {{ $title }}
</a>
