@extends('admin.layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <a href="{{ route('pemateri.create') }}" class="btn btn-primary">
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
                            <th>Nama Pemateri</th>
                            <th>Gelar / Pekerjaan Pemateri</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($pemateris as $pemateri)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $pemateri->nama_pemateri }}</td>
                            <td>{{ $pemateri->gelar_pemateri }}</td>
                            <td>
                                <a href="{{ route('pemateri.edit', $pemateri->id) }}" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form id="formDelete" action="{{ route('pemateri.destroy', $pemateri->id) }}" method="post" class="d-inline">
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