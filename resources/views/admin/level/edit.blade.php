@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4>Edit Level</h4>
    <div align="right" class="pt-1">
        <a href="{{ route('level.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
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
    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
</form>
@endsection
