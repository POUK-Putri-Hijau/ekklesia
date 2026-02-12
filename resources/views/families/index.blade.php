@props([
    'title' => 'Keluarga Jemaat',
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
                    @if($families->isEmpty())
                        @if($page_num)
                            <p class="text-2xl">Maaf, belum ada data keluarga jemaat.</p>
                        @else
                            <p class="text-2xl">Maaf, data keluarga jemaat tersebut tidak ada.</p>
                            <a class="btn btn-info w-full lg:w-auto" href="{{ route('families') }}">Kembali</a>
                        @endif
                    @else
                        <x-search-input
                            category="families"
                        ></x-search-input>

                        <x-pagination></x-pagination>

                        <ul class="list rounded-box">
                            @foreach($families as $family)
                                <x-list-row.family
                                    id="{{ $family->family_id }}"
                                    name="{{ $family->family_name }}"
                                    total="{{ $family->total_members }}"
                                ></x-list-row.family>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <x-floating-button url="{{ @route('families.create') }}"></x-floating-button>
            </main>

            <i class="mb-16 md:mb-0"></i>

            <div class="flex-none">
                <x-dock></x-dock>
            </div>
        </div>

        @if($families->isNotEmpty())
            <script src="{{ @asset('js/search.js') }}"></script>
        @endif
    </body>
</html>
