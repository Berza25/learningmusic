@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
        <div class="container" data-aos="fade-up">
            @foreach ($data as $item)
                <header class="section-header">
                    <p>{{ $item->title }}</p>
                </header>
                <div class="row">
                    <div class="col-lg-8">
                        <h1>Description</h1>
                        <p>{{ $item->description }}</p>
                        <br>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="{{ asset('materiimage/' . $item->image) }}" alt="" height="250">
                        <h4 class="mt-2">Rp{{ number_format($item->price->paid,0,',','.') }}</h4>

                        {{-- @if ($item->id == $cart->course_id)
                        <a href="{{ route('cart.index') }}" class="btn btn-primary"><i class="fa fa-cart"> Added to Cart</i></a>

                        @endif --}}
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $item->id }}">
                            <input type="hidden" name="total" value="{{ $item->price->paid }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cart"> Add to Cart</i></button>
                        </form>
                        {{-- @empty
                        @endforelse --}}
                    </div>
                </div>
            @endforeach
        </div>
@endsection
