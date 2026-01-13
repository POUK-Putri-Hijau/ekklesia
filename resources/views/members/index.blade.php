@props([
    'title' => 'Anggota Jemaat'
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

                <div class="flex-1 md:p-6">
                    <ul class="list rounded-box">

                        <x-list-row.member
                            id="1"
                            name="Trump Siahaan / br. Sitompul"
                            birth_date="02 April 2000"
                        ></x-list-row.member>

                        <x-list-row.member
                            id="2"
                            name="Biden Silaen / br. Silitonga"
                        ></x-list-row.member>

                        <x-list-row.member
                            id="3"
                            name="Obama Sinaga / br. Matondang"
                        ></x-list-row.member>

                    </ul>
                </div>

                <x-floating-button url="{{ @route('members.create') }}"></x-floating-button>
            </main>

            <div class="flex-none">
                <x-dock></x-dock>
            </div>
        </div>
    </body>
</html>
