@extends('layouts.template')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h4 class="mb-4">Tambah Akun Baru</h4>

            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('account.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control shadow-sm" id="name" name="name" placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email" placeholder="contoh@email.com">
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label fw-semibold">Role</label>
                    <select name="role" id="role" class="form-select shadow-sm">
                        <option selected disabled hidden>Pilih Role</option>
                        <option value="cashier">Cashier</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data
                </button>
            </form>
        </div>
    </div>
@endsection
