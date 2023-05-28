@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        <a href="{{ route('pengguna.index') }}" type="submit" class="btn btn-secondary">
            Batal
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('pengguna.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email aktif</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_wa">Nomor WhatsApp</label>
                <input type="number" name="no_wa" class="form-control" value="{{ old('no_wa') }}">
                @error('no_wa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="level_id">Level</label>
                <select name="level_id" class="form-control">
                    <option value="" disabled selected>-- Pilih Level --</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->nama_level }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="event_id">Event</label>
                <select name="event_id" class="form-control">
                    <option value="" disabled selected>-- Pilih Event --</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->tipe . ' - ' . $event->judul }}</option>
                    @endforeach
                </select>
                @error('event_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection