@extends('user.layout.app')
@section('title', 'Lesson')
@section('content')
    {{-- <section id="values" class="values"> --}}
        <div class="container" data-aos="fade-up">
            @foreach ($data as $item)
                <div class="row pt-5">
                    <div class="col-md-8">
                        <header class="section-header">
                            <p>{{ $item->title }}</p>
                        </header>
                        @if (!empty($item->subject_matter))
                            <iframe width="100%" height="1200" src="{{ asset('foldermateri/' . $item->subject_matter) }}"
                                frameborder="0"></iframe>
                        @endif
                        @if (!empty($item->embed_id))
                            <div class="container">
                                <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/{{ $item->embed_id }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        <br>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Lesson</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sertifikat</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="list-group">
                                        @foreach ($item->course->lesson as $itemlesson)
                                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ request()->segment(3) == $itemlesson->slug ? 'active' : '' }}"
                                                href="{{ route('lesson.user.show', $itemlesson->slug) }}">{{ $itemlesson->title }}
                                                <span>
                                                    <form action="{{ route('lesson.user.completion') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="lesson_id" value="{{ $itemlesson->id }}">
                                                        @if (empty(Auth::user()->lessonstudent()->where('lesson_id', $itemlesson->id)->count() == 0))
                                                        <input class="justify-content-between align-items-right" type="checkbox" name="status" checked disabled>
                                                        @else
                                                        <input class="justify-content-between align-items-right" onclick="this.form.submit();" value="1" type="checkbox" name="status">
                                                        @endif
                                                    </form>
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    @if(round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) == 100)
                                    Download Sertifikat
                                    <form action="{{ route('sertif') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="title_course" value="{{ $item->course->title }}">
                                        <input type="hidden" name="level_course" value="{{ $item->course->level->grade }}">
                                        <button class="btn btn-primary" type="submit">Download</button>
                                    </form>
                                    @else
                                    <h4>Progress</h4>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}%;" aria-valuenow="{{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}" aria-valuemin="0" aria-valuemax="100">{{ round(Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count()/$item->course->lesson->count()*100) }}%</div>
                                    </div>
                                    {{ Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count() }} of {{ $item->course->lesson->count() }}
                                    @endif
                                </div>
                                </div>
                            </div>

                            </div>
                        </div>
                </div>
            @endforeach
        </div>
    {{-- </section> --}}

@endsection
