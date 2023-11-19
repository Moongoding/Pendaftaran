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
            </div>


        </div>
    </div>
    <div class="col-md-8">
        <!-- Account details card-->
        <div class="card">
            <div class="card-header">Account Details</div>
            <div class="card-body">

                <!-- Form Group (username)-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control"
                                placeholder="nama" readonly value="{{ $user->name }}" id="name">
                            <label for="name" class="form-label">Nama</label>
                        </div>
                    </div>


                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="nik" class="form-control"
                                placeholder="Nik" readonly value="{{ $user->nik }}" id="nik">
                            <label for="nik" class="form-label">Nik</label>

                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="npwp" class="form-control"
                        id="npwp" placeholder="NPWP" value="{{ $user->npwp }}" readonly>
                    <label for="npwp" class="form-label">NPWP</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control"
                        id="email" placeholder="email" value="{{ $user->email }}" readonly>
                    <label for="email" class="form-label">Email</label>
                </div>

                <!-- Form Row        -->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (organization name)-->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="company_name"
                                class="form-control" id="company_name"
                                placeholder="Nama Perusahaan" value="{{ $user->company_name }}" readonly>
                            <label for="email" class="form-label">Nama Perusahaan</label>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="alamat" class="form-control"
                                id="alamat" placeholder="Alamat" value="{{ $user->alamat }}" readonly>
                            <label for="email" class="form-label">Alamat</label>

                        </div>
                    </div>
                </div>

                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (phone number)-->

                    <div class="form-floating mb-3">
                        <input type="text" name="phone" class="form-control"
                            id="phone" placeholder="No Telephone" value="{{ $user->phone }}" readonly>
                        <label for="email" class="form-label">No Telephone</label>
                    </div>
                </div>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
