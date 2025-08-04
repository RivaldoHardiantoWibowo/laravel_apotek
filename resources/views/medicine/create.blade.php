@extends('layouts.template')

@section('content')
    <div class="card shadow-sm border-0 p-4">
        <h4 class="mb-4 border-bottom pb-2">Tambah Obat Baru</h4>

        <form action="{{ route('medicine.store') }}" method="POST">
            @csrf

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

            <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label fw-semibold">Nama Obat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Paracetamol">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="type" class="col-sm-3 col-form-label fw-semibold">Jenis Obat</label>
                <div class="col-sm-9">
                    <select name="type" id="type" class="form-select">
                        <option selected disabled hidden>Pilih jenis obat</option>
                        <option value="tablet">Tablet</option>
                        <option value="sirup">Sirup</option>
                        <option value="kapsul">Kapsul</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-3 col-form-label fw-semibold">Harga</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="price" name="price" placeholder="Contoh: 15000">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="stock" class="col-sm-3 col-form-label fw-semibold">Stok Tersedia</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Contoh: 20">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data
                </button>
            </div>
        </form>
    </div>
@endsection
