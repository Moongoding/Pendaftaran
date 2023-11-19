@extends('layouts.main')
@section('container')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card col-md-6">
        <div class="card-body">
            <h1 class="text-center">Edit Parameter</h1>
            <form action="{{ route('parameter.update', $parameter->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mt-3 form-floating">
                    <input type="text" value="{{ old('name', $parameter->name) }}" class="form-control @error('name') is-invalid @enderror" id="parameter" name="name" placeholder="Parameter">
                    <label for="parameter">Parameter</label>
                    @error('name')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- <div class="mt-3 form-group">
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option selected>Pilih Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $parameter->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                <div class="mt-3 form-group">
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="" selected>Pilih Category</option> <!-- Nilai default kosong -->
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $parameter->category_parameter_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mt-3 form-group">
                    <select class="form-select @error('metode_id') is-invalid @enderror" name="metode_id">
                        <option selected>Pilih Metode</option>
                        @foreach($metodes as $metode)
                            <option value="{{ $metode->id }}" {{ old('metode_id', $parameter->metode_id) == $metode->id ? 'selected' : '' }}>
                                {{ $metode->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('metode_id')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-3 form-floating">
                    <input step="any" type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Harga" value="{{ old('harga', $parameter->harga) }}">
                    <label for="harga">Harga</label>
                    @error('harga')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary rounded-4" style="width: 80%">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Fungsi untuk mengubah format harga menjadi rupiah
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    // Fungsi untuk mengubah input harga saat nilai berubah
    $('#harga').on('input', function () {
        var harga = $(this).val().replace(/\./g, ''); // Hapus tanda "." sebelum menghitung
        var formattedHarga = formatRupiah(harga);
        $(this).val(formattedHarga);
    });

    // Fungsi untuk menghapus tanda "." saat form disubmit
    $('form').submit(function () {
        var harga = $('#harga').val().replace(/\./g, ''); // Hapus tanda "." sebelum mengirim
        $('#harga').val(harga);
    });
</script>
@endsection
