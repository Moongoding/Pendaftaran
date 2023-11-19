@extends('layouts.main')
@section('container')
<style>
.img-account-profile {
    height: 10rem;
    width: 10rem;
    overflow: hidden;
}

.img-account-profile img {
    max-width: 100%;
    overflow: hidden;
    border-radius: 50%;
}

.rounded-circle {
    border-radius: 50% !important;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}

.card .card-header {
    font-weight: 500;
}

.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}

.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}

.form-control,
.dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>
<div class="row">
    <div class="col-md-4 mb-4">
        <!-- Profile picture card-->
        <div class="card">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->

                @if ($user->image)
                    <img class="img-preview img-account-profile rounded-circle mb-2"
                    src="{{ $user->image ? asset('storage/' . $user->image) : '' }} " alt="">
                @else
                    <img class="img-preview img-account-profile rounded-circle mb-2"
                    src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                @endif

                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                <!-- Profile picture upload button-->
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input class="btn btn-primary form-control @error('image') is-invalid @enderror" type="file"
                        id="image" name="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>


        </div>
    </div>
    <div class="col-md-8">
        <!-- Account details card-->
        <div class="card">
            <div class="card-header">Account Details</div>
            <div class="card-body">

                <div class="row gx-3 mb-3">
                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="nama" autofocus required value="{{ $user->name }}" id="name">
                            <label for="name" class="form-label">Nama</label>
                            @error('name')
                            <div class="invalid-feedback mb-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>


                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="Nik" autofocus required value="{{ $user->nik }}" id="nik">
                            <label for="nik" class="form-label">Nik</label>
                            @error('nik')
                            <div class="invalid-feedback mb-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="npwp" class="form-control @error('npwp') is-invalid @enderror"
                        id="npwp" placeholder="NPWP" value="{{ $user->npwp }}">
                    <label for="npwp" class="form-label">NPWP</label>
                    @error('npwp')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="email" value="{{ $user->email }}">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                    <div class="invalid-feedback mb-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Form Row        -->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                                placeholder="Nama Perusahaan" value="{{ $user->company_name }}">
                            <label for="email" class="form-label">Nama Perusahaan</label>
                            @error('company_name')
                            <div class="invalid-feedback mb-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" placeholder="Alamat" value="{{ $user->alamat }}">
                            <label for="email" class="form-label">Alamat</label>
                            @error('alamat')
                            <div class="invalid-feedback mb-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (phone number)-->

                    <div class="form-floating mb-3">
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" placeholder="No Telephone" value="{{ $user->phone }}">
                        <label for="email" class="form-label">No Telephone</label>
                        @error('phone')
                        <div class="invalid-feedback mb-4">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group my-4">
                        <label for="roles" class="form-label">Pilih Role</label>
                        <select class="form-select" name="roles[]">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <!-- Save changes button-->
                <button class="btn btn-primary" type="submit">Save changes</button>
                <a href="{{ route('users.index')}}" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
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
