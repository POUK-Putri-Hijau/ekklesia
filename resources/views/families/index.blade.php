@props([
    'title' => 'Keluarga Jemaat'
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

                <div class="flex-1 p-2 md:p-6">
                    @if($families)
                        <ul class="list rounded-box">
                            @foreach($families as $family)
                                <x-list-row.family
                                    id="{{ $family->family_id }}"
                                    name="{{ $family->family_name }}"
                                    total="{{ $family->total_members }}"
                                ></x-list-row.family>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-2xl">Maaf, belum ada data anggota.</p>
                    @endif
                </div>

                <x-floating-button url="{{ @route('families.create') }}"></x-floating-button>
            </main>

            <div class="flex-none">
                <x-dock></x-dock>
            </div>
        </div>
    </body>
</html>
