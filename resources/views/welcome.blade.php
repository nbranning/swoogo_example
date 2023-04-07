<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Swoogo Events</title>

    @vite('resources/css/app.css')

</head>
    <body class="antialiased">

        <div class="container mx-auto p-3 md:p-6" >
            <div class="" id="app"></div>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>

