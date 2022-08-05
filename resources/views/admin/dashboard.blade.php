@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $course }}</h3>
                    <p>Courses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ route('course.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $murid }}</h3>

                    <p>Murid</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $mycor }}</h3>

                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Student in Course</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <th>Course</th>
                            <th>user</th>
                        </thead>
                        <tbody>
                            @foreach ($cour as $itemcor)
                                <tr>
                                    <td>
                                        {{ $itemcor->title }}
                                    </td>
                                    <td>{{ $itemcor->mycourse->count() }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.card -->
        </div>
    </div><!-- /.row -->
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush
