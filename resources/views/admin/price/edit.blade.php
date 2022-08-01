@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4>Edit Price</h4>
    <div align="right" class="pt-1">
        <a href="{{ route('price.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<form method="POST" id="insert_form" action="{{ route('price.update', $price->id) }}">
    @csrf
    @method('PUT')
    <label>Price</label>
    <input type="number" name="paid" id="paid" class="form-control @error('paid') is-invalid @enderror" value="{{ $price->paid }}" />
    @error('paid')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
    <br />
    <label>Status</label>
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
    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
</form>
@endsection
