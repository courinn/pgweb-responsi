<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menambahkan data baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['Nama']);
    $nama_ortu = htmlspecialchars($_POST['Nama_Ortu']);
    $tanggal_lahir = $_POST['Tanggal_Lahir'];
    $longitude = filter_var($_POST['Longitude'], FILTER_SANITIZE_STRING);
    $latitude = filter_var($_POST['Latitude'], FILTER_SANITIZE_STRING);

    // Validasi format tanggal
    if (!DateTime::createFromFormat('Y-m-d', $tanggal_lahir)) {
        die("Format tanggal tidak valid. Harap gunakan format YYYY-MM-DD.");
    }

    // Ambil fid terakhir dari tabel dan tambahkan 1
    $result = $conn->query("SELECT MAX(fid) AS max_fid FROM stunting");
    $row = $result->fetch_assoc();
    $new_fid = $row['max_fid'] ? $row['max_fid'] + 1 : 1; // Jika tabel kosong, mulai dari 1

    // Gunakan prepared statement untuk menambahkan data
    $stmt = $conn->prepare("INSERT INTO stunting (fid, Nama, Nama_Ortu, Tanggal_Lahir, Longitude, Latitude) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $new_fid, $nama, $nama_ortu, $tanggal_lahir, $longitude, $latitude);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='coba.php';</script>";
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
    <title>Tambah Data Kasus Stunting</title>
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
                    <h2 class="text-center mb-4">Tambah Data Kasus Stunting</h2>
                    <form method="POST" action="" novalidate>
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="Nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="Nama" 
                                class="form-control" 
                                id="Nama" 
                                placeholder="Masukkan nama anak" 
                                required 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Nama anak yang akan dimasukkan ke dalam data">
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
                                required>
                            <div class="invalid-feedback">
                                Latitude wajib diisi.
                            </div>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                            <a href="coba.php" class="btn btn-secondary">Kembali</a>
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
