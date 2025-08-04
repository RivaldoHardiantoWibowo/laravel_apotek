@extends('layouts.template')

@section('content')
@if (Session::get('alreadyAccess'))
<div class="alert alert-info">{{ Session::get('alreadyAccess') }}</div>
@endif

<!-- Welcome Message -->
<div class="bg-white p-4 rounded shadow mb-4">
    <h2 class="h4 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="mb-0 text-muted">Semoga harimu menyenangkan! Berikut ringkasan operasional apotek hari ini.</p>
</div>

<!-- Statistic Cards -->
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5 class="card-title">Total Obat</h5>
                <h3>128</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title">Penjualan Hari Ini</h5>
                <h3>Rp 2.450.000</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title">Jumlah Kasir</h5>
                <h3>6</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger shadow">
            <div class="card-body">
                <h5 class="card-title">Obat Hampir Habis</h5>
                <h3>12</h3>
            </div>
        </div>
    </div>
</div>

<!-- Chart & Table Row -->
<div class="row">
    <!-- Chart Placeholder -->
    <div class="col-md-8 mb-4">
        <div class="card shadow">
            <div class="card-header bg-light">
                Grafik Penjualan 7 Hari Terakhir
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-header bg-light">
                Transaksi Terbaru
            </div>
            <div class="card-body p-2">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        #INV001 <span class="badge bg-success">Rp 150.000</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        #INV002 <span class="badge bg-success">Rp 230.000</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        #INV003 <span class="badge bg-success">Rp 420.000</span>
                    </li>
                    <li class="list-group-item text-center text-muted">
                        <small><a href="#">Lihat semua &rarr;</a></small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
