@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Level</h1>
    <div align="right" class="pt-1">
        <a href="" class="btn btn-success btn-xs"><i class="fa fa-sync"></i></a>
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fa fa-plus"> Input Level</i></button>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-hover" id="myTable">
            <thead>
                <th>No.</th>
                <th>Level</th>
                <th class="text-center">Aksi</th>
            </thead>
            <tbody> 
                @foreach ($level as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->grade }}</td>
                    <td align="center">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('level.edit',$item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{route('level.destroy', $item->id)}}" method="POST">
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
                <h4 class="modal-title">Input Level</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body">
                    <form method="POST" id="insert_form" action="{{ route('level.store') }}">
                        {{ csrf_field() }}
                        <label>Level</label>
                        <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" />
                        @error('level')
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
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush