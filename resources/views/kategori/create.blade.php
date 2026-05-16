<!DOCTYPE html>
<html>
<head>

    <title>Tambah Kategori</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            Tambah Kategori
        </div>

        <div class="card-body">

            <form action="/kategori" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Nama Kategori</label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control">

                </div>

                <button class="btn btn-success">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>