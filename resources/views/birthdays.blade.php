@php use Carbon\Carbon; @endphp
@props([
    'title' => 'Ulang Tahun'
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
        <div class="min-h-screen flex">
            <x-sidebar></x-sidebar>

            <main class="flex-1 flex flex-col md:ml-64">
                <x-header title="{{ $title }}"></x-header>

                <main class="flex-1 p-4 md:p-6">
                    <p class="md:text-xl px-4">
                        Daftar ulang tahun anggota jemaat dan ulang tahun
                        pernikahan keluarga jemaat dari tanggal {{ implode(" sampai ",$dates) }}.
                    </p>

                    <ul class="list rounded-box mt-4 md:mt-8">
                        <li class="text-xl md:text-3xl font-bold pl-4">Anggota Jemaat</li>

                        @forelse($members as $member)
                            @php
                                $date = Carbon::parse($member->birth_date);
                                $formattedDate = $date->format('d F Y');
                            @endphp

                            <x-list-row.birthday
                                name="{{ $member->name }}"
                                date="{{ $formattedDate }}"
                            ></x-list-row.birthday>
                        @empty
                            <p class="pl-4 text-lg">Tidak ada</p>
                        @endforelse
                    </ul>


                    <ul class="list rounded-box mt-4 md:mt-8">
                        <li class="text-xl md:text-3xl font-bold pl-4">Keluarga Jemaat</li>

                        @forelse($families as $family)
                            @php
                                $date = Carbon::parse($family->wedding_date);
                                $formattedDate = $date->format('d F Y');
                            @endphp

                            <x-list-row.birthday
                                name="{{ $family->name }}"
                                date="{{ $formattedDate }}"
                            ></x-list-row.birthday>
                        @empty
                            <p class="pl-4 text-lg">Tidak ada</p>
                        @endforelse
                    </ul>
                </main>
            </main>

            <x-dock></x-dock>
        </div>
    </body>
</html>
