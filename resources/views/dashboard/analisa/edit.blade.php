@extends('layouts.main')
@section('container')

<h2 class="mt-4">Edit Analisa: {{ $analisa->name }}</h2>

<form action="{{ route('analisa.update', $analisa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <!-- Input Nama Analisa -->
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $analisa->name) }}" id="name" placeholder="Nama Analisa"
                            name="name" required>
                        <label for="name" class="form-label">Nama Analisa</label>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Gambar -->
                    <div class="col-lg-6 mb-5">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="hidden" name="oldImage" value="{{ $analisa->image }}">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
                            onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row justify-content-md-center">
                        <img src="{{ $analisa->image ? asset('storage/' . $analisa->image) : '' }}" class="img-preview img-fluid mb-3 col-md-5">
                    </div>

                   <!-- Tabel Parameter -->
                    <h5 class="card-title text-center mt-3">Pilih Parameter</h5>
                    <table class="table datatable table-bordered border-dark table-striped align-middle">
                        <thead class="text-white border-1" style="background-color: #5c93f3;">
                            <tr>
                                <th>Parameter</th>
                                <th>Kategori</th>
                                <th>Metode</th>
                                <th>Harga</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->categoryParameter->name }}</td>
                                <td>{{ $parameter->metode->name }}</td>
                                <td>{{ number_format($parameter->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="checkbox" name="parameters[]"
                                        value="{{ $parameter->id }}" data-harga="{{ $parameter->harga }}" {{
                                        in_array($parameter->id, $selectedParameters) ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <!-- Ringkasan Total Harga -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Total Harga</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" id="totalHarga" readonly>
                        <input type="hidden" name="harga" value="{{ old('harga', $analisa->harga) }}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3">Edit Analisa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const parameterCheckboxes = document.querySelectorAll('input[name="parameters[]"]');
    const totalHargaElement = document.getElementById('totalHarga'); // Elemen total harga input

    // Fungsi untuk menghitung dan memperbarui total harga
    function updateTotalHarga() {
        let totalHarga = 0;

        parameterCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const harga = parseFloat(checkbox.getAttribute('data-harga'));
                totalHarga += harga;
            }
        });

        // Memformat nilai dengan tanda baca ribuan tanpa desimal
        const formattedTotalHarga = `Rp ${totalHarga.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,')}`;
        totalHargaElement.value = formattedTotalHarga; // Perbarui nilai input total harga
    }

    // Event handler untuk setiap checkbox
    parameterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateTotalHarga();
        });
    });

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    // Pemanggilan fungsi updateTotalHarga saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        updateTotalHarga();
    });
</script>

@endsection
