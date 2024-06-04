@props(['meta'])
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        {{ $meta['title'] ? $meta['title'] . ' - ' . config('app.name') : config('app.name') }}
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="title"
        content="{{ $meta['title'] ? $meta['title'] . ' - ' . config('app.name') : config('app.name') }}" />
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}" />
    <meta property="og:title"
        content="{{ $meta['title'] ? $meta['title'] . ' - ' . config('app.name') : config('app.name') }}" />
    <meta property="og:image" content="{{ $meta['og_image'] ?? '' }}" />
    <meta property="og:description" content="{{ $meta['description'] ?? '' }}">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta name="developer" content="Amit Ghosh Anto">
    <meta name="developer_website" content="https://www.amitghoshanto.com">
    @vite(['resources/js/app.js'])
    @stack('head')
    @stack('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-messaging.js" type="text/javascript"></script>
</head>

<body>
    {{ $slot }}
</body>
<x-scripts.notificationjs />

</html>
