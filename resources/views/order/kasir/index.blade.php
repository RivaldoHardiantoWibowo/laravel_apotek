@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-ed">
            <div class="row w-100 ml-2" >
                <form action="{{ route('kasir.order.search') }}" method="get">
                    <div class="col-6 ml-3 ">
                        <input type="date" name="filter" id="filter" class="form-control ml-5">
                    </div>
                    <div class="col-4 d-inline">
                        <button class="btn btn-info" id="cari-data">Cari Data</button>
                        <button class="btn btn-secondary" id="clear-data">Clear</button>
                    </div>
                </form>
            </div>
            <a href="{{ route('kasir.order.create') }}  " class="btn btn-primary" style="height: 70px">Pembelian Baru</a>
        </div>

    <table class="table table-striped table-borderad table-hover">
    <thead>
        <tr>
            <th class="text-center">No.</th>
            <th>Pembeli</th>
            <th>Obat</th>
            <th>Total Bayar</th>
            <th>Kasir</th>
            <th>Tanggal Beli</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name_customer}}</td>
            <td>
                @foreach($item->medicines as $medicine)
                <ol>
                    <li>{{$medicine['name_medicine']}} ({{ number_format($medicine['price'],0,',','.') }}) :
                        Rp. {{ number_format($medicine['sub_price'],0,',','.') }} <small>qyt {{ $medicine['qyt'] }} </small>

                    </li>
                </ol>
            </td>
            <td>{{number_format($item->total_price,0,',','.')}}</td>
            <td>
                {{ $item->user->name }}
            </td>
            <td>
                {{-- @php --}}
                    {{-- \Carbon\Carbon::setlocale('id_ID') --}}
                {{-- @endphp --}}
                {{-- {{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d F Y') }} --}}
                {{-- <br> --}}
                {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
                <br>
                {{ \Carbon\Carbon::parse($item['created_at'])->locale('id_ID')->translatedFormat('d F Y') }}

            </td>
            @endforeach
            <td>
                <a href="{{ route('kasir.order.download', $item['id']) }}" class="btn btn-secondary">Download Struk</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <div class="dflex justify-content-end">
        @if($orders->count() && !Request::is('kasir/order/search'))
        {{ $orders->links() }}
        @endif
    </div>
</div>
@endsection
