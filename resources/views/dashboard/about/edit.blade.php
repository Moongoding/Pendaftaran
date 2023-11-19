@extends('layouts.main')
@section('container')
<div class="container mt-5">
    <h3 class="mb-4">{{ $title }}</h3>
    <form method="post" action="{{ route('about.update', $about->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-floating">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" autofocus value="{{ $about->title }}">
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
                    <input type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" name="title2" placeholder="Title2" autofocus value="{{ $about->title2 }}">
                    <label for="title2">Judul</label>
                    @error('title2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Paragraf" id="editor" name="body">{{ $about->body }}</textarea>
            <label for="editor">Paragraf</label>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Body" id="editor" name="body2">{{ $about->body2 }}</textarea>
            <label for="editor">Body</label>
            @error('body2')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
