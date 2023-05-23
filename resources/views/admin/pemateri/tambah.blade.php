@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        <a href="{{ route('pemateri.index') }}" type="submit" class="btn btn-secondary">
            Batal
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('pemateri.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_pemateri">Nama Pemateri</label>
                <input type="text" class="form-control" id="nama_pemateri" name="nama_pemateri" placeholder="Nama Pemateri" value="{{ old('nama_pemateri') }}" required>
                @error('nama_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="gelar_pemateri">Gelar Pemateri</label>
                <input type="text" class="form-control" id="gelar_pemateri" name="gelar_pemateri" placeholder="Gelar Pemateri" value="{{ old('gelar_pemateri') }}" required>
                @error('gelar_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi_pemateri">Deskripsi Pemateri</label>
                <textarea id="deskripsi" class="form-control" name="deskripsi_pemateri" rows="10" cols="50" required>{{ old('deskripsi_pemateri') }}</textarea>
                @error('deskripsi_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="gambar_pemateri">Gambar Pemateri</label>
                <img class="img-preview img-fluid col-sm-6 d-block">
                <input type="file" class="form-control" name="gambar_pemateri" id="image" onchange="previewImage()">
                @error('gambar_pemateri')
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