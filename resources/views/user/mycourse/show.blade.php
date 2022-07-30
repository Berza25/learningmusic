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
                    <div class="col-md-8">
                        <h1>Description</h1>
                        <p style="align-content: justify">{{ $item->course->description }}</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Lesson</h4>
                        <div class="list-group">
                            @foreach ($item->course->lesson as $itemlesson)
                                @if (!empty($itemlesson->subject_matter))
                                    <div class="list-group-item list-group-item-action" disabled><span class="fa fa-file"></span> {{ $itemlesson->title }}</div>
                                @endif
                                @if (!empty($itemlesson->embed_id))
                                    <div class="list-group-item list-group-item-action" disabled><span class="fa fa-video"></span> {{ $itemlesson->title }}</div>
                                @endif
                            @endforeach
                        </div>
                        <br>
                        <h4>Progress</h4>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{ round($persen) }}%;" aria-valuenow="{{ round($persen) }}" aria-valuemin="0" aria-valuemax="100">{{ round($persen) }}%</div>
                        </div>
                        {{ Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count() }} of {{ $dl }}
                        <br>
                        <a href="{{ route('lesson.user.show', $les->slug) }}" class="btn btn-primary btn-block">Start</a>
                        <br>
                        <br>
                        <h4>Rating: {{ $item->rating }} / 5</h4>
                        <small>Rate the course:</small>
                        <form
                            style="
                            margin-top: 1rem;
                            display: flex;
                            align-items: center;
                            column-gap: 1rem;
                            "
                            action="{{ route('mycourse.rating', [$item->course->id]) }}" method="post" method="post">
                            @csrf
                            <select name="rating"
                                style="
                                height: 30px;
                                min-width: 30%;
                                border: none;
                                background-color: #e2e2e2;
                                border-radius: 0.8rem;
                                outline: none;
                            ">
                                <option value="1">1 - Awful</option>
                                <option value="2">2 - Not too good</option>
                                <option value="3">3 - Average</option>
                                <option value="4" selected>4 - Quite good</option>
                                <option value="5">5 - Awesome!</option>
                            </select>
                            <button class="button"
                                style="border: none; padding: 0.4rem 1.4rem; border-radius: 1rem">Submit</button>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-info" id="alert" style="margin-top: 1rem;display:flex;justify-content: space-between">
                            {{ session('success') }} <i class='bx bx-x' style="cursor:pointer;" id="close-alert"></i>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
