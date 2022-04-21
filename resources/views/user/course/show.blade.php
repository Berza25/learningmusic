@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">
            @foreach ($data as $item)
                <header class="section-header">
                    <p>{{ $item->title }}</p>
                </header>
                <div class="row">
                    <div class="col-lg-8">
                        <h1>Description</h1>
                        <p>{{ $item->description }}</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="{{ asset('materiimage/' . $item->image) }}" alt="" height="250">
                        <h4 class="mt-2">Rp{{ $item->price->paid }}</h4>
                        <button class="btn btn-primary"><i class="fa fa-cart"> Add to Cart</i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
