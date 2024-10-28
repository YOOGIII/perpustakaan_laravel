<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library - Edit Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <style>
    body {
      background: #f5f6fa;
      font-family: 'Arial', sans-serif;
    }
    .container {
      max-width: 500px;
      margin-top: 50px;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #6c757d;
      color: #fff;
      text-align: center;
      border-radius: 10px 10px 0 0;
      padding: 1rem;
    }
    .form-control {
      border: 1px solid #ced4da;
      border-radius: 8px;
      padding: 0.5rem 1rem;
    }
    .form-control:focus {
      border-color: #6c757d;
      box-shadow: none;
    }
    .btn-primary, .btn-secondary {
      border-radius: 8px;
      width: 48%;
      padding: 0.5rem;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #5a6268;
      border-color: #5a6268;
    }
    .card-footer {
      background-color: #e9ecef;
      border-top: none;
      text-align: center;
      padding: 0.5rem 1rem;
      border-radius: 0 0 10px 10px;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="container">
      <form method="post" action="{{ route('transaksi.update', ['id' => $transaksi->id]) }}">
        @method('PUT')
        @csrf
        <div class="card mt-5">
          <div class="card-header">
            <h3>Edit Transaksi</h3>
          </div>
          <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
              <div class="alert-title">
                <h4>Whoops!</h4>
              </div>
              There are some problems with your input.
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
              <label class="form-label">Buku</label>
              <input id="id_buku" type="text" class="form-control" name="id_buku" value="{{ $transaksi->id_buku }}" placeholder="Buku" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Peminjam</label>
              <input type="text" class="form-control" name="id_member" value="{{ $transaksi->id_member }}" placeholder="Peminjam" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Peminjaman</label>
              <input type="date" class="form-control" name="tanggal_pinjam" value="{{ $transaksi->tanggal_pinjam }}" placeholder="Tanggal Peminjaman" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Pengembalian</label>
              <input type="date" class="form-control" name="tanggal_kembali" value="{{ $transaksi->tanggal_kembali }}" placeholder="Tanggal Pengembalian" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <input type="text" class="form-control" name="status" value="{{ $transaksi->status }}" placeholder="Status" required>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
