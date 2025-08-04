@extends('layouts.template')

@section('content')
    <div class="d-flex justify-content-between align-items-center my-4">
        <h4 class="mb-0">Data Pembelian</h4>
        <a href="{{ route('order.export-excel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Pembeli</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Kasir</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="text-center">{{ ($orders->currentpage()-1) * $orders->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $order->name_customer }}</td>
                        <td>
                            <ol class="mb-0 ps-3">
                                @foreach ($order['medicines'] as $medicine)
                                    <li class="mb-1">
                                        <strong>{{ $medicine['name_medicine'] }}</strong><br>
                                        <span class="text-muted small">
                                            Harga: Rp{{ number_format($medicine['price'], 0, ',', '.') }}<br>
                                            Subtotal: <span class="badge bg-warning text-dark">Rp{{ number_format($medicine['sub_price'], 0, ',', '.') }}</span><br>
                                            Qty: <span class="badge bg-secondary">{{ $medicine['qyt'] }}</span>
                                        </span>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{{ $order['user']['name'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}</td>
                        <td>
                            <strong>
                                Rp{{ number_format(collect($order['medicines'])->sum('sub_price'), 0, ',', '.') }}
                            </strong>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kasir.order.download', $order['id']) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-download me-1"></i> Unduh PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-4">
        {{ $orders->links() }}
    </div>
@endsection
