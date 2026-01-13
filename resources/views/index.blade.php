<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Ekklesia - Kelola Data Jemaat</title>

        <link rel="stylesheet" type="text/css" href="{{ url('/css/background.css') }}" />
        @vite('resources/css/app.css')
    </head>
    <body class="min-h-screen flex items-center justify-center bg-hero bg-cover bg-center p-8 md:p-0">
        <x-notification></x-notification>

        <div class="max-w-4xl w-full flex flex-col md:flex-row gap-8 items-center p-8 inset-10 bg-white/30 backdrop-blur-sm rounded-lg border border-white/40">
            <x-landing-intro></x-landing-intro>
            <x-login-card></x-login-card>
        </div>

        <script src="{{ @asset('js/index.js') }}" type="text/javascript"></script>
    </body>
</html>
