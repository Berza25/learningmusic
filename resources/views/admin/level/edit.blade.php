@extends('layouts.app')
@section('content')
Edit Level
<form method="POST" id="insert_form" action="{{ route('level.update', $level->id) }}">
    {{ csrf_field() }}
    @method('PUT')
    <label>Level</label>
    <input type="text" name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ $level->grade }}" />
    @error('grade')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br />
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
</form>
@endsection
