
@extends('layout/app')

@section('content')
    <div class="col-md-10 p-5 pt-5 dasboard">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (session()->has('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h3>Booking App Account</h3><hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/form_tambah_pengguna" class="btn btn-outline-light ms-1 mb-2">Akun baru <i class="fas fa-plus"></i></a>
        </div>
        <table class="table table-striped table-hover table-light ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" colspan="2" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $d => $item)
            <tr>
                <th scope="row">{{ $d+1 }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->role->role }}</td>
                <td>
                    <form action="/hapus_pengguna" method="post"></form>
                    {{-- @method('delete') --}}
                    @csrf
                    <button class="btn btn-danger" onclick="return comfirm('yakin mau menghapus data? data yang dihapus tidak dapat dipulihkan kembali.')"><i class="fa-solid fa-trash"></i></button>
                    {{-- <a href="/hapus_pengguna" class="btn btn-danger" onclick="return comfirm('yakin mau menghapus data? data yang dihapus tidak dapat dipulihkan kembali.')"><i class="fa-solid fa-trash"></i></a> --}}
                </td>
                <td>
                    <a href="#" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/dashboard_admin" class="btn btn-outline-light ms-1">kembali</a>
    </div>
@endsection
