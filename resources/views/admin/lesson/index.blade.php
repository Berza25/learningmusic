@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Materi Course</h1>
        <div align="right" class="pt-1">
            <a href="" class="btn btn-success"><i class="fa fa-sync"></i></a>
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"
                class="btn btn-primary"><i class="fa fa-plus"> Input Materi Course</i></button>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Subject Matter</th>
                    <th>Link Video</th>
                    </th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($lesson as $item)
                    <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->course->title }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->subject_matter }}</td>
                            <td>{{ $item->embed_id }}</td>

                            <td align="center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('lesson.edit', $item->id) }}"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('lesson.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                class="dropdown-item btn"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modals Tambah data -->
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Materi Course</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="insert_form" action="{{ route('lesson.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label>Course</label>
                        <select class="form-control course @error('course_id') is-invalid @enderror" height="100%"
                            value="{{ old('course_id') }}" name="course_id">
                            <option value="" selected disabled>Select course</option>
                            @foreach ($courses as $course)
                                @if (old('course_id') == $course->id)
                                    <option value="{{ $course->id }}" selected> {{ $course->title }}</option>
                                @else
                                    <option value="{{ $course->id }}"> {{ $course->title }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" />
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Subject_matter</label>
                        <input type="file" name="subject_matter" id="subject_matter" class="form-control @error('subject_matter') is-invalid @enderror"
                            value="{{ old('subject_matter') }}" />
                        @error('subject_matter')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Video</label>
                        <input type="text" name="video" id="video" class="form-control @error('video') is-invalid @enderror"
                            value="{{ old('video') }}" />
                        @error('video')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush
