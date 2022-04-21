@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section>

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
                    <p>{{ $item->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
