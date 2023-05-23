@extends('admin.layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <a href="{{ route('keuntungan.create') }}" class="btn btn-primary">
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
                            <th>Keuntungan / Manfaat</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($keuntungans as $keuntungan)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $keuntungan->keuntungan }}</td>
                            <td>
                                <a href="{{ route('keuntungan.edit', $keuntungan->id) }}" class="btn btn-info">Edit</a>
                                <form id="formDelete" action="{{ route('keuntungan.destroy', $keuntungan->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" onclick="alertDelete()" id="btnDelete" class="btn btn-danger">Delete</button>
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