@php use Carbon\Carbon; @endphp
@props([
    'title' => 'Anggota Jemaat',
    'page_num' => null
])

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ekklesia - {{ $title }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="min-h-screen flex flex-col">
            <x-sidebar></x-sidebar>

            <main class="flex flex-col md:ml-64">
                <x-header title="{{ $title }}"></x-header>

                <div class="flex-1 p-4 md:p-6">
                    @if($members->isEmpty())
                        @if($page_num)
                            <p class="text-2xl">Maaf, belum ada data anggota.</p>
                        @else
                            <p class="text-2xl">Maaf, data jemaat tersebut tidak ada.</p>
                            <a class="btn btn-info w-full lg:w-auto" href="{{ route('members') }}">Kembali</a>
                        @endif
                    @else
                        <x-search-input
                            placeholder="Cari nama jemaat..."
                            category="members"
                        ></x-search-input>

                        <x-pagination></x-pagination>

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
                    @endif
                </div>

                <x-floating-button url="{{ @route('members.create') }}"></x-floating-button>
            </main>

            <i class="mb-16 md:mb-0"></i>

            <div class="flex-none">
                <x-dock></x-dock>
            </div>
        </div>

        @if($members->isNotEmpty())
            <script src="{{ @asset('js/search.js') }}"></script>
        @endif
    </body>
</html>
