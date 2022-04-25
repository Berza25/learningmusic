@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Materi</h1>
    <div align="right" class="pt-1">
        <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Input Materi</i></button>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-hover" id="myTable">
            <thead>
                <th>No.</th>
                <th>Title</th>
                <th>Subject Matter</th>
                <th>Level</th>
                <th>Price</th>
                <th>Link Video</th>
                <th>Description</th>
                <th>Images</th>
                </th>
                <th class="text-center">Aksi</th>
            </thead>
            <tbody>
                @foreach ($materi as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->subject }}</td>
                    <td>{{ $item->level->grade }}</td>
                    <td>{{ $item->price->paid }}</td>
                    <td>{{ $item->link }}</td>
                    <td>{{ $item->description }}</td>
                    <td><a href="{{asset('materiimage/'. $item->image)}}" target="_blank"><img src="{{asset('materiimage/'.$item->image)}}" width="50px" height="50px" alt=""></td>
                    <td align="center">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('course.edit',$item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{route('course.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="dropdown-item btn"><i class="fa fa-trash"></i> Hapus</button>
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
                <h4 class="modal-title">Input Materi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body">
                    <form method="POST" id="insert_form" action="{{ route('course.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"value="{{ old('title') }}" />
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Subject Matter</label>
                        <input type="file" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" />
                        @error('subject')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Level</label>
                        <select class="form-control level @error('level_id') is-invalid @enderror" height="100%" value="{{ old('level_id') }}" name="level_id">
                            <option value="" selected disabled>Select Level</option>
                            @foreach ($levels as $level )
                                @if (old('level_id') == $level->id)
                                    <option value="{{ $level->id }}" selected> {{ $level->grade }}</option>
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
                        <select class="form-control price @error('price_id') is-invalid @enderror" height="100%" value="{{ old('price_id') }}" name="price_id">
                            <option value="" selected disabled>Select Price</option>
                            @foreach ($prices as $price )
                                @if (old('price_id') == $price->id)
                                    <option value="{{ $price->id }}" selected> {{ $price->paid}}</option>
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
                        <label>Link Video</label>
                        <input type="text" name="link_video" id="link_video" class="form-control @error('link_video') is-invalid @enderror" value="{{ old('link_video') }}" />
                        @error('link_video')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" />
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>Images</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" />
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
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
