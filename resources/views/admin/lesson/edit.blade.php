@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4>Edit Lesson</h4>
    <div align="right" class="pt-1">
        <a href="{{ route('lesson.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" id="insert_form" action="{{ route('lesson.update', $lesson->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label>Course</label>
                    <select class="form-control @error('course_id') is-invalid @enderror" height="100%" value="{{ $lesson->course->title }}" name="course_id">
                        <option value="" selected disabled>Select Course</option>
                        @foreach ($courses as $course )
                            @if ($lesson->course_id == $course->id)
                                <option value="{{ $course->id }}" selected> {{ $course->title}}</option>
                            @else
                            <option value="{{ $course->id }}"> {{ $course->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br>
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $lesson->title }}" />
                    @error('title')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br>
                    @if (!$lesson->embed_id == NULL)
                    <label>Video</label>
                    <input type="text" name="embed_id" id="embed_id" class="form-control @error('embed_id') is-invalid @enderror" value="{{ $lesson->embed_id }}" />
                    @error('embed_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br>
                    @else
                    <label>Subject Matter</label>
                    <input type="file" name="subject_matter" id="subject_matter" class="form-control @error('subject_matter') is-invalid @enderror" accept=".pdf"/><span value="{{ $lesson->subject_matter }}">{{ $lesson->subject_matter }}</span>
                    @error('subject_matter')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br />
                    @endif
                    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
