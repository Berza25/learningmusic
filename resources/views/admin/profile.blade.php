@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4>Edit Profile</h4>
    <div align="right" class="pt-1">
        <a href="/dashboard" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" id="insert_form" action="{{ route('profiladmin.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" />
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" />
                    @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <span class="small text-danger">*Jika tidak mengganti password, harap dikosongkan</span>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="current_password">Current password</label>
                                <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="new_password">New password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="confirm_password">Confirm password</label>
                                <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <br />
                    <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    @if ($user->foto == NULL)
                    <img height="100%" width="100%" id="preview-image" src={{ asset('images.png') }} />
                    @else
                    <a class="card-profile-image mt-4" href="{{ asset('images/users/'. $user->foto) }}" target="_blank">
                        <img height="100%" width="100%" id="preview-image" src="{{ asset('images/users/'. $user->foto) }}" />
                    </a>
                    @endif
                    <input type="file" class="form-control" name="foto" id="image">
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
    </script>
@endpush
