@props([
    'title' => 'Error',
    'error' => ''
])

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="min-h-screen flex">
    <x-sidebar></x-sidebar>

    <main class="flex-1 flex flex-col items-center justify-center md:ml-64">
        <x-header title="{{ $title }}"></x-header>

        <main class="flex-1 p-4 md:p-6">
            <h1 class="text-2xl md:text-4xl">{{ $error }}.</h1>
        </main>
    </main>

    <x-dock></x-dock>
</div>
</body>
</html>
