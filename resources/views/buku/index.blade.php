<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 text-secondary">Daftar Buku Perpustakaan</h3>
            <a href="/buku/create" class="btn btn-primary">+ Tambah Buku Baru</a>
        </div>

        <!-- Form Pencarian (Input Group) -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="/buku" method="GET">
                    <div class="row g-2">
                        <div class="col-md-6 col-lg-5">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control" placeholder="Cari judul atau pengarang..." value="{{ request('cari') }}">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                                @if(request('cari'))
                                    <a href="/buku" class="btn btn-outline-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Buku -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($buku as $index => $b)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $b->kode_buku }}</td>
                                    <td>{{ $b->judul }}</td>
                                    <td>{{ $b->pengarang }}</td>
                                    <td>{{ $b->penerbit }}</td>
                                    <td class="text-center">{{ $b->tahun_terbit }}</td>
                                    <td class="text-center">{{ $b->stok }}</td>
                                    <td class="text-center">
                                        <a href="/buku/{{ $b->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="/buku/{{ $b->id }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Data buku tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script Konfirmasi Hapus SweetAlert2 -->
    <script>
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data buku ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>