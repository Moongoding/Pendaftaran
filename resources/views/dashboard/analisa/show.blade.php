@extends('layouts.main')
@section('container')

@if($analisa)
    <h2>Detail Analisa: {{ $analisa->name }}</h2>
    <!-- Tabel Analisa -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Parameter</th>
                <th>Kategori Parameter</th>
                <th>Metode</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @if($analisa->parameters->count() > 0)
                @foreach($analisa->parameters as $parameter)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $parameter->name }}</td>
                    <td>{{ $parameter->categoryParameter->name }}</td>
                    <td>{{ $parameter->metode->name }}</td>
                    <td>Rp {{ number_format($parameter->harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">Data Parameter tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Total Harga -->
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td colspan="5" class="text-right"><strong>Total Harga Analisa:</strong></td>
                <td>Rp {{ number_format($analisa->harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
@else
    <h2>Data Analisa tidak ditemukan</h2>
@endif

@endsection
