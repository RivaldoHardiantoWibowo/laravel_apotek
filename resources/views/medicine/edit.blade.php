@extends('layouts.template')

@section('content')
    <div class="card shadow rounded p-5">
        <h4 class="mb-4 fw-bold text-primary">Edit Data Obat</h4>

        @if ($errors->any())
            <div class="alert alert-danger p-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('medicine.update', $medicine['id']) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label fw-semibold">Nama Obat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $medicine['name'] }}" placeholder="Contoh: Paracetamol" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="type" class="col-sm-3 col-form-label fw-semibold">Jenis Obat</label>
                <div class="col-sm-9">
                    <select name="type" id="type" class="form-select" required>
                        <option disabled hidden>Pilih Jenis</option>
                        <option value="tablet" {{ $medicine['type'] == 'tablet' ? 'selected' : '' }}>Tablet</option>
                        <option value="sirup" {{ $medicine['type'] == 'sirup' ? 'selected' : '' }}>Sirup</option>
                        <option value="kapsul" {{ $medicine['type'] == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-3 col-form-label fw-semibold">Harga Obat (Rp)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="price" name="price"
                        value="{{ $medicine['price'] }}" placeholder="Masukkan harga satuan" required>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
