@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-2 text-center">List Peminjaman</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>

    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered table-sm">
            <thead class="text-center">
                <tr>
                    <th class="align-middle" style="width: 5%;">ID</th>
                    <th class="align-middle" style="width: 15%;">Buku</th>
                    <th class="align-middle" style="width: 30%;">Nama Peminjam</th>
                    <th class="align-middle" style="width: 10%;">Tanggal Peminjaman</th>
                    <th class="align-middle" style="width: 10%;">Tanggal Pengembalian</th>
                    <th class="align-middle" style="width: 10%;">Status</th>
                    <th class="align-middle" style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($transaksi as $transaksis)
                <tr id="transaksi-row-{{ $transaksis->id }}">
                    <td class="align-middle">{{ $transaksis->id }}</td>
                    <td class="align-middle">{{ $transaksis->buku->judul }}</td>
                    <td class="align-middle">{{ $transaksis->member->username }}</td>
                    <td class="align-middle">{{ $transaksis->tanggal_pinjam }}</td>
                    <td class="align-middle">{{ $transaksis->tanggal_kembali }}</td>
                    <td class="align-middle">
                        <i id="status-icon-{{ $transaksis->id }}" class="fas {{ getStatusIcon($transaksis->status) }}" onclick="updateStatus({{ $transaksis->id }})"></i>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-sm btn-info mx-1">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('transaksi.edit', ['id' => $transaksis->id]) }}" class="btn btn-sm btn-warning mx-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mx-1" onclick="
                                event.preventDefault();
                                if (confirm('Do you want to remove this?')) {
                                    document.getElementById('delete-row-{{ $transaksis->id }}').submit();
                            }">
                            <i class="fas fa-trash"></i> Delete
                            </a>
                            <form id="delete-row-{{ $transaksis->id }}" action="{{ route('transaksi.destroy', ['id' => $transaksis->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No transaksi found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- CSS and JS Libraries -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    #dataTable tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 12px;
    }

    #dataTable td:last-child {
        text-align: center;
    }

    #dataTable {
        border: 1px solid #000;
    }

    .table-sm td, .table-sm th {
        padding: 0.3rem;
    }

    .table-sm {
        font-size: 0.875rem;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "pageLength": 5, 
            "lengthMenu": [5, 10, 15, 20], 
            "pagingType": "simple_numbers", 
            "info": false, 
            "language": {
                "paginate": {
                    "previous": "&laquo;",
                    "next": "&raquo;"
                }
            }
        });
    });
</script>
<script>
    function updateStatus(id) {
        $.ajax({
            url: '/transaksi/update-status/' + id,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.deleted) {
                    $('#transaksi-row-' + id).remove(); // Hapus baris transaksi jika dihapus
                } else {
                    // Update the status icon dynamically
                    var iconClass = '';
                    switch(response.status) {
                        case 'proses':
                            iconClass = 'fa-spinner fa-spin';
                            break;
                        case 'acc':
                            iconClass = 'fa-check';
                            break;
                        case 'late':
                            iconClass = 'fa-exclamation';
                            break;
                        default:
                            iconClass = 'fa-question';
                            break;
                    }
                    $('#status-icon-' + id).attr('class', 'fas ' + iconClass);
                }
            },
            error: function(xhr) {
                // Tampilkan pesan error jika ada masalah
                alert('Error: ' + xhr.responseText);
            }
        });
    }
</script>
@endsection
