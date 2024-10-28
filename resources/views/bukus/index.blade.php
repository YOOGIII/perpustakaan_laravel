@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #abc2d6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1rem;
            font-weight: bold;
        }
        .modal-content {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="page-header text-center">
        <h1>Daftar Buku</h1>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
        @forelse ($bukus as $buku)
            <div class="col mb-4">
                <div class="card shadow">
                    <img src="{{ $buku->image }}" class="card-img-top" alt="{{ $buku->judul }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bukuModal{{ $buku->id }}">
                            Selengkapnya
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="bukuModal{{ $buku->id }}" tabindex="-1" aria-labelledby="bukuModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bukuModalLabel{{ $buku->id }}">{{ $buku->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Pengarang:</strong> {{ $buku->pengarang }}</p>
                            <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                            <p><strong>Sinopsis:</strong> {{ $buku->sinopsis }}</p>
                            <p><strong>Kategori:</strong> {{ $buku->id_kategori }}</p>
                            <p><strong>Stok:</strong> {{ $buku->stok }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Tidak ada buku ditemukan!</div>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
@endsection
