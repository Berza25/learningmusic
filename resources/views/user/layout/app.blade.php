<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.layout.partials.head')
</head>
<body>
    @include('user.layout.partials.header')
    @yield('section')
    <main id="main">
        @yield('breadcrumb')
        {{-- <section class="breadcrumbs">
            <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>Inner Page</li>
            </ol>
            <h2>Inner Page</h2>

            </div>
        </section> --}}
        <section class="inner-page">
            @yield('content')
        </section>
    </main>
    @include('user.layout.partials.footer')
    @include('user.layout.partials.javascript')
    @include('sweetalert::alert')
</body>
</html>
