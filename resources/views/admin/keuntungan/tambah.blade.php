@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center w-100">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        <a href="{{ route('keuntungan.index') }}" type="submit" class="btn btn-secondary">
            Batal
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('keuntungan.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="keuntungan">Keuntungan / Manfaat</label>
                <input type="text" class="form-control" id="keuntungan" name="keuntungan" placeholder="Keuntungan / Manfaat" value="{{ old('keuntungan') }}" required>
                @error('keuntungan')
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