@props(['meta'])
<!doctype html>
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


    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/web-icon-512x512.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/web-icon-512x512.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="manifest" href="{{ asset('manifest.json') }}?v=3">
    <meta name="msapplication-TileColor" content="#303030">
    <meta name="theme-color" content="#303030">


    @vite(['resources/js/app.js'])
    @stack('head')
    @stack('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-messaging.js" type="text/javascript"></script>
</head>

<body>
    <div class="page">
        <x-admin.navbar />
        <div class="page-wrapper">
            {{ $slot }}
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">

                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    © 2024 {{ config('app.name') }}. All Rights Reserved. Developed by
                                    <a href="https://www.amitghoshanto.com" target="_blank">Amit Ghosh Anto</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
