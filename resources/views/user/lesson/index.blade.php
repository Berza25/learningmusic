@extends('user.layout.app')
@section('title', 'Lesson')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4">
                @foreach ($lesson as $item)
                {{-- <header class="section-header"> --}}
                    <p>{{ $item->course->title }}</p>
                {{-- </header> --}}
                <h3>Lesson</h3>
                <div class="list-group">
                    @foreach ($item->course->lesson as $itemless)
                    <a class="list-group-item list-group-item-action" href="{{ route('lesson.user.show', $itemless->slug) }}">{{ $itemless->title }}</a>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
