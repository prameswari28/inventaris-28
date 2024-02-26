<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Peminjaman - SantriKoding.com</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('siswa.index') }}">SISWA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('barang.index') }}">BARANG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('peminjaman.index') }}">PEMINJAMAN</a>
              </li>
          </div>
        </div>
      </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-md btn-success mb-3">DATA PINJAM</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                              <th scope="col">GAMBAR</th>
                                <th scope="col">BARANG</th>
                                <th scope="col">SISWA</th>
                                <th scope="col">TANGGAL PINJAM</th>
                                <th scope="col">TANGGAL KEMBALI</th>
                                <th scope="col">KONDISI</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($peminjaman as $peminjamans)
                                <tr>

                                  <td class="text-center">
                                    <img src="{{ Storage::url('public/barang/').$peminjamans->gambar }}" class="rounded" style="width: 150px">
                                </td>
                                <td>{{ $peminjamans->barang->nama_barang }}</td>
                                <td>{{ $peminjamans->siswa->nama }}</td>
                                    <td>{{ $peminjamans->tanggal_pinjam }}</td>
                                    <td>{{ $peminjamans->tanggal_kembali }}</td>
                                    <td>{{ $peminjamans->kondisi }}</td>


                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peminjaman.destroy', $peminjamans->id) }}" method="POST">
                                            <a href="{{ route('peminjaman.edit', $peminjamans->id) }}" class="btn btn-sm btn-primary"> <i data-feather="edit-3"></i></a>
                                            @csrf
                                            @method('DELETE')
                                              <button type="submit" class="btn btn-sm btn-danger"><i data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                            {{ $peminjaman->links() }}
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
<script>
    feather.replace();
  </script>
</body>
</html>
