@extends('layouts.main')
@section('container')
<div class="container mt-5">
    <h3 class="mb-4">{{ $title }}</h3>
    <form method="post" action="{{ route('home.update', $home->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" autofocus value="{{ $home->title }}">
                    <label for="title">Judul</label>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" name="title2" placeholder="Title2" autofocus value="{{ $home->title2 }}">
                    <label for="title2">Judul</label>
                    @error('title2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="editor">Body</label>
            <textarea class="form-control" id="editor" name="body">{{ $home->body }}</textarea>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
