@extends('layouts.main')
@section('container')

@if ($parameters->isEmpty())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Tidak ada parameter yang terkait pada <strong>{{ $category->name }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<h3 class="mb-4">{{ $category->name }}</h3>
@else

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Ini adalah Tabel Parameter berdasarkan semua yang terikat pada <strong>{{ $category->name }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<h3 class="mb-4">{{ $category->name }}</h3>
<div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
    <table class="table datatable table-bordered border-dark table-striped align-middle">
        <thead class="text-white border-1" style="background-color: #5c93f3;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Parameter</th>
                <th scope="col">Metode</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $parameter)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $parameter->name }}</td>
                    <td>{{ $parameter->metode->name }}</td>
                    <td>{{ number_format($parameter->harga, 0, ',', '.') }}</td>
                    {{-- <td>{{ $parameter->harga }}</td> --}}
                    {{-- <td>{{ $category->parameter->name }}</td> --}}
                    <td class="align-middle">

                        <form action="{{ route('parameter.destroy', $parameter->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $parameter->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $parameter->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
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
@endsection
