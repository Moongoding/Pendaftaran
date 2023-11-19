@extends('layouts.main')
@section('container')

@if ($analisas->isEmpty())

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Tidak ada Analisa yang dapat di tampilkan <strong><a href="{{ route('analisa.create') }}"> Buat Analisa Sekarang</a></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@else

<a href="{{ route('analisa.create') }}" class="btn bg-info text-white mb-5"><i class="ti ti-circle-plus"></i> Tambah Analisa</a>
<div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
    <table class="table table-bordered border-dark table-striped align-middle">
        <thead class="text-white border-1" style="background-color: #5c93f3;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Analisa</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($analisas as $analisa)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $analisa->name }}</td>
                    <td>{{ number_format($analisa->harga, 0, ',', '.') }}</td>
                    <td class="align-middle">
                        <a href="{{ route('analisa.show', $analisa->id) }}" class="badge bg-info"><i class="ti ti-eye-check"></i></a>
                        <a href="{{ route('analisa.edit', $analisa->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('analisa.destroy', $analisa->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $analisa->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $analisa->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
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
                @php
                    Session::put('alert.delete', 'sessionData');
                @endphp

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
