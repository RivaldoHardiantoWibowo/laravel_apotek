@extends('layouts.template')
@section('content')
    <div class="container mt-3">
        <form action="{{ route('kasir.order.store') }}" class="card m-auto p-5" method="POST">
            @csrf

            @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            @endif

            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            <p>Penanggung jawab : <b>{{ Auth::user()->name }}</b></p>
            <div class="mb-3 row">
                <label for="name_customer" class="col-sm-2 col-form-label">Nama Pembeli</label>
                <div class="col-sm-10">
                    <input type="text" name="name_customer" class="form-control" id="name_customer">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name_customer" class="col-sm-2 col-form-label">Nama Pembeli</label>
                <div class="col-sm-10">
                    <select name="medicines[]" id="medicines" class="form-select">
                        <option selected hidden disabled>Pesanan 1</option>
                        @foreach ($medicines as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <div id="wrap-medicines"></div>
                    <br>
                    <p style="cursor : pointer" class="text-primary" id="add-select">+ Tambah Obat</p>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-lg btn-primary">Konfirmasi Pembelian</button>
        </form>
    </div>

@endsection

@push('script')

<script>
    let no = 2

    $("#add-select").on("click", function() {
        let el = `<br><select name="medicines[]" id="medicines" class="form-select">
        <option selected hidden disabled>Pesanan ${no}</option>
        @foreach ($medicines as $item)
            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
        @endforeach
    </select>`;
    //append :tambahkan element html dibagian sebelum penutup terkait (sebelum penutup tag yang idnya warp-medicines)
    $("#wrap-medicines").append(el);
    //  increments variable no agar angka yang muncul di option selalu bertambah 1 sesuai jumlah selectnya
    no++
    })
 
</script>

@endpush
