<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Responsi PGWEB</title>

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

    <style>
        body {
            background-color: #f9f9f9;
        }
        .hero-section {
            background: linear-gradient(rgba(1, 7, 22, 0.7), rgba(2, 6, 68, 0.7)), 
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

        /* Profile Card */
        .profile-card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .profile-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-card h5 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .profile-card p {
            color: #555;
            font-size: 1rem;
            text-align: justify;
        }

        .social-icons a {
            margin: 0 10px;
            color: #555;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: #007bff;
        }
        .navbar-brand span {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .profile-card {
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 20px;
}
.profile-card img {
    border-radius: 10px;
}
.social-icons a {
    margin: 0 10px;
    color: #555;
    font-size: 1.5rem;
    transition: color 0.3s;
}
.social-icons a:hover {
    color: #007bff;
}

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-map-location-dot me-2"></i>
                <span>Siaga Stunting Kota Manado</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto"></ul>
                <div>
                    <a href="coba.php" class="btn btn-outline-light">Map</a>
                    <a href="index.php" class="btn btn-outline-light">Home</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>About the Creator</h1>
        <p>Learn more about the individual behind this interactive and professional platform</p>
    </div>

<!-- Profile Card -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card d-flex align-items-center">
                <img src="https://i.pinimg.com/originals/92/f4/30/92f43094408fac9b070e8ab77a1948ee.jpg" 
                alt="Creator" class="me-3 rounded" style="width: 150px; height: auto;">
                <div>
                    <h5>Garini Ulima Laksmihita</h5>
                    <p>Garini is a passionate web developer and data analyst with a keen interest in creating innovative solutions to tackle social issues like stunting. This platform, *Siaga Stunting Kota Manado*, is one of her initiatives to empower communities with information and tools for better decision-making.</p>
                    <div class="social-icons">
                        <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="http://github.com/courinn" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="mailto:garini@example.com"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
