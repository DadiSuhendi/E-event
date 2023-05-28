@extends('admin.layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Tipe Event</th>
                            <th>Judul Event</th>
                            <th>Total Pendaftar</th>
                            <th>Total Kehadiran</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($events as $event)
                        @php
                            $totalDaftar = $users->where('event_id', $event->id)->where('status_id', '>=', 1);
                            $totalHadir = $users->where('event_id', $event->id)->where('status_id', '>=' ,2);
                        @endphp
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $event->tipe }}</td>
                            <td>{{ $event->judul }}</td>
                            <td>{{ count($totalDaftar) }}</td>
                            <td>{{ count($totalHadir) }}</td>
                            <td>
                                <form id="formDelete" action="{{ route('riwayat.destroy', $event->id) }}" method="post" class="d-inline">
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