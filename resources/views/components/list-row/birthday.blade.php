@props([
    'name' => '',
    'date' => ''
])

<li class="list-row">
    <div class="list-col-grow">
        <div class="md:text-base">{{ $name }}</div>
        <div class="text-xs md:text-base font-semibold opacity-60">{{ $date }}</div>
    </div>
</li>
