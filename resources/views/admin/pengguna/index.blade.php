@extends('admin.layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Judul Event</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        @php
                            $event = $events->where('id', $user->event_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->level_id == 2)
                                <td>Admin</td>
                            @else
                                <td>User</td>
                            @endif
                            @if ($user->event_id)
                                <td>{{ $event->judul }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>
                                <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form id="formDelete" action="{{ route('pengguna.destroy', $user->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" onclick="alertDelete()" id="btnDelete" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection