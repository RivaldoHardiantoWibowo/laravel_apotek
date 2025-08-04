@extends('layouts.template')

@section('content')
<div class="container py-4">
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <h2 class="fw-semibold text-primary mb-3">📋 Kelola Akun Pengguna</h2>

        @if (Session::get('success'))
        <div class="alert alert-success rounded-3">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('deleted'))
        <div class="alert alert-warning rounded-3">{{ Session::get('deleted') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-success px-4 py-2 rounded-3 shadow-sm" href="{{ route('account.create') }}">
                + Buat Akun
            </a>
        </div>

        <div class="table-responsive rounded-4 overflow-hidden">
            <table class="table table-hover align-middle mb-0 bg-light border rounded-3">
                <thead class="table-light text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($account as $list)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $list['name'] }}</td>
                        <td>{{ $list['email'] }}</td>
                        <td>
                            <span
                                class="badge d-flex align-items-center bg-{{ $list['role'] === 'admin' ? 'primary' : 'success' }}">
                                <i class="bi bi-person-badge"></i> {{ ucfirst($list['role']) }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('account.edit', $list['id']) }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    Edit
                                </a>
                                <form action="{{ route('account.delete', $list['id']) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada akun yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
