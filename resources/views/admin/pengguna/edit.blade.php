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
        <form action="{{ route('pengguna.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="e_mail">Email aktif</label>
                <input type="text" id="e_mail" disabled class="form-control" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="no_wa">Nomor WhatsApp</label>
                <input type="number" name="no_wa" class="form-control" value="{{ old('no_wa', $user->no_wa) }}">
                @error('no_wa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="level_id">Level</label>
                <select name="level_id" class="form-control">
                    <option value="{{ $user->level_id }}" selected>{{ $level->nama_level }}</option>
                    <option value="" disabled>-- Pilih Level --</option>
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
                    <option value="{{ $user->event_id }}" selected>{{ $event->tipe . ' - ' . $event->judul }}</option>
                    <option value="" disabled>-- Pilih Event --</option>
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
                    <i class="fa fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection