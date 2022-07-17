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
                        <h4>Lesson</h4>
                        <div class="list-group">
                            @foreach ($item->lesson as $itemlesson)
                                @if (!empty($itemlesson->subject_matter))
                                    <div class="list-group-item list-group-item-action" disabled><span class="fa fa-file"></span> {{ $itemlesson->title }}</div>
                                @endif
                                @if (!empty($itemlesson->embed_id))
                                    <div class="list-group-item list-group-item-action" disabled><span class="fa fa-video"></span> {{ $itemlesson->title }}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="{{ asset('materiimage/' . $item->image) }}" alt="" height="250">
                        <h4 class="mt-2">Rp{{ number_format($item->price->paid,0,',','.') }}</h4>

                            {{-- @if($cart->status_cart == 'cart')
                            <a href="{{ route('cart.index') }}" class="btn btn-primary">Added to Cart</a>
                            @else --}}
                        {{-- {{ $item->cart()->where('user_id', auth()->id())->where('status_cart', 'checkout')->where('course_id', $item->id)->count() == 1 }} --}}
                        @if (auth()->check())
                            @if ($item->cart()->where('user_id', auth()->id())->where('status_cart', 'checkout')->where('course_id', $item->id)->count() == 1)
                            <a href="{{ route('lesson.user.index', $item->id) }}" class="btn btn-primary">Start Lesson</a>
                            @elseif (!$item->cart()->where('user_id', auth()->id())->where('status_cart', 'cart')->where('course_id', $item->id)->count() == 1)
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $item->id }}">
                                <input type="hidden" name="total" value="{{ $item->price->paid }}">
                                <button type="submit" class="btn btn-primary">Add to Cart </button>
                            </form>
                            @else
                            <a href="{{ route('cart.index') }}" class="btn btn-primary">Added to Cart</a>
                            @endif
                        @else
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $item->id }}">
                            <input type="hidden" name="total" value="{{ $item->price->paid }}">
                            <button type="submit" class="btn btn-primary">Add to Cart </button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
@endsection
