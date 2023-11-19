@extends('layouts.main')
@section('container')

<div class="card">
    <div class="card-header">
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Add User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
            <table class="table datatable table-bordered border-dark table-striped align-middle">
                <thead class="text-white border-1" style="background-color: #5c93f3;">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        {{ $role->name }}
                        {{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="badge bg-primary"><i class="ti ti-eye"></i></a>
                        <a href="{{ route('users.edit', $user->id) }}" class="badge bg-warning"><i class="ti ti-edit"></i></a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                            id="deleteForm-{{ $user->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="confirmDelete({{ $user->id }})"
                                class="badge bg-danger border-0" data-confirm-delete="true"
                                data-session-delete="{{ json_encode(Session::get('alert.delete')) }}">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
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
