@extends('layouts.main')
@section('container')

<h3>Add New User</h3>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama" autofocus required value="{{ old('name') }}" id="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                <button class="btn btn-outline-secondary" type="button" id="showPasswordToggle">
                    <i id="showPasswordIcon" class="ti ti-eye-off"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
            </div>


            <div class="form-group mb-4">
                <label for="roles" class="form-label">Pilih Role</label>
                <select class="form-select @error('roles') is-invalid @enderror" name="roles">
                    <option selected>Open this select menu</option>
                    @foreach ($roles as $role)
                    @if (old('roles') == $role->id)
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('roles')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Create User</button>
            </div>
        </form>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const showPasswordToggle = document.getElementById('showPasswordToggle');
    const showPasswordIcon = document.getElementById('showPasswordIcon');

    showPasswordToggle.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordIcon.className = 'ti ti-eye-check';
        } else {
            passwordInput.type = 'password';
            showPasswordIcon.className = 'ti ti-eye-off';
        }
    });
</script>

@endsection
