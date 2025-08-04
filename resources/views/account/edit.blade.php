@extends('layouts.template')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h4 class="mb-4">Edit Akun</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('account.update', $account['id']) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ $account['name'] }}" placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ $account['email'] }}" placeholder="contoh@email.com">
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label fw-semibold">Role</label>
                    <select name="role" id="role" class="form-select shadow-sm">
                        <option disabled hidden>Pilih Role</option>
                        <option value="cashier" {{ $account['role'] == 'cashier' ? 'selected' : '' }}>Cashier</option>
                        <option value="admin" {{ $account['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Ubah Password</label>
                    <input type="password" class="form-control shadow-sm" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-pencil-square me-1"></i> Ubah Data
                </button>
            </form>
        </div>
    </div>
@endsection
