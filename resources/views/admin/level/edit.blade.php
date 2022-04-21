@extends('layouts.app')
@section('content')
Edit Level
<form method="POST" id="insert_form" action="{{ route('level.update', $level->id) }}">
    {{ csrf_field() }}
    @method('PUT')
    <label>Level</label>
    <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ $level->level }}" />
    @error('level')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br />
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
</form>
@endsection