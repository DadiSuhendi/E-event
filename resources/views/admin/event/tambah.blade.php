@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        <a href="{{ route('data-event.index') }}" type="submit" class="btn btn-secondary">
            Batal
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('data-event.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipe">Tipe Event</label>
                <select name="tipe" id="tipe" class="form-control">
                    <option value="">-- Pilih Tipe Event --</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Seminar">Seminar</option>
                </select>
                @error('tipe')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="judul">Judul Event</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                @error('judul')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Event</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10">
                    {{ old('deskripsi') }}
                </textarea>
                @error('deskripsi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="pemateri">Pemateri Event</label>
                <div class="">
                    <select id="select-tools-pemateri" name="pemateris[]" placeholder="Pilih Pemateri">
                        <option value=""></option>
                        @foreach ($pemateris as $pemateri)
                            <option value="{{ $pemateri->id }}">{{ $pemateri->nama_pemateri }}</option>
                        @endforeach
                    </select>
                </div>
                @error('pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="keuntungans">Keuntungan Event</label>
                <div class="">
                    <select id="select-tools-keuntungan" name="keuntungans[]" placeholder="Pilih Keuntungan">
                        <option value=""></option>
                        @foreach ($keuntungans as $keuntungan)
                            <option value="{{ $keuntungan->id }}">{{ $keuntungan->keuntungan }}</option>
                        @endforeach
                    </select>
                </div>
                @error('keuntungan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Event</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai Event</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                <small>Jika event hanya 1 hari, kosongkan saja.</small>
                @error('tanggal_selesai')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="jam">Jam Event</label>
                <input type="time" name="jam" class="form-control" value="{{ old('jam') }}">
                @error('jam')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Harga Event</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
                @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Event</label>
                <img class="img-preview img-fluid col-sm-6 d-block">
                <input type="file" class="form-control" name="gambar" id="image" onchange="previewImage()">
                <small>Jika tidak ada gambar, kosongkan saja.</small>
                @error('gambar')
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