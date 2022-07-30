@extends('layouts.app')
@section('content')
Edit Price
<form method="POST" action="{{ route('price.update', $price->id) }}">
    {{ csrf_field() }}
    <label>Price</label>
    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $price->paid }}" />
    @error('price')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
    <br />
    <label>Price</label>
    <select name="status" value={{ $price->status }} class="form-control">
        <option value="Free" {{ $price->status == 'Free' ? 'selected' : ''}}>Free</option>
        <option value="Paid" {{ $price->status == 'Paid' ? 'selected' : ''}}>Paid</option>
    </select>
        {{-- <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $price->paid }}" /> --}}
    @error('price')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
    </br>
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
</form>
@endsection
