@extends('user.layout.app')
@section('title', 'Lesson')
@section('content')
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">
            @foreach ($data as $item)
                <header class="section-header">
                    <p>{{ $item->title }}</p>
                </header>
                <div class="row">
                    <div class="col-md-8">

                        @if ( !empty($item->subject_matter) )
                            <iframe width="100%" height="1200" src="{{ asset('foldermateri/'. $item->subject_matter) }}" frameborder="0"></iframe>
                        @endif
                        @if ( !empty($item->embed_id) )
                        <div class="container">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $item->embed_id }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @endif
                    <br>
                    </div>
                    <div class="col-md-4">
                        <h3>Lesson</h3>
                        <div class="list-group">
                            @foreach ($item->course->lesson as $itemlesson)
                                    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == $itemlesson->slug) ? 'active' : '' }}" href="{{ route('lesson.user.show', $itemlesson->slug) }}">{{ $itemlesson->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
