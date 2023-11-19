@extends('layouts.main')

@section('container')

<div class="container">
    @if (auth()->user()->hasRole('Admin'))
    <h2>Edit Status</h2>
        <div class="card mt-3">
            <h4 class="mb-4 text-center">Detail Pendaftaran</h4>
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
                    <!-- Tambahkan atribut-atribut pengguna sesuai dengan migrations users -->

                    <dt class="col-sm-4">Nomor Telepon</dt>
                    <dd class="col-sm-8"> : {{ $reservation->user->phone }}</dd>

                    <dt class="col-sm-4">Instansi</dt>
                    <dd class="col-sm-8"> : {{ $reservation->user->company_name }}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8"> : {{ $reservation->user->alamat }}</dd>

                    @if ($reservation->analisa)
            <h5 class="card-title mt-3 mb-3">Informasi Parameter</h5>
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
                </dl>
            </div>
        </div>


        <form action="{{ route('reservasi.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Dalam Antrian" {{ $reservation->status === 'Dalam Antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                    <option value="Sedang Diproses" {{ $reservation->status === 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="Sudah Selesai" {{ $reservation->status === 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

    @elseif(auth()->user()->hasRole('Super_Admin'))
    <h2 class="mb-5">Edit Analisa {{ $reservation->analisa->name }}</h2>
        <form action="{{ route('reservasi.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="totalHarga" class="form-label">Total Harga</label>
                <input type="text" class="form-control" id="totalHarga" name="totalHarga" value="{{ old('harga', $reservation->harga) }}" readonly>
                <input type="hidden" name="harga">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Dalam Antrian" {{ $reservation->status === 'Dalam Antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                    <option value="Sedang Diproses" {{ $reservation->status === 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="Sudah Selesai" {{ $reservation->status === 'Sudah Selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="analisa" class="form-label">Nama Analisa</label>
                <input type="text" class="form-control @error('analisa') is-invalid @enderror"
                    value="{{ $reservation->analisa->name }}" name="analisa" id="analisa" readonly>
            </div>

            <div class="mb-4 parameters">
                <h3 class="mb-3">Pilih Parameter untuk {{ $reservation->analisa->name }}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Kategori</th>
                            <th>Metode</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservation->analisa->parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->categoryParameter->name }}</td>
                                <td>{{ $parameter->metode->name }}</td>
                                <td>Rp {{ number_format($parameter->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control jumlah-input" name="jumlah[{{ $parameter->id }}]"
                                        placeholder="Jumlah" value="{{ old('jumlah.' . $parameter->id, isset($jumlahParameter[$parameter->id]) ? $jumlahParameter[$parameter->id] : '') }}" min="1">
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parameter-checkbox" type="checkbox" name="parameters[]"
                                            value="{{ $parameter->id }}" data-harga="{{ $parameter->harga}}"
                                            {{ in_array($parameter->id, old('parameters', $reservation->parameters->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

    @else
        <h2 class="mb-5">Edit Analisa {{ $reservation->analisa->name }}</h2>
        <form action="{{ route('reservasi.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="totalHarga" class="form-label">Total Harga</label>
                <input type="text" class="form-control" id="totalHarga" name="totalHarga" value="{{ old('harga', $reservation->harga) }}" readonly>
                <input type="hidden" name="harga">
            </div>
            <input type="text" class="form-control @error('analisa') is-invalid @enderror"
                value="{{ $reservation->analisa_id }}" name="analisa" id="analisa" hidden>
            <h5 class="card-title text-center mb-3">Pilih Parameter</h5>
            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                <table class="table table-bordered border-dark table-striped align-middle">
                    <thead class="text-white border-1" style="background-color: #5c93f3;">
                        <tr>
                            <th>Parameter</th>
                            <th>Kategori</th>
                            <th>Metode</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservation->analisa->parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->categoryParameter->name }}</td>
                                <td>{{ $parameter->metode->name }}</td>
                                <td>Rp {{ number_format($parameter->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control jumlah-input" name="jumlah[{{ $parameter->id }}]"
                                        placeholder="Jumlah" value="{{ old('jumlah.' . $parameter->id, isset($jumlahParameter[$parameter->id]) ? $jumlahParameter[$parameter->id] : '') }}" min="1">
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parameter-checkbox" type="checkbox" name="parameters[]"
                                            value="{{ $parameter->id }}" data-harga="{{ $parameter->harga}}"
                                            {{ in_array($parameter->id, old('parameters', $reservation->parameters->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    @endif
</div>
@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.jumlah-input').on('input', function() {
            updateTotalHarga();
        });

        $('.parameter-checkbox').change(function() {
            updateTotalHarga();
        });

        function updateTotalHarga() {
            var totalHarga = 0;
            $('.parameter-checkbox:checked').each(function() {
                var $row = $(this).closest('tr');
                var harga = parseFloat($(this).data('harga'));
                var $jumlahInput = $row.find('.jumlah-input');
                var jumlah = parseInt($jumlahInput.val()) || 1;

                // Handle disabled inputs
                if ($jumlahInput.is(':disabled')) {
                    jumlah = 1;
                }

                // Set jumlah parameter ke nilai yang dihitung
                $jumlahInput.val(jumlah);

                totalHarga += harga * jumlah;
            });

            var formattedTotalHarga = 'Rp ' + totalHarga.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
            $('#totalHarga').val(formattedTotalHarga);
            $('input[name="harga"]').val(totalHarga);
        }
    });
</script>


