@extends('admin.adminMain')

@section('judul', 'Data Admin')
@section('konten')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
        </div>
        <div class="card-body">
         @if(session('msg'))
            <div class="alert alert-success" style="padding: 1.75rem 2.25rem; !important">
            {{session('msg')}}
            </div>
        @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($admins as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama_admin}}</td>
                            <td>{{$data->username}}</td>
                            <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{$data->id_admin}}"><i class="fas fa-fw fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal-{{$data->id_admin}}"><i class="fas fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Admin</h6>
        </div>
        <div class="card-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger" style="padding: 1.75rem 2.25rem; !important">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
        <form action="/add-admin" method="POST">
        {{ csrf_field() }}
            <div class="form-group"><label>Nama Lengkap</label>
                <input name="nama" class="form-control" type="text" placeholder="Jhon Doe">
            </div>
            <div class="form-group"><label>Username</label>
                <input name="username" class="form-control"  type="text" placeholder="jhondoe@admin">
            </div>
            <div class="form-group"><label">Password</label>
                <input name="password" class="form-control"  type="password" placeholder="*********">
            </div>
                <button style="float:right;" type="submit" class="btn btn-success">Tambah</button>
        </form>
        </div>
    </div>  
</div>

@foreach($admins as $data)  
<div class="modal fade" id="editModal-{{$data->id_admin}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data {{$data->nama_admin}} </h5>
        </div>
        <form action="/update-admin" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger" style="padding: 1.75rem 2.25rem; !important">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
        <div class="form-group mb-2">
            <label"> Nama Lengkap</label>
            <input class="form-control" type="hidden" name="id_admin" value={{$data->id_admin}}>
            <input class="form-control" type="text" name="nama" value={{$data->nama_admin}}>
            </div>
            <div class="form-group mb-2">
            <label"> Username</label>
            <input class="form-control" type="text" name="username"  value={{$data->username}}>
            </div>
            <div class="form-group mb-2">
            <label"> Password Baru</label>
            <input class="form-control" type="password" name="password"  value="">
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Update</button>
        </div>
        </form>
    </div>
    </div>
</div>

<div class="modal fade" id="hapusModal-{{$data->id_admin}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
            </div>
            <div class="modal-body">Apakah yakin ingin menghapus data {{$data->nama_admin}} ? </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="/hapus-admin/{{$data->id_admin}}" type="button" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection

