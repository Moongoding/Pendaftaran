@extends('layouts.main')
@section('container')
<div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <h2 class="text-center">Edit Metode</h2>
                        <form class="mt-4" method="POST" action="{{ route('metode.update', $metode->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <input type="text" value="{{ $metode->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Metode">
                                <label for="name" class="form-label">Nama Metode</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-4 mb-4 rounded-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
