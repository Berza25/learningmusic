@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section>

    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>Course</p>
        </header>
        <div class="row">
            @forelse ($materi as $item)
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('mycourse.show', $item->id) }}" class="box">
                        <img src="{{ asset('materiimage/' . $item->course->image) }}" class="img-fluid" alt="">
                    </a>
                    <h3 class="mt-5">{{ $item->course->title }}</h3>
                    <p>{{ substr($item->course->description, 0, 100) }}</p>
                </div>
            @empty
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <p class="mt-5">Anda Tidak Memiliki Course, Silahkan Beli Course Terlebih Dahulu <a href="/courses">Klik Disini</a></p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
