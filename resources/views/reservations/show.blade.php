@extends('layouts.main')

@section('container')
<div class="container">
    <h2 class="mb-4">Detail Reservasi</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Informasi Analisa</h5>
            <dl class="row">
                <dt class="col-sm-4">Nomor</dt>
                <dd class="col-sm-8"> : {{ $reservation->id }}</dd>

                <dt class="col-sm-4">Nama Analisa</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->name }}</dd>

                <dt class="col-sm-4">Harga</dt>
                <dd class="col-sm-8"> : Rp {{ number_format($reservation->harga, 0, ',', '.') }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8"> : {{ $reservation->status }}</dd>

            <h5 class="card-title mt-3 mb-3">Informasi Pemesan</h5>
                <dt class="col-sm-4">Nama Pemesan</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->name }}</dd>

                <dt class="col-sm-4">Nik</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->nik }}</dd>

                <dt class="col-sm-4">Email Pemesan</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->email }}</dd>

                <dt class="col-sm-4">Nomor Telepon</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->phone }}</dd>

                <dt class="col-sm-4">Instansi</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->company_name }}</dd>

                <dt class="col-sm-4">Alamat</dt>
                <dd class="col-sm-8"> : {{ $reservation->user->alamat }}</dd>

            @if ($reservation->analisa)
            <h5 class="card-title mt-3 mb-3">Detail Parameter</h5>
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                    <table class="table table-bordered border-dark table-striped align-middle">
                        <thead class="text-white border-1" style="background-color: #5c93f3;">
                            <tr>
                                <th>Parameter</th>
                                <th>Kategori</th>
                                <th>Metode</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservation->analisa->parameters as $parameter)
                                @if($reservation->parameters->contains($parameter->id))
                                    <tr>
                                        <td>{{ $parameter->name }}</td>
                                        <td>{{ $parameter->categoryParameter->name }}</td>
                                        <td>{{ $parameter->metode->name }}</td>
                                        <td>Rp {{ number_format($parameter->harga, 0, ',', '.') }}</td>
                                        <td>{{ $reservation->parameters->find($parameter->id)->pivot->jumlah }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </dl>
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Analisa yang terkait sudah dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('reservasi.index') }}" class="btn btn-primary">Kembali ke Daftar Reservasi</a>
    </div>
</div>
@endsection
