@extends('user.layout.app')
@section('title', 'Home')
@section('section')
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with
                        Bootstrap</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Get Started</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('hero.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section>
@endsection
@section('content')
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>Who We Are</h3>
                        <h2>Expedita voluptas omnis cupiditate totam eveniet nobis sint iste. Dolores est repellat corrupti
                            reprehenderit.</h2>
                        <p>
                            Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor
                            consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est
                            corrupti.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Read More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('berzalogo.jpg') }}" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </section>

    <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>View Course</p>
            </header>
            <div class="row">
                @foreach ($kelas as $item)
                    {{-- <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
                <img src="{{ asset('materiimage/'. $item->image)}}" class="img-fluid" alt="">
                <a href="{{ route('courses.show', $item->slug) }}">
                    <h3>{{ $item->title }}</h3>
                </a>
                <h5>Rp{{ number_format($item->price->paid,0,',','.') }}</h5>
                @for ($star = 1; $star <= 5; $star++)
                    @if ($item->rating >= $star)
                    <i class="fa fa-star"></i>
                    @else
                    <i class='fa star-empty'></i>
                    @endif
                @endfor
                    <p>({{ $item->mycourse->count() }})</p>
                <p>{{ $item->mycourse->count() }} Student </p>
            </div>
            </div> --}}
                    <div class="col-lg-4 pt-2">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('materiimage/' . $item->image) }}" class="img-fluid"
                                    alt=""></div>
                            <span class="post-date">{{ $item->mycourse->count() }} Student</span>
                            <h3 class="post-title">{{ $item->title }}</h3>
                            <h5>{{ $item->level->grade }}</h5>
                            <div class="d-flex justify-conten-center mb-4">
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($item->rating >= $star)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class='bi bi-star'></i>
                                    @endif
                                @endfor
                            </div>
                            <h3 class="post-date">Rp{{ number_format($item->price->paid, 0, ',', '.') }}</h3>
                            <a href="{{ route('courses.show', $item->slug) }}"
                                class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
