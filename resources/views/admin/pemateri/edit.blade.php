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
        <form action="{{ route('pemateri.update', $pemateri->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="nama_pemateri">Nama Pemateri</label>
                <input type="text" class="form-control" id="nama_pemateri" name="nama_pemateri" placeholder="Nama Pemateri" value="{{ old('nama_pemateri', $pemateri->nama_pemateri) }}" required>
                @error('nama_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="gelar_pemateri">Gelar Pemateri</label>
                <input type="text" class="form-control" id="gelar_pemateri" name="gelar_pemateri" placeholder="Gelar Pemateri" value="{{ old('gelar_pemateri', $pemateri->gelar_pemateri) }}" required>
                @error('gelar_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Pemateri</label>
                <textarea id="deskripsi" class="form-control" name="deskripsi_pemateri" rows="10" cols="50" required>{{ old('deskripsi_pemateri', $pemateri->deskripsi_pemateri) }}</textarea>
                @error('deskripsi_pemateri')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" name="oldImage" value="{{ $pemateri->gambar_pemateri }}">
                <label for="gambar_pemateri">Gambar Pemateri</label>
                @if ($pemateri->gambar_pemateri)
                    <img src="{{ asset('uploads/' . $pemateri->gambar_pemateri) }}" class="img-preview img-fluid col-sm-6 d-block" style="margin: 10px;">
                @else
                    <img class="img-preview img-fluid col-sm-6 d-block">
                @endif
                <input type="file" class="form-control" name="gambar_pemateri" id="image" onchange="previewImage()">
                @error('gambar_pemateri')
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