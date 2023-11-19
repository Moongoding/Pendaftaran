@extends('layouts.main')
@section('container')

@if ($homes->isEmpty())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Tidak ada konten yang dapat ditampilkan <strong><a href="{{ route('home.create') }}">Buat Content Sekarang</a></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
<h4>Content Home</h4>
<div class="container mt-5">
    <table class="table datatable table-bordered border-dark table-striped align-middle">
        <thead class="text-white text-center border-1" style="background-color: #5c93f3;">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 100px">Judul</th>
                <th scope="col" style="width: 100px">Judul ke-2</th>
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
                    <td class="align-middle text-center">
                        <a href="{{ route('home.edit', $home->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<hr class="border border-primary m-3 border-2 opacity-50">

@if ($abouts->isEmpty())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Tidak ada konten yang dapat ditampilkan <strong><a href="{{ route('about.create') }}">Buat Content Sekarang</a></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
<h4>Content About</h4>
<div class="container mt-5">
    <table class="table datatable table-bordered border-dark table-striped align-middle">
        <thead class="text-white text-center border-1" style="background-color: #5c93f3;">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 100px">Judul</th>
                <th scope="col" style="width: 100px">Judul ke-2</th>
                <th scope="col">Paragraf</th>
                <th scope="col">Body</th>
                <th scope="col" style="width: 80px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($abouts as $about)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $about->title }}</td>
                    <td>{{ $about->title2 }}</td>
                    <td>{{ $about->body }}</td>
                    <td>{{ $about->body2 }}</td>
                    <td class="align-middle text-center">
                        <a href="{{ route('about.edit', $about->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
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
