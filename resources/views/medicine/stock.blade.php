@extends('layouts.template')

@section('content')
    <div id="msg-success" class="my-3"></div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Daftar Stok Obat</h5>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($medicines as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                @if ($item['stock'] <= 3)
                                    <span class="badge bg-danger">
                                        {{ $item['stock'] }} (Kritis)
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        {{ $item['stock'] }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button onclick="edit({{ $item['id'] }})"
                                    class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 mx-auto"
                                    style="min-width: 120px">
                                    <i class="bi bi-plus-circle"></i> Tambah Stok
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="edit-stock" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="form-stock">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Stok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="msg"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Obat :</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Baru :</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                        <div class="text-center" id="loading" style="display: none;">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function edit(id) {
            const url = "{{ route('medicine.stock.edit', ':id') }}".replace(':id', id);
            $.get(url, function(res) {
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#stock').val(res.stock);
                $('#edit-stock').modal('show');
            });
        }

        $('#form-stock').submit(function(e) {
            e.preventDefault();
            $('#loading').show();

            const id = $('#id').val();
            const url = "{{ route('medicine.stock.update', ':id') }}".replace(':id', id);
            const data = { stock: $('#stock').val() };

            $.ajax({
                type: 'PATCH',
                url: url,
                data: data,
                cache: false,
                success: function() {
                    $('#loading').hide();
                    $('#edit-stock').modal('hide');
                    sessionStorage.setItem('stockUpdated', true);
                    window.location.reload();
                },
                error: function(data) {
                    $('#loading').hide();
                    $('#msg').attr("class", "alert alert-danger");
                    $('#msg').text(data.responseJSON.message);
                }
            });
        });

        $(function() {
            if (sessionStorage.getItem('stockUpdated')) {
                $('#msg-success').addClass("alert alert-success");
                $('#msg-success').text("Berhasil menambahkan data stok!");
                sessionStorage.removeItem('stockUpdated');
            }
        });
    </script>
@endpush
