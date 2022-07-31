@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4>Edit Course</h4>
    <div align="right" class="pt-1">
        <a href="{{ route('course.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
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
                    <label>Link Meet</label>
                    <input type="text" name="meet" id="meet" class="form-control @error('meet') is-invalid @enderror" value="{{ $course->meet }}" />
                    @error('meet')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <label>Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote">{{ $course->description }}</textarea>
                    @error('description')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <br />
                    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <a class="card-profile-image mt-4" href="{{ asset('materiimage/'. $course->image) }}" target="_blank">
                        <img height="100%" width="100%" id="preview-image" src="{{ asset('materiimage/'.$course->image) }}" />
                    </a>
                    <input type="file" class="form-control" name="image" id="image">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
        $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#summernote').summernote({
        height: 400
    });

    </script>
@endpush
