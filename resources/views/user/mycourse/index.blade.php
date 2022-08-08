@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<div class="container" data-aos="fade-up">
    <header class="section-header">
        <p>My Course</p>
    </header>
    @if (count($materi)>0)
    <div class="row">
        @foreach ($materi as $item)
        <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('mycourse.show', $item->id) }}" class="box">
                    <img src="{{ asset('materiimage/' . $item->course->image) }}" class="img-fluid" alt="">
                </a>
                <div class="progress mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}%;" aria-valuenow="{{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}" aria-valuemin="0" aria-valuemax="100">{{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}%</div>
                </div>
                {{ Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count() }} of {{ $item->course->lesson->count() }}
                <h3 class="mt-5">{{ $item->course->title }}</h3>
                <p>{!! $item->course->description !!}</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
        <p class="mt-5">Anda Tidak Memiliki Course, Silahkan Beli Course Terlebih Dahulu <a href="/courses">Klik Disini</a></p>
    </div>
    @endif
</div>
@endsection
