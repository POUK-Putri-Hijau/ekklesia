@props([
    'title' => 'Tambah Anggota'
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
        <div class="min-h-screen flex">
            <x-sidebar></x-sidebar>

            <main class="flex-1 flex flex-col md:ml-64">
                <x-header title="{{ $title }}"></x-header>

                <main class="flex-1 p-4 md:p-6">
                    <x-forms.add-member :families="$families"></x-forms.add-member>
                </main>
            </main>

            <x-dock></x-dock>
        </div>

        <script src="{{ @asset('js/sweetalert2.js') }}" type="text/javascript"></script>
        <script src="{{ @asset('js/members/create.js') }}" type="text/javascript"></script>
        <script src="{{ @asset('js/family-dropdown.js') }}" type="text/javascript"></script>
    </body>
</html>
