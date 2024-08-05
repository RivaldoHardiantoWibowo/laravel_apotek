 @extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <a class="btn btn-primary" href="{{ route('account.create') }}">Buat Akun</a>
    <br><br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($account as $list)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $list['name'] }}</td>
                    <td>{{ $list['email'] }}</td>
                    <td>{{ $list['role'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('account.edit', $list['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="{{ route('account.delete', $list['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
