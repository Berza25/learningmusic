@extends('user.layout.app')
@section('title', 'Lesson')
@section('content')
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">

                <header class="section-header">
                    {{-- <p>{{ $item->title }}</p> --}}
                </header>
                <div class="row">
                    {{-- <div class="col-md-8">

                        @if ( !empty($item->subject_matter) )
                            <iframe width="700" height="300" src="{{ asset('foldermateri/'. $item->subject_matter) }}" frameborder="0"></iframe>
                        @endif
                        @if ( !empty($item->embed_id) )
                        <div class="container">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $item->embed_id }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @endif
                    <br>
                    </div> --}}
                    <div class="col-md-4">
                        <h3>Lesson</h3>
                        <div class="list-group">
                            @foreach ($lesson as $item)
                            <a class="list-group-item list-group-item-action" href="{{ route('lesson.user.show', $item->slug) }}">{{ $item->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
