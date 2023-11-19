@extends('layouts.main')
@section('container')

<div class="container mt-5">

    <form method="post" action="{{ route('home.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" autofocus value="{{ old('title') }}" placeholder="Judul">
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
                        <input type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" name="title2" placeholder="Title2" autofocus value="{{ old('title2') }}" placeholder="Judul ke 2">
                        <label for="title2">Judul ke 2</label>
                        @error('title2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

        <!-- Konten -->

            <div class="form-group">
                <label for="editor">Body</label>
                <textarea class="form-control" id="editor" name="body">{{ old('body') }}</textarea>
                @error('body')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        <!-- Akhir Konten -->

        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <strong>Halo {{ auth()->user()->name }}</strong> Disarankan Buat 15 - 20 kata body, dan hanya satu Content untuk tampilan yang baik
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

<!-- Garis pemisah -->

<div class="text-success">
    <hr class="border border-primary border-2 opacity-75">
</div>

@if ($homes->isEmpty())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Tidak ada content yang dapat di tampilkan <strong>Buat Content Sekarang</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@else


<div class="container mt-5">
    <table class="table datatable table-bordered border-dark table-striped align-middle">
        <thead class="text-white border-1" style="background-color: #5c93f3;">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 100px">Judul</th>
                <th scope="col" style="width: 100px">Judul ke 2</th>
                <th scope="col">Body</th>
                <th scope="col" style="width: 80px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($homes as $home)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $home->title }}</td>
                    <td>{{ $home->title2 }}</td>
                    <td>{{ $home->body }}</td>
                    <td class="align-middle">
                        <a href="{{ route('home.edit', $home->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('home.destroy', $home->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $home->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $home->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<script>
@if (Session::has('alert.delete'))
    function confirmDelete(id) {
    var sessionData = JSON.parse(document.getElementById('deleteForm-' + id).getAttribute('data-session-delete'));

    Swal.fire({
        title: '{{ $title }}',
        text: '{{ $text }}',
        icon: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
    }).then(function(result) {
        if (result.isConfirmed) {
            // Set data sesi kembali ke sesi
            {!! Session::put('alert.delete', 'sessionData') !!};

            // Lanjutkan dengan penghapusan
            var form = document.getElementById('deleteForm-' + id);
            if (form) {
                form.submit();
            }
        }
    });
}

@endif
</script>

@endsection
