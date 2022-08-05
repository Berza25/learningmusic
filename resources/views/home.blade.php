@extends('user.layout.app')
@section('title', 'Home')
@section('section')
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            {{-- <img src="{{ asset('hero.png') }}" class="img-fluid" alt=""> --}}
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up" class="text-black">The Best Moment of The Perfomance, When You Hit The Tune, Everyone Cheers</h1>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    {{-- <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>View Course</p>
            </header>
            <div class="row">
                @foreach ($kelas as $item)
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
    </section> --}}
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <p>Courses</p>
                <h4 class="mt-4">Popular</h4>
            </header>
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    @foreach ($kelas as $item)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="profile mt-auto">
                                <img src="{{ asset('materiimage/' . $item->image) }}" class="img-fluid" alt="">
                                <h3>{{ $item->title }}</h3>
                                <h4>{{ $item->level->grade }}</h4>
                            </div>
                            <div class="stars">
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($item->rating >= $star)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class='bi bi-star'></i>
                                    @endif
                                @endfor
                                ({{ $item->rating }})
                            </div>
                            <h3>
                                Rp{{ number_format($item->price->paid, 0, ',', '.') }}
                            </h3>
                            <a href="{{ route('courses.show', $item->slug) }}"
                                class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End testimonial item -->
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="align-items-center">
                    <a href="{{ route('courses.index') }}" class="btn btn-primary"> View all course</a>
                </div>
            </div>
        </div>
    </section>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection
