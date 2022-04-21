@extends('layouts.app')
@section('content')
Edit Price
<form method="POST" id="insert_form" action="{{ route('price.update', $price->id) }}">
    {{ csrf_field() }}
    @method('PUT')
    <label>Price</label>
    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $price->paid }}" />
    @error('price')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
    <br />
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
</form>
@endsection