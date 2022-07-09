@extends('user.layout.app')
@section('title', 'Courses')
@section('content')
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">
            @foreach ($data as $item)
                <header class="section-header">
                    <p>{{ $item->course->title }}</p>
                </header>
                <div class="row">
                    <div class="col-lg-8">
                        <h1>Description</h1>
                        <p>{{ $item->course->description }}</p>
                        <br>
                    <div class="media">
                        <div class="media-body">
                            @foreach ($item->course->subjectmattercourse as $itemsubject)
                                {{-- <ul>
                                    <li>{{ $itemsubject->subject_matter }}</li>
                                </ul> --}}
                                <iframe src="{{ asset('foldermateri/'. $itemsubject->subject_matter) }}" frameborder="0"></iframe>
                            @endforeach
                            @foreach ($item->course->videocourse as $itemvideo)
                            <iframe width="560" height="315" src={{ $itemvideo->video }} frameborder="0" allowfullscreen></iframe>
                            @endforeach
                            {{-- {!! $item->link !!} --}}
                        </div>
                    </div>
                    <br>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
