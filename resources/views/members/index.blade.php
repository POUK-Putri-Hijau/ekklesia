@php use Carbon\Carbon; @endphp
@props([
    'title' => 'Anggota Jemaat'
])

    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ekklesia - {{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="min-h-screen flex flex-col">
    <x-sidebar></x-sidebar>

    <main class="flex flex-col md:ml-64">
        <x-header title="{{ $title }}"></x-header>

        <div class="flex-1 p-2 md:p-6">
            @if($members)
                <ul class="list rounded-box">
                    @foreach($members as $member)
                        @php
                            $date = Carbon::parse($member->birth_date);
                            $formattedDate = $date->format('d F Y');
                        @endphp

                        <x-list-row.member
                            id="{{ $member->id }}"
                            name="{{ $member->name }}"
                            birth_date="{{ $formattedDate }}"
                        ></x-list-row.member>
                    @endforeach
                </ul>
            @else
                <p class="text-2xl">Maaf, belum ada data anggota.</p>
            @endif
        </div>

        <x-floating-button url="{{ @route('members.create') }}"></x-floating-button>
    </main>

    <div class="flex-none">
        <x-dock></x-dock>
    </div>
</div>
</body>
</html>
