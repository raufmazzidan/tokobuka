<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex h-screen">
        <div style="background: url({{asset('./img/main.jpg')}});background-position:center;background-size:cover;"
            class="min-w-2/5 h-full hidden lg:block">
        </div>
        <div class="flex items-center justify-center w-full">
            @yield('app')
        </div>
    </div>
    </div>
</body>
@yield('script')

</html>