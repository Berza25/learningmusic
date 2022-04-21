@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
<section id="values" class="values">
      
    <div class="container" data-aos="fade-up">
      @foreach ($data as $item )
      <header class="section-header">
        <p>{{ $item->title }}</p>
      </header>
      <div class="row">
          <div class="col-8-md">
              <h1>description</h1>
              <p>{{ $item->description }}</p>
          </div>
      </div>
      @endforeach
    </div>   
@endsection