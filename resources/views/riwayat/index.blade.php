@extends('layouts.main')
@section('container')

<div class="container">
    @if ($reservations->isEmpty())
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Analisa belum selesai. Mohon menunggu, dan jika Anda belum membuat analisanya, <strong><a href="{{ route('reservasi.create') }}">Yuk buat sekarang</a></strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <a href="{{ route('reservasi.create') }}" class="btn bg-info text-white mb-5"><i class="ti ti-circle-plus"></i> Tambah Reservasi</a>
        <h2 class="mb-4">Riwayat Reservasi</h2>

        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
            <table class="table table-bordered border-dark table-striped align-middle">
                <thead class="text-white border-1 text-center" style="background-color: #5c93f3;">
                    <tr>
                        <th>No</th>
                        <th>Pesanan</th>
                        <th>Analisa</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="width:200px;">Action</th>
                    </tr>
                </thead>
                <tbody class= "text-center">
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@if ($reservation->user)
                            {{ $reservation->user->name }}
                        @else
                            User sudah tidak ada
                        @endif
                        </td>
                        <td>
                            @if ($reservation->analisa)
                                {{ $reservation->analisa->name }}
                            @else
                                Analisa sudah tidak tersedia
                            @endif
                        </td>
                        <td>Rp {{ number_format($reservation->harga, 0, ',', '.') }}</td>
                        <td>
                            @if(!$reservation->user || !$reservation->analisa)
                               <span class="badge bg-danger">Tidak tersedia</span>
                            @else
                                 @if($reservation->status == "Dalam Antrian")
                                    <span class="badge bg-info">Dalam Antrian</span>
                                @elseif($reservation->status == "Sedang Diproses")
                                    <span class="badge bg-warning">Sedang Diproses</span>
                                @elseif($reservation->status == "Sudah Selesai")
                                    <span class="badge bg-sucses">
                                        <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-success"><i class="ti ti-eye-check"> Sudah Selesai</i></a>
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->hasRole('Admin'))
                                 @if(!$reservation->user || !$reservation->analisa)
                                    <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline badge bg-danger" id="deleteForm-{{ $reservation->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                            <i class="ti ti-trash">Tidak Tersedia </i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('reservasi.edit', $reservation->id) }}" class="btn btn-sm btn-info">Ubah Status</a>
                                    <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline badge bg-danger border-0" id="deleteForm-{{ $reservation->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @elseif(auth()->user()->hasRole('Super_Admin'))
                                <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-info"><i class="ti ti-eye-check"></i></a>
                                <a href="{{ route('reservasi.edit', $reservation->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                                <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $reservation->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-success"><i class="ti ti-eye-check"> Sudah Selesai</i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
    </div>
    @endif
</div>

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
