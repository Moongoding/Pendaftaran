@extends('layouts.main')
@section('container')
<div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <h3 class="text-center">Tambah Category Dalam Parameter</h3>
                        <form class="mt-4" method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Nama Category">
                                <label for="name" class="form-label">Nama Category</label>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-4 mb-4 rounded-2">Tambah Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
