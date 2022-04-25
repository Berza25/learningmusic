@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section>

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Course</p>
        </header>
        <div class="row">
            @foreach ($materi as $item)
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('mycourse.show', $item->course->slug) }}" class="box">
                        <img src="{{ asset('materiimage/' . $item->course->image) }}" class="img-fluid" alt="">
                    </a>
                    <h3 class="mt-5">{{ $item->course->title }}</h3>
                    <p>{{ $item->course->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
