@extends('admin.layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <a href="{{ route('data-event.create') }}" class="btn btn-primary">
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
                            <th width="100">Tipe</th>
                            <th>Judul</th>
                            <th width="100">Tanggal</th>
                            <th width="30">Jam</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $event->tipe }}</td>
                            <td>{{ $event->judul }}</td>
                            <td>{{ $event->tanggal }}</td>
                            <td>{{ $event->jam }}</td>
                            <td>
                                <form id="formKonfirmasi" action="{{ route('selesaiEvent', $event->id) }}" method="post" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <button type="button" class="btn btn-primary" onclick="konfirmasiSelesaiEvent()" id="btnKonfirmasi" title="Selesaikan Event">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('updateStatus', $event->id) }}" method="post" class="d-inline">
                                    @method('put')
                                    @csrf
                                    @if ($event->status == 'nonaktif')
                                    <button type="submit" class="btn btn-success" title="Perlihatkan Event">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-success" title="Sembunyikan Event">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @endif
                                </form>
                                <a href="{{ route('data-event.edit', $event->id) }}" class="btn btn-info" title="Edit Data Event">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form id="formDelete" action="{{ route('data-event.destroy', $event->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" onclick="alertDelete()" id="btnDelete" class="btn btn-danger" title="Hapus Data Event">
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