<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage - Responsi PGWEB</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous" />

    <!-- Custom Styles -->
    <style>
        body {
            background-color:rgb(255, 255, 255);
        }
        .hero-section {
            background: linear-gradient(rgba(1, 7, 22, 0.5), rgba(2, 6, 68, 0.5)), 
                url('https://watermark.lovepik.com/photo/50162/4895_lovepik-cityscape-of-manado-photo-image_wh1200.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-top: 15px;
        }
        .navbar .btn {
            margin-left: 10px;
        }
        .navbar-brand span {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow text-white">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-map-location-dot me-2"></i>
            <span class="navbar-brand" style="font-weight: bold;">Siaga Stunting Kota Manado</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"></ul>
            <div>
                <a href="coba.php" class="btn btn-outline-light">Map</a>
                <a href="profile.php" class="btn btn-outline-light">Profile</a>
            </div>
        </div>
    </div>
</nav>


<!-- Hero Section -->
<div class="hero-section">
    <h1>SITIMAN-Siaga Stunting Kota Manado</h1>
    <p>Layanan Informasi Interaktif dalam Monitor Kasus Stunting di Kota Manado, Sulawesi Utara</p>
    <a href="coba.php" class="btn btn-outline-light btn-lg mt-4">Lihat Peta</a>
    <a href="profile.php" class="btn btn-outline-light btn-lg mt-4">Profil</a>
</div>
<!-- Main Content -->
<div class="container my-5">
    <div class="row text-center">
        <!-- Pengertian Stunting -->
        <div class="col-md-4">
            <img src="icon/family.png" alt="Pengertian Stunting" class="mb-3 interactive-image" onclick="toggleDescription('geografis')">
            <h3 class="fw-bold">Pengertian Stunting</h3>
            <div id="desc-geografis" class="description-box"></div>
        </div>

        <!-- Gejala Stunting -->
        <div class="col-md-4">
            <img src="icon/stunting4.png" alt="Gejala Stunting" class="mb-3 interactive-image" onclick="toggleDescription('pengguna')">
            <h3 class="fw-bold">Gejala Stunting</h3>
            <div id="desc-pengguna" class="description-box"></div>
        </div>

        <!-- Data Stunting -->
        <div class="col-md-4">
            <img src="icon/data.png" alt="Data Stunting" class="mb-3 interactive-image" onclick="toggleDescription('analisis')">
            <h3 class="fw-bold">Data Stunting</h3>
            <div id="desc-analisis" class="description-box"></div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    /* Gaya Deskripsi */
    .description-box {
        display: none;
        margin-top: 20px;
        padding: 20px;
        background: linear-gradient(135deg,rgb(218, 236, 249),rgb(181, 199, 250));
        border: 1px solid #d1e7fd;
        border-radius: 10px;
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        text-align: justify;
        position: relative;
    }

    /* Animasi untuk deskripsi */
    .description-box::before {
        content: "";
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg,rgb(137, 189, 226), #ffffff);
        border-top: 1px solid #d1e7fd;
        border-left: 1px solid #d1e7fd;
        transform: rotate(45deg);
        z-index: -1;
    }

    /* Gaya Gambar */
    .interactive-image {
        width: 150px;
        height: auto;
        border-radius: 10%;
        border: 2px solid #0d6efd;
        padding: 5px;
        transition: all 0.3s ease;
    }

    .interactive-image:hover {
        cursor: pointer;
        transform: scale(1.2);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Gaya Judul */
    .fw-bold {
        font-weight: bold;
        color: #0d6efd;
        margin-top: 15px;
        font-size: 1.8rem;
    }
</style>

<!-- JavaScript -->
<script>
    function toggleDescription(type) {
        const descBox = document.getElementById(`desc-${type}`);

        // Jika deskripsi sudah terlihat, sembunyikan
        if (descBox.style.display === 'block') {
            descBox.style.display = 'none';
        } else {
            // Sembunyikan semua deskripsi lain
            document.querySelectorAll('.description-box').forEach(box => box.style.display = 'none');

            // Tentukan isi deskripsi
            let description = '';
            if (type === 'geografis') {
                description = `
                    <strong>Apa itu Stunting?</strong><br>
                    Stunting adalah kondisi gagal tumbuh pada anak diakibatkan oleh kekurangan nutrisi kronis. 
                    Stunting dapat memengaruhi perkembangan fisik dan mental, sehingga penting untuk memahami 
                    faktor penyebabnya dan mencegahnya sejak dini.
                `;
            } else if (type === 'pengguna') {
                description = `
                    <strong>Gejala Stunting</strong><br>
                    Gejala stunting meliputi berat badan yang stagnan, tinggi badan lebih pendek dibanding anak seusianya, 
                    serta penurunan aktivitas fisik. Pencegahan melibatkan nutrisi yang cukup dan lingkungan yang sehat.
                `;
            } else if (type === 'analisis') {
                description = `
                    <strong>Data Stunting Kota Manado</strong><br>
                    Tren stunting di Kota Manado menunjukkan penurunan yang signifikan, dari 1,54% pada 2021 
                    menjadi hanya 0,42% pada 2024. Upaya intervensi pemerintah berperan besar dalam pencapaian ini.
                `;
            }

            // Tampilkan deskripsi
            descBox.innerHTML = description;
            descBox.style.display = 'block';
        }
    }
</script>

    <!-- Footer -->
    <footer class="bg-primary shadow text-white text-center py-3">
        <p>&copy; 2024 Responsi PGWEB_Garini Ulima Laksmihita. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-kBfiyNFfH1l+QfT5aKZhM5Cl+hqw+4aJb7ucwFyG30cqTxgM8JELBq4tu8bxjv1z" 
        crossorigin="anonymous"></script>

        
</body>

</html>
