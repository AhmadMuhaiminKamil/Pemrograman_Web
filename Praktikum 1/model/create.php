<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP - Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function validateForm() {
            let isValid = true;

            // Hapus pesan error sebelumnya
            let errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(function (element) {
                element.remove();
            });

            let nim = document.forms["createForm"]["nim"].value;
            let nama = document.forms["createForm"]["nama"].value;
            let jurusan = document.forms["createForm"]["jurusan"].value;

            // Validasi NIM (hanya angka)
            if (!/^\d+$/.test(nim)) {
                let errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger', 'error-message');
                errorMessage.innerText = "NIM harus berupa angka";
                document.getElementById('nimError').appendChild(errorMessage);
                isValid = false;
            }

            // Validasi Nama (hanya huruf dan minimal 3 karakter)
            if (!/^[A-Za-z\s]{3,}$/.test(nama)) {
                let errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger', 'error-message');
                errorMessage.innerText = "Nama harus berupa huruf minimal 3 karakter";
                document.getElementById('namaError').appendChild(errorMessage);
                isValid = false;
            }

            // Validasi Jurusan (hanya huruf)
            if (!/^[A-Za-z\s]+$/.test(jurusan)) {
                let errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger', 'error-message');
                errorMessage.innerText = "Jurusan hanya boleh menggunakan huruf";
                document.getElementById('jurusanError').appendChild(errorMessage);
                isValid = false;
            }

            return isValid;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Create Mahasiswa</h1>

            <!-- Menampilkan pesan error jika ada di query string -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form name="createForm" action="../function/Mahasiswa.php?action=create" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim" required>
                    <div id="nimError"></div> <!-- Tempat untuk pesan error NIM -->
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                    <div id="namaError"></div> <!-- Tempat untuk pesan error Nama -->
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" required>
                    <div id="jurusanError"></div> <!-- Tempat untuk pesan error Jurusan -->
                </div>
                <button type="submit" class="btn btn-primary mt-2">Create</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
