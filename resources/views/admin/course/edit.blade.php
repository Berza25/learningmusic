@extends('layouts.app')
@section('content')
Edit Materi
<form method="POST" id="insert_form" action="{{ route('course.update', $course->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $course->title }}" />
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Subject Matter</label>
                        <input type="file" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ $course->subject}}" />
                        {{-- @error('subject')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror --}}
                        <label>Level</label>
                        <select class="form-control level @error('level_id') is-invalid @enderror" height="100%" value="{{ $course->level->grade }}" name="level_id">
                            <option value="" selected disabled>Select Level</option>
                            @foreach ($levels as $level )
                                @if ($course->level_id == $level->id)
                                    <option value="{{ $level->id }}" selected> {{ $course->level->grade }}</option>
                                @else
                                <option value="{{ $level->id }}"> {{ $level->grade }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('level')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Price</label>
                        <select class="form-control price @error('price_id') is-invalid @enderror" height="100%" value="{{ $course->price->paid }}" name="price_id">
                            <option value="" selected disabled>Select Price</option>
                            @foreach ($prices as $price )
                                @if ($course->price_id == $price->id)
                                    <option value="{{ $price->id }}" selected> {{ $course->price->paid}}</option>
                                @else
                                <option value="{{ $price->id }}"> {{ $price->paid }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('price')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Link Video</label>
                        <input type="text" name="link_video" id="link_video" class="form-control @error('link_video') is-invalid @enderror" value="{{ $course->link}}" />
                        @error('link_video')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $course->description }}" />
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
    <br />
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
</form>
@endsection
