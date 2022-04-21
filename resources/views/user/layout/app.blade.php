<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('user.layout.partials.head')
</head>
<body>
    @include('user.layout.partials.header')
    <main id="main">
        <section>
            <div class="container">
                @yield('content')
            </div>
        </section>
    </main>
    @include('user.layout.partials.javascript')
</body>
</html>
