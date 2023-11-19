@extends('layouts.main')
@section('container')

<h3>Tambah Analisa Baru</h3>

<form action="{{ route('analisa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <!-- Input Nama Analisa -->
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" id="name" placeholder="Nama Analisa" name="name"
                            required>
                        <label for="name" class="form-label">Nama Analisa</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label for="image" class="form-label">Upload Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
                            onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row justify-content-md-center">
                        <img class="img-preview img-fluid mb-3 col-md-5">
                    </div>

                    <!-- Tabel Parameter -->

                    <h5 class="card-title text-center mt-3">Pilih Parameter</h5>
                    <table class="table table-bordered border-dark table-striped align-middle">
                        <thead class="text-white border-1" style="background-color: #5c93f3;">
                            <tr>
                                <th>No</th>
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
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->categoryParameter->name }}</td>
                                <td>{{ $parameter->metode->name }}</td>
                                <td>
                                    {{ number_format($parameter->harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    <input type="checkbox" name="parameters[]" value="{{ $parameter->id }}"
                                        data-harga="{{ $parameter->harga }}">
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
                    <input type="text" class="form-control" id="totalHarga" readonly>
                    <input type="hidden" name="harga">
                    <button type="submit" class="btn btn-primary mt-3">Tambahkan Analisa</button>
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
        document.querySelector('input[name="harga"]').value = totalHarga;
    }

    // Event handler untuk setiap checkbox
    parameterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            // Hitung ulang total harga setiap kali checkbox berubah
            updateTotalHarga();
        });
    });

    // Fungsi untuk menginisialisasi total harga saat halaman dimuat
    function initTotalHarga() {
        updateTotalHarga(); // Hitung total harga saat halaman dimuat
    }

    document.addEventListener('DOMContentLoaded', function () {
        initTotalHarga(); // Inisialisasi total harga saat halaman dimuat
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
</script>

@endsection
