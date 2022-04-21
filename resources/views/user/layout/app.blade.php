<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('user.layout.partials.head')
</head>
<body>
    @include('user.layout.partials.navbar')
    <main id="main">
        <div class="container">
            @yield('content')
        </div>
    </main>
    @include('user.layout.partials.javascript')
</body>
</html>