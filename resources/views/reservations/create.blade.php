@extends('layouts.main')
@section('container')

<div class="container">
    <h2 class="mb-4">Tambah Reservasi</h2>

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="analisa" class="form-label">Pilih Analisa</label>
            <select class="form-select" name="analisa" id="analisa">
                <option selected>Open this select menu</option>
                @foreach($analisas as $analisa)
                    <option value="{{ $analisa->id }}">{{ $analisa->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Menambahkan elemen untuk menampilkan total harga -->
        <div class="mb-3">
            <label for="totalHarga" class="form-label">Total Harga</label>
            <input type="text" class="form-control" id="totalHarga" name="totalHarga" readonly>
            <input type="hidden" name="harga">
        </div>
        @foreach($analisas as $analisa)
            <div class="mb-4 parameters" data-analisa-id="{{ $analisa->id }}">
                <h5 class="mb-3 text-center">Pilih Parameter untuk {{ $analisa->name }}</h5>
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
                        @foreach($analisa->parameters as $parameter)
                            <tr>
                                <td>{{ $parameter->name }}</td>
                                <td>{{ $parameter->categoryParameter->name }}</td>
                                <td>{{ $parameter->metode->name }}</td>
                                <td>Rp {{ number_format($parameter->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" class="form-control jumlah-input" name="jumlah[]" placeholder="Jumlah" value="1" min="1" disabled>
                                </td>
                                <td>
                                    <input class="form-check-input parameter-checkbox" type="checkbox" name="parameters[]"
                                        value="{{ $parameter->id }}" data-harga="{{ $parameter->harga }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach



        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<style>
    /* CSS untuk menyembunyikan tabel parameter */
    .parameters {
        display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#analisa').change(function() {
            var selectedAnalisaId = $(this).val();
            var selectedAnalisaName = $('#analisa option:selected').text();

            // Menyembunyikan semua tabel
            $('.parameters').hide();

            // Menampilkan tabel yang sesuai dengan analisa yang dipilih
            $('.parameters[data-analisa-id="' + selectedAnalisaId + '"]').show();
            updateTotalHarga(); // Panggil fungsi untuk menghitung total harga
        });

           // Event handler untuk input jumlah
           $('.jumlah-input').on('input', function() {
            var $jumlahInput = $(this);
            var jumlah = parseInt($jumlahInput.val()) || 0; // Pastikan jumlah adalah angka positif atau nol

            // Jika jumlah negatif, ubah nilainya menjadi 0
            if (jumlah < 0) {
                jumlah = 0;
                $jumlahInput.val(jumlah);
            }
            updateTotalHarga();
        });


        // Event handler untuk setiap checkbox
        $('.parameter-checkbox').change(function() {
        var $checkbox = $(this);
        var $jumlahInput = $checkbox.closest('tr').find('.jumlah-input');

        // Jika checkbox dicentang, aktifkan input jumlah; jika tidak, nonaktifkan
        if ($checkbox.is(':checked')) {
            $jumlahInput.prop('disabled', false);
        } else {
            $jumlahInput.prop('disabled', true);
            $jumlahInput.val('1'); // Kembalikan ke 1 saat tidak dicentang
        }

            updateTotalHarga();

        });

        // Fungsi untuk menghitung dan memperbarui jumlah
        function updateJumlah() {
            $('.parameter-checkbox').each(function() {
                var $checkbox = $(this);
                var $jumlahInput = $checkbox.closest('tr').find('.jumlah-input');
                var harga = parseFloat($checkbox.data('harga'));
                var jumlah = $checkbox.is(':checked') ? parseInt($jumlahInput.val()) : 1;

                // Periksa apakah jumlah adalah angka yang valid
                if (isNaN(jumlah) || jumlah < 0) {
                    jumlah = 1;
                }

                $jumlahInput.val(jumlah); // Memperbarui nilai input jumlah
                $checkbox.closest('tr').find('.jumlah-cell').text(jumlah);
            });
        }

        // Fungsi untuk menghitung dan memperbarui total harga
        function updateTotalHarga() {
            var totalHarga = 0;

            $('.parameter-checkbox:checked').each(function() {
                var harga = parseFloat($(this).data('harga'));
                var jumlah = parseInt($(this).closest('tr').find('.jumlah-input').val());
                totalHarga += harga * jumlah;
            });

            // Memformat nilai dengan tanda baca ribuan tanpa desimal
            var formattedTotalHarga = 'Rp ' + totalHarga.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
            $('#totalHarga').val(formattedTotalHarga);
            document.querySelector('input[name="harga"]').value = totalHarga;
        }
    });
</script>

@endsection
