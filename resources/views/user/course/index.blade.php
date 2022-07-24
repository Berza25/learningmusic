@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
    {{-- <section>

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Course</p>
        </header>
        <div class="row">
            @foreach ($kelas as $item)
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('courses.show', $item->slug) }}" class="box">
                        <img src="{{ asset('materiimage/' . $item->image) }}" class="img-fluid" alt="">
                    </a>
                    <h3 class="mt-5">{{ $item->title }}</h3>
                    <p>{{ substr($item->description, 0, 100) }}</p>
                    <h5 class="mt-2">Rp{{  number_format($item->price->paid,0,',','.') }}</h5>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}

<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8">
                <header class="section-header">
                    <p>Course</p>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 entries">
                @foreach ($kelas as $item)
                    <article class="entry">

                        <div class="entry-img">
                            <img src="{{ asset('materiimage/' . $item->image) }}" alt="" class="img-fluid">
                        </div>

                        <div class="entry-title d-flex justify-content-between">
                            <h4><a href="{{ route('courses.show', $item->slug) }}">{{ $item->title }}</a></h4>
                            @if ($item->price->paid == 0)
                                <h4>Free</h4>
                            @else
                                <h4>Rp{{ number_format($item->price->paid, 0, ',', '.') }}</h4>
                            @endif
                        </div>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                        href="{{ route('courses.show', $item->slug) }}">{{ $item->mycourse->count() }}
                                        Student</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                        href="{{ route('courses.show', $item->slug) }}">{{ date('d M Y', strtotime($item->created_at)) }}</a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                        href="{{ route('courses.show', $item->slug) }}">{{ $item->comment->count() }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-conten-center mb-4">
                            @for ($star = 1; $star <= 5; $star++)
                                @if ($item->rating >= $star)
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class='bi bi-star'></i>
                                @endif
                            @endfor
                        </div>
                        <div class="entry-content">
                            <p>
                                {{ $item->description }}
                            </p>
                            <div class="read-more">
                                <a href="{{ route('courses.show', $item->slug) }}"> Read More</a>
                            </div>
                        </div>

                    </article><!-- End blog entry -->
                @endforeach
                <div class="blog-pagination">
                    <ul class="justify-content-center">
                        {{ $kelas->links('vendor.pagination.bootstrap-4') }}
                    </ul>
                </div>
            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar">

                    <h3 class="sidebar-title">Search</h3>
                    <div class="sidebar-item search-form">
                        <form action="">
                            <input type="text">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!-- End sidebar search formn-->

                    <h3 class="sidebar-title">Level</h3>
                    <div class="sidebar-item categories">
                        <ul>
                            @foreach ($lev as $level)
                                <li><input type="radio" name="" id=""> {{ $level->grade }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- End sidebar categories-->
                    <h3 class="sidebar-title">Price</h3>
                    <div class="sidebar-item categories">
                        <ul>
                            <li><input type="radio" name="" id=""> Free</li>
                            <li><input type="radio" name="" id=""> Paid</li>
                        </ul>
                    </div <h3 class="sidebar-title">Tags</h3>
                    <div class="sidebar-item tags">
                        <ul>
                            <li><a href="#">App</a></li>
                            <li><a href="#">IT</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Office</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Studio</a></li>
                            <li><a href="#">Smart</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>
                    </div><!-- End sidebar tags-->

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>
@endsection
