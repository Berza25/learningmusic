@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Admin</h1>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ ucfirst($item->role) }}</td>
                            <td align="center">
                                <button class="btn btn-primary editButton" data-toggle="modal" data-target="#editModal" value="{{ $item->id}}"><i class="fa fa-edit"></i> Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Users</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <form method="post" id="editModalForm" action="{{route('users.store')}}">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" readonly />
                            <br />
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" readonly />
                            <br/>
                            <label>Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="murid">Murid</option>
                            </select>
                            <br/>
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success" />
                        </div>
                    </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> {{-- modal --}}
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        $(document).on("click", ".editButton", function()
            {
                let id = $(this).val();
                $.ajax({
                    method: "get",
                    url :  "/admin/users/"+id+"/edit",
                }).done(function(response)
                {
                    $("#name").val(response.name);
                    $("#email").val(response.email);
                    $("#role").val(response.role);
                    $("#editModalForm").attr("action", "/admin/users/" + id)
                });
            });
    </script>
@endpush
