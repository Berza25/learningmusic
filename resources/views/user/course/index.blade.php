@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section id="values" class="values">
      
    <div class="container" data-aos="fade-up">
      
      <header class="section-header">
        <p>View Course</p>
      </header>
      <div class="row">
        @foreach ($kelas as $item)
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <a href="{{ route('courses.show', $item->slug) }}"class="box">
            <img src="{{ asset('materiimage/'. $item->image)}}" class="img-fluid" alt="">
            <h3>{{ $item->title }}</h3>
            <p>{{ $item->description }}</p>
          </a>
        </div>
        @endforeach
      </div>
    </div>   
@endsection