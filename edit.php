<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = [];
if (isset($_GET['fid'])) {
    $fid = intval($_GET['fid']); // Pastikan hanya angka yang diambil

    // Gunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM stunting WHERE fid = ?");
    $stmt->bind_param("i", $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fid = intval($_POST['fid']);
    $nama = htmlspecialchars($_POST['Nama']);
    $ortu = htmlspecialchars($_POST['Nama_Ortu']);
    $tgl = $_POST['Tanggal_Lahir'];
    $longitude = filter_var($_POST['Longitude'], FILTER_SANITIZE_STRING);
    $latitude = filter_var($_POST['Latitude'], FILTER_SANITIZE_STRING);

    // Validasi format tanggal jika diperlukan
    if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
        die("Format tanggal tidak valid. Harap gunakan format YYYY-MM-DD.");
    }

    // Gunakan prepared statement untuk update
    $stmt = $conn->prepare("UPDATE stunting SET Nama = ?, Nama_Ortu = ?, Tanggal_Lahir = ?, Longitude = ?, Latitude = ? WHERE fid = ?");
    $stmt->bind_param("sssssi", $nama, $ortu, $tgl, $longitude, $latitude, $fid);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='coba.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Kasus Stunting</title>
    <!-- Bootstrap CSS -->
    <link 
        rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .tooltip-custom {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="form-container">
                    <h2 class="text-center mb-4">Edit Data Kasus Stunting</h2>
                    <form method="POST" action="" novalidate>
                        <!-- Hidden Field -->
                        <input 
                            type="hidden" 
                            name="fid" 
                            value="<?php echo isset($data['fid']) ? htmlspecialchars($data['fid']) : ''; ?>">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="Nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="Nama" 
                                class="form-control" 
                                id="Nama" 
                                placeholder="Masukkan nama anak" 
                                value="<?php echo isset($data['Nama']) ? htmlspecialchars($data['Nama']) : ''; ?>" 
                                required 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Nama anak yang akan diubah">
                            <div class="invalid-feedback">
                                Nama wajib diisi.
                            </div>
                        </div>

                        <!-- Nama Orang Tua -->
                        <div class="mb-3">
                            <label for="Nama_Ortu" class="form-label">Nama Orang Tua <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="Nama_Ortu" 
                                class="form-control" 
                                id="Nama_Ortu" 
                                placeholder="Masukkan nama orang tua" 
                                value="<?php echo isset($data['Nama_Ortu']) ? htmlspecialchars($data['Nama_Ortu']) : ''; ?>" 
                                required>
                            <div class="invalid-feedback">
                                Nama orang tua wajib diisi.
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir (YYYY-MM-DD) <span class="text-danger">*</span></label>
                            <input 
                                type="date" 
                                name="Tanggal_Lahir" 
                                class="form-control" 
                                id="Tanggal_Lahir" 
                                value="<?php echo isset($data['Tanggal_Lahir']) ? htmlspecialchars($data['Tanggal_Lahir']) : ''; ?>" 
                                required>
                            <div class="invalid-feedback">
                                Tanggal lahir wajib diisi.
                            </div>
                        </div>

                        <!-- Longitude -->
                        <div class="mb-3">
                            <label for="Longitude" class="form-label">Longitude <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="Longitude" 
                                class="form-control" 
                                id="Longitude" 
                                placeholder="Masukkan koordinat longitude" 
                                value="<?php echo isset($data['Longitude']) ? htmlspecialchars($data['Longitude']) : ''; ?>" 
                                required>
                            <div class="invalid-feedback">
                                Longitude wajib diisi.
                            </div>
                        </div>

                        <!-- Latitude -->
                        <div class="mb-3">
                            <label for="Latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="Latitude" 
                                class="form-control" 
                                id="Latitude" 
                                placeholder="Masukkan koordinat latitude" 
                                value="<?php echo isset($data['Latitude']) ? htmlspecialchars($data['Latitude']) : ''; ?>" 
                                required>
                            <div class="invalid-feedback">
                                Latitude wajib diisi.
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-kBfiyNFfH1l+QfT5aKZhM5Cl+hqw+4aJb7ucwFyG30cqTxgM8JELBq4tu8bxjv1z" 
        crossorigin="anonymous"></script>
    <script>
        // Tooltip Initialization
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl, { customClass: 'tooltip-custom' });
            });
        });

        // Form Validation
        (() => {
            'use strict';
            const forms = document.querySelectorAll('form');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>

