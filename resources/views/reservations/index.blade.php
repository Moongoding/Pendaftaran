@extends('layouts.main')
@section('container')

@if ($reservations->isEmpty())

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Anda belum Terdaftar<strong><a href="{{ route('reservasi.create') }}"> Yuk Buat</a></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@else
    <div class="container">
        <a href="{{ route('reservasi.create') }}" class="btn bg-info text-white mb-5"><i class="ti ti-circle-plus"></i> Tambah Reservasi</a>
        <h2 class="mb-4">Daftar Reservasi</h2>

        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
            <table class="table table-bordered border-dark table-striped align-middle">
                <thead class="text-white border-1 text-center" style="background-color: #5c93f3;">
                    <tr>
                        <th>No</th>
                        <th>Pesanan</th>
                        <th>Analisa</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="width: 200px">
                            @if ($reservations->where('analisa', '!=', null)->count() > 0)
                                @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super_Admin'))
                                    Edit
                                @else
                                    Action
                                @endif
                            @else
                                Keterangan
                            @endif
                        </th>
                    </tr>
                </thead>
            <tbody class ="text-center">
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($reservation->user)
                            {{ $reservation->user->name }}
                        @else
                            Pengguna Telah Dihapus
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
                        @if ($reservation->analisa && $reservation->user)
                            @if($reservation->status == "Dalam Antrian")
                                <span class="badge bg-info">Dalam Antrian</span>
                            @elseif($reservation->status == "Sedang Diproses")
                                <span class="badge bg-warning">Sedang Diproses</span>
                            @elseif($reservation->status == "Sudah Selesai")
                                <span class="badge bg-success">Sudah Selesai</span>
                            @endif
                        @else
                        <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $reservation->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                <span class="badge bg-danger">Tidak tersedia</span>
                            </button>
                        </form>
                        @endif
                    </td>
                    @if ($reservation->analisa && $reservation->user)
                        @if(auth()->user()->hasRole('Admin'))
                            <td>
                                <a href="{{ route('reservasi.edit', $reservation->id) }}" class="btn btn-sm btn-info">Ubah Status</a>
                            </td>
                        @elseif(auth()->user()->hasRole('Super_Admin'))
                            <td class="align-middle">
                                <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-info"><i class="ti ti-eye-check"></i></a>
                                <a href="{{ route('reservasi.edit', $reservation->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                                <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $reservation->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        @else
                            @if ($reservation->status == "Dalam Antrian")
                                <td class="align-middle">
                                    <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-info"><i class="ti ti-eye-check"></i></a>
                                    <a href="{{ route('reservasi.edit', $reservation->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $reservation->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @elseif ($reservation->status == "Sedang Diproses")
                            <td>
                                <a href="{{ route('reservasi.show', $reservation->id) }}" class="badge bg-info bg-gradient"><i class="ti ti-eye-check"> Sudah Dalam Proses</i></a>
                                {{-- <span class="badge bg-primary bg-gradient">Sudah Dalam Proses</span> --}}
                            </td>
                            @endif
                        @endif
                    @else
                    <td>
                        <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $reservation->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $reservation->id }})" class="badge bg-danger border-0" data-confirm-delete="true" data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                <span class="badge bg-danger">Tidak tersedia</span>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
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
