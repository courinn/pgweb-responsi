<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESPONSI PGWEB</title>

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

    <!-- Leaflet CSS -->
    <link rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
        crossorigin="anonymous" />

    <!-- Leaflet Plugins -->
    <link rel="stylesheet" 
        href="plugin/leaflet-search-master/leaflet-search-master/dist/leaflet-search.min.css" />
    <link rel="stylesheet" 
        href="plugin/Leaflet.defaultextent-master/Leaflet.defaultextent-master/dist/leaflet.defaultextent.css" />

    <!-- Custom Styles -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        #container {
            flex: 1;
            display: flex;
            height: 100%;
        }

        #map {
    flex: 1;
    transition: flex 0.3s ease;
}

#table-container {
    display: none;
    flex: 0 0 40%;
    background: #ffffff;
    overflow-y: auto;
    border-left: 2px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: flex 0.3s ease, display 0.3s ease;
    border-radius: 8px;
    padding: 20px;
}

table {
    width: 100%;
    margin: auto;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    text-align: left;
    vertical-align: middle;
}

th {
    background:rgb(249, 172, 209);
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

td {
    background: #f9f9f9;
    transition: background 0.3s ease;
}

tr:hover td {
    background:rgb(203, 225, 253); /* Warna saat hover */
}

.table-striped tbody tr:nth-of-type(odd) {
    background: #f4f4f4;
}

.table-hover tbody tr:hover {
    background: #d4edda;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6;
}

h5 {
    font-weight: bold;
    color: #333;
}

        .navbar {
            z-index: 1000;
        }

        .navbar-brand span {
    font-weight: bold;
    font-size: 1.5rem;
}

.nav-link:hover {
    color:rgb(250, 169, 181) !important; /* Warna hover */
    text-decoration: underline;
}

.dropdown-menu {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

    </style>

</head>


<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-map-location-dot me-2"></i>
            <span>Siaga Stunting Kota Manado</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Sumber Data -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="https://geoportal.manadokota.go.id/" target="_blank">
                        <i class="fa-solid fa-layer-group me-1"></i> Sumber Data
                    </a>
                </li>
                <!-- Info -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal">
                        <i class="fa-solid fa-circle-info me-1"></i> Info
                    </a>
                </li>
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars me-1"></i> Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php"><i class="fa-solid fa-house me-2"></i> Home</a></li>
                        <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user me-2"></i> Profile</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Buttons -->
            <div class="d-flex">
                <!-- Tambah Data Button -->
                <a href="tambah.php" class="btn btn-outline-light me-2">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Data
                </a>
                <!-- Tabel Button -->
                <button class="btn btn-outline-light" onclick="toggleTable()">
                    <i class="fa-solid fa-table me-1"></i> Tabel
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Modal Info -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel"><i class="fa-solid fa-circle-info me-2"></i> Informasi Stunting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Stunting adalah kondisi gagal tumbuh akibat kekurangan gizi dalam waktu yang lama. Kota Manado telah melakukan berbagai upaya untuk menurunkan angka stunting secara signifikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function toggleTable() {
        // Tambahkan fungsi untuk menampilkan/menyembunyikan tabel data
        alert("Fungsi tabel akan ditambahkan di masa depan!");
    }
</script>



    <div id="container">
        <div id="map"></div>
        <div id="table-container" class="table-responsive p-3">
            <!-- Konten tabel akan dimuat melalui PHP -->
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

    // Handle delete request
    if (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']); // Sanitasi input
        $stmt = $conn->prepare("DELETE FROM stunting WHERE fid = ?");
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Error deleting record: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    // Query data untuk peta dan tabel
    $sql = "SELECT * FROM stunting";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menambahkan marker ke peta
        while ($row = $result->fetch_assoc()) {
            $long = htmlspecialchars($row["Longitude"]);
            $lat = htmlspecialchars($row["Latitude"]);
            $nama = htmlspecialchars($row["Nama"]);
            echo "<script>
                L.marker([$lat, $long]).addTo(map).bindPopup('$nama');
            </script>";
        }

        // Reset pointer hasil query
        $result->data_seek(0);

        // Membuat tabel
        echo "<table border='1' style='width:100%; text-align:left; border-collapse:collapse;'>
        <tr>
            <th>fid</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Nama Ortu</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Aksi</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            $fid = htmlspecialchars($row["fid"]);
            $nama = htmlspecialchars($row["Nama"]);
            $tgl = htmlspecialchars(string: $row["Tanggal_Lahir"]);
            $ortu = htmlspecialchars($row["Nama_Ortu"]);
            $long = htmlspecialchars($row["Longitude"]);
            $lat = htmlspecialchars($row["Latitude"]);

            echo "<tr>
                <td>$fid</td>
                <td>$nama</td>
                <td>$tgl</td>
                <td>$ortu</td>
                <td>$long</td>
                <td>$lat</td>   
                <td>
                    <a href='edit.php?fid=$fid' class='btn btn-warning'>Edit</a>
                    <form method='POST' action='' style='display:inline;'>
                    <button type='submit' name='delete_id' value='$fid' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</button>
                    </form>
                </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data</p>";
    }
    

    $conn->close();
    ?>
        </div>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel"><i class="fa-solid fa-circle-info me-2"></i>Informasi Pembuat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <table class="table table-striped">

                        <tr>
                            <th>Nama</th>
                            <td>Garini Ulima Laksmihita</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>23/517429/SV/22772</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>A</td>
                        </tr>
                        <tr>
                            <th>Github</th>
                            <td><a href="http://github.com/courinn" target="_blank"
                                    rel="noopener noreferrer">http://github.com/courinn</a></td>
                        </tr>

                    </table>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

    <!-- Feature Modal -->
    <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="featureModalTitle">Info Pembuat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="featureModalBody">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="plugin/leaflet-search-master/leaflet-search-master/dist/leaflet-search.min.js"></script>

    <script
        src="plugin/Leaflet.defaultextent-master/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>

    <script>
        // Inisialisasi peta
        var map = L.map("map");

        // Tile Layer OSM
        var basemap = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        // Tile Layer Esri WorldImagery
        var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });
        // Tile Layer RBI
        var rupabumiindonesia = L.tileLayer('https://geoservices.big.go.id/rbi/rest/services/BASEMAP/Rupabumi_Indonesia/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Badan Informasi Geospasial'
        });

        // Tile Layer Base Map Topographic (Esri)
        var topoBaseMap = L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}", {
            attribution: '&copy; <a href="https://www.esri.com/">Esri</a> &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012',
        });

        // Menambahkan basemap ke dalam peta
        basemap.addTo(map);
        Esri_WorldImagery.addTo(map);
        rupabumiindonesia.addTo(map);
        topoBaseMap.addTo(map);

        function toggleTable() {
    const tableContainer = document.getElementById('table-container');
    const mapDiv = document.getElementById('map');

    if (tableContainer.style.display === 'block') {
        tableContainer.style.display = 'none';
        mapDiv.style.flex = '1';
    } else {
        tableContainer.style.display = 'block';
        mapDiv.style.flex = '0 0 60%';
    }
}


        // Koordinat bounding box untuk Kota Manado (barat daya dan timur laut)
        var manadoBounds = [
            [1.392320, 124.724920], // Barat Daya
            [1.652450, 124.987680]  // Timur Laut
        ];

        // Set peta agar mencakup seluruh wilayah Kota Manado
        map.fitBounds(manadoBounds);




        // GeoJSON Point Kasus Stunting
        var kasus_stunting = L.geoJSON(null, {
            // Style

            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, {
                    icon: L.icon({
                        iconUrl: "icon/stunting2.png", // icon marker
                        iconSize: [20, 20], // ukuran icon
                        iconAnchor: [24, 48], // posisi icon terhadap titik (point)
                        popupAnchor: [0, -48], // posisi popup terhadap icon
                        tooltipAnchor: [-16, -30], // posisi tooltip terhadap icon
                    }),
                });
            },

            // onEachFeature

            onEachFeature: function (feature, layer) {
                // variable popup content
                var popup_content = "Nama: " + feature.properties.Nama + "<br>" +
                    "Tanggal Lahir: " + feature.properties.tgl_lahir + "<br>" +
                    "Nama Orang Tua: " + feature.properties.nama_ortu;

                layer.on({
                    click: function (e) {
                        // kasus_stunting.bindPopup(popup_content);

                        // Menampilkan feature modal
                        $("#featureModalTitle").html("Kasus Stunting");
                        $("#featureModalBody").html(popup_content);
                        $("#featureModal").modal("show");
                    },

                    mouseover: function (e) {
                        kasus_stunting.bindTooltip(feature.properties.Nama, {
                            direction: "top",
                            sticky: true,
                        });
                    },

                });
            },

        });

        $.getJSON("data/kasus_stunting.geojson", function (data) {
            kasus_stunting.addData(data); // Menambahkan data ke dalam GeoJSON Point Kasus Stunting
            map.addLayer(kasus_stunting); // Menambahkan GeoJSON Point Kasus Stunting ke dalam peta
            map.fitBounds(kasus_stunting.getBouds());
        });




        // GeoJSON Point Puskesmas
        var puskesmas = L.geoJSON(null, {
            // Style

            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, {
                    icon: L.icon({
                        iconUrl: "icon/puskesmas3.png", // icon marker
                        iconSize: [30, 30], // ukuran icon
                        iconAnchor: [24, 48], // posisi icon terhadap titik (point)
                        popupAnchor: [0, -48], // posisi popup terhadap icon
                        tooltipAnchor: [-16, -30], // posisi tooltip terhadap icon
                    }),
                });
            },

            // onEachFeature

            onEachFeature: function (feature, layer) {
                // variable popup content
                var popup_content = "Nama: " + feature.properties.nama + "<br>" +
                    "Alamat: " + feature.properties.alamat + "<br>";

                layer.on({
                    click: function (e) {
                        // puskesmas.bindPopup(popup_content);

                        // Menampilkan feature modal
                        $("#featureModalTitle").html("Puskesmas");
                        $("#featureModalBody").html(popup_content);
                        $("#featureModal").modal("show");
                    },

                    mouseover: function (e) {
                        puskesmas.bindTooltip(feature.properties.nama, {
                            direction: "top",
                            sticky: true,
                        });
                    },

                });
            },

        });

        $.getJSON("data/puskesmas.geojson", function (data) {
            puskesmas.addData(data); // Menambahkan data ke dalam GeoJSON Point Puskesmas
            map.addLayer(puskesmas); // Menambahkan GeoJSON Point Puskesmas ke dalam peta
            map.fitBounds(puskesmas.getBouds());
        });





        // GeoJSON Polyline Jalan Manado
        map.createPane('paneJalanManado');
        map.getPane("paneJalanManado").style.zIndex = 401;

        var jalan_manado = L.geoJSON(null, {
            pane: 'paneJalanManado',

            // Style

            style: function (feature) {
                return {
                    color: "#6666ff",
                    opacity: 1,
                    weight: 1,
                };
            },

            // onEachFeature

            onEachFeature: function (feature, layer) {
                // variable popup content
                var popup_content = feature.properties.AUTRJL + "<br>" +
                    "Fungsi: " + feature.properties.FGSRJL + "<br>" +
                    "Nama: " + feature.properties.NAMOBJ;

                layer.on({
                    click: function (e) {
                        // jalan.bindPopup(popup_content);

                        // Menampilkan feature modal
                        $("#featureModalTitle").html("Jalan");
                        $("#featureModalBody").html(popup_content);
                        $("#featureModal").modal("show");
                    },

                    mouseover: function (e) {
                        jalan_manado.bindTooltip(feature.properties.NAMOBJ, {
                            direction: "auto",
                            sticky: true,
                        });
                    },

                });
            },

        });


        $.getJSON("data/jalan_manado.geojson", function (data) {
            jalan_manado.addData(data); // Menambahkan data ke dalam GeoJSON Polyline Jalan
            map.addLayer(jalan_manado); // Menambahkan GeoJSON Polyline Jalan ke dalam peta
        });




        // GeoJSON Polygon Persentase Stunting
        map.createPane('panePersentaseStunting');
        map.getPane("panePersentaseStunting").style.zIndex = 301;

        var data_persentase_stunting = L.geoJSON(null, {
            pane: 'panePersentaseStunting',

            // Style berdasarkan kategori kode_warna
            style: function (feature) {
                var persenstunting = feature.properties.PRSN_BLTA; // Ambil kode_warna dari properti PRSN_BLTA
                var fillColor;

                // Tetapkan warna gradien berdasarkan nilai PRSN_BLTA
                if (persenstunting === 0) {
                    fillColor = "#ffcc99"; // (Risiko sangat rendah)
                } else if (persenstunting <= 1) {
                    fillColor = "#ff6666"; // (Risiko rendah)
                } else if (persenstunting <= 4) {
                    fillColor = "#e6004c"; // (Risiko sedang)
                } else if (persenstunting > 4) {
                    fillColor = "#660033"; // (Risiko tinggi)
                } else {
                    fillColor = "#808080"; // Default (abu-abu) untuk nilai PRSN_BLTA yang tidak valid
                }

                return {
                    opacity: 1,
                    color: 'black',
                    weight: 1.0,
                    fillOpacity: 1,
                    fillColor: fillColor
                };
            },

            // onEach
            // onEachFeature untuk popup dan tooltip
            onEachFeature: function (feature, layer) {
                var persenstunting = feature.properties.PRSN_BLTA; // Ambil nilai PRSN_BLTA
                var tingkatStunting;

                // Tentukan tingkat risiko berdasarkan nilai PRSN_BLTA
                if (persenstunting === 0) {
                    tingkatStunting = "Sangat Rendah";
                } else if (persenstunting <= 1) {
                    tingkatStunting = "Rendah";
                } else if (persenstunting <= 4) {
                    tingkatStunting = "Sedang";
                } else if (persenstunting > 4) {
                    tingkatStunting = "Tinggi";
                } else {
                    tingkatStunting = "Data Tidak Valid";
                }
                // Konten popup
                var popupContent =
                    "Kecamatan: " + feature.properties.Kecamatan + "<br>" +
                    "Kelurahan: " + feature.properties.Kelurahan + "<br>" +
                    "Persentase Stunting: " + persenstunting + "%<br>" +
                    "Tingkat Persentase: <b>" + tingkatStunting + "</b>";

                // Tambahkan interaksi pada layer
                layer.on({
                    click: function (e) {
                        // Tampilkan popup dalam modal
                        $("#featureModalTitle").html("Persentase Stunting");
                        $("#featureModalBody").html(popupContent);
                        $("#featureModal").modal("show");
                    },
                    mouseover: function (e) {
                        layer.bindTooltip(
                            "Kelurahan: " + feature.properties.Kelurahan, {
                            direction: "auto",
                            sticky: true
                        }).openTooltip();
                    },
                });
            },
        });

        // Tambahkan data GeoJSON ke peta
        $.getJSON("data/data_persentase_stunting.geojson", function (data) {
            data_persentase_stunting.addData(data); // Menambahkan data ke layer GeoJSON
            map.addLayer(data_persentase_stunting); // Menambahkan layer ke dalam peta
        });




        // GeoJSON Polygon Resiko Keluarga Stunting
        map.createPane('paneResikoStunting');
        map.getPane("paneResikoStunting").style.zIndex = 301;

        var data_resiko_keluarga = L.geoJSON(null, {
            pane: 'paneResikoStunting',

            // Style berdasarkan gradien PRSN_KRISK
            style: function (feature) {
                var persenresiko = feature.properties.PRSN_KRISK; // Ambil nilai PRSN_KRISK
                var fillColor;

                // Tetapkan warna gradien berdasarkan nilai PRSN_KRISK
                if (persenresiko <= 20) {
                    fillColor = "#ffeecc"; // (Risiko sangat rendah)
                } else if (persenresiko <= 30) {
                    fillColor = "#ffbb99"; // (Risiko rendah)
                } else if (persenresiko <= 40) {
                    fillColor = "#ff6666"; // (Risiko sedang)
                } else if (persenresiko > 40) {
                    fillColor = "#660066"; // (Risiko tinggi)
                } else {
                    fillColor = "#808080"; // Default (abu-abu) untuk nilai PRSN_KRISK yang tidak valid
                }

                return {
                    opacity: 1,
                    color: 'black',
                    weight: 1.0,
                    fillOpacity: 1,
                    fillColor: fillColor
                };
            },

            // onEachFeature untuk popup dan tooltip
            onEachFeature: function (feature, layer) {
                var persenresiko = feature.properties.PRSN_KRISK; // Ambil nilai PRSN_KRISK
                var tingkatResiko;

                // Tentukan tingkat risiko berdasarkan nilai PRSN_KRISK
                if (persenresiko <= 20) {
                    tingkatResiko = "Risiko Sangat Rendah";
                } else if (persenresiko <= 30) {
                    tingkatResiko = "Risiko Rendah";
                } else if (persenresiko <= 40) {
                    tingkatResiko = "Risiko Sedang";
                } else if (persenresiko > 40) {
                    tingkatResiko = "Risiko Tinggi";
                } else {
                    tingkatResiko = "Data Tidak Valid";
                }

                // Konten popup dengan tingkat risiko
                var popupContent =
                    "Kecamatan: " + feature.properties.Kecamatan + "<br>" +
                    "Kelurahan: " + feature.properties.Kelurahan + "<br>" +
                    "Persentase Risiko: " + persenresiko + "%<br>" +
                    "Tingkat Risiko: <b>" + tingkatResiko + "</b>";

                // Tambahkan event untuk menampilkan popup dan tooltip
                layer.on({
                    click: function (e) {
                        // Tampilkan modal dengan informasi detail
                        $("#featureModalTitle").html("Risiko Stunting");
                        $("#featureModalBody").html(popupContent);
                        $("#featureModal").modal("show");
                    },

                    mouseover: function (e) {
                        layer.bindTooltip(
                            "Kelurahan: " + feature.properties.Kelurahan, {
                            direction: "auto",
                            sticky: true
                        }
                        );
                    }
                });
            }
        });

        // Ambil data GeoJSON dan tambahkan ke peta
        $.getJSON("data/data_resiko_keluarga.geojson", function (data) {
            data_resiko_keluarga.addData(data); // Tambahkan data ke layer GeoJSON
            map.addLayer(data_resiko_keluarga); // Tambahkan layer ke peta
        });




        // Control Layer
        var baseMaps = {
            "OpenStreetMap": basemap,
            "Esri World Imagery": Esri_WorldImagery,
            "Topographic": topoBaseMap,
            "RupaBumi Indonesia": rupabumiindonesia
        };

        var overlayMaps = {
            "Kasus Stunting 2024": kasus_stunting,
            "Puskesmas": puskesmas,
            "Jalan": jalan_manado,
            "Persentase Stunting": data_persentase_stunting,
            "Resiko Keluarga Stunting": data_resiko_keluarga
        };

        var controllayer = L.control.layers(baseMaps, overlayMaps);
        controllayer.addTo(map);



        // Search Control dengan daftar interaktif
        var searchControl = new L.Control.Search({
            layer: data_persentase_stunting, // Layer data GeoJSON
            propertyName: 'Kelurahan', // Properti yang akan dicari
            marker: false, // Tidak menampilkan marker default
            textPlaceholder: 'Cari Kelurahan...', // Placeholder pada input pencarian
            initial: false, // Tampilkan semua nilai secara default
            buildTip: function (text, val) {
                // Custom tampilan hasil pencarian (dropdown)
                return '<a href="#" class="search-tip"><span>' + text + '</span></a>';
            },
            moveToLocation: function (latlng, title, map) {
                // Atur tampilan peta ke lokasi yang ditemukan
                map.setView(latlng, 15); // Zoom level 15
            }
        });

        // Event ketika lokasi ditemukan
        searchControl.on('search:locationfound', function (e) {
    e.layer.setStyle({ fillColor: '#ff008a', color: '#ff0062' }); // Highlight layer yang ditemukan
    if (e.layer._popup) e.layer.openPopup(); // Tampilkan popup jika tersedia
});





        // Tambahkan Search Control ke peta
        map.addControl(searchControl);

        // Menambahkan daftar kelurahan secara interaktif
        var kelurahanList = []; // Inisialisasi daftar kelurahan
        data_persentase_stunting.eachLayer(function (layer) {
            var kelurahan = layer.feature.properties.Kelurahan;
            if (!kelurahanList.includes(kelurahan)) {
                kelurahanList.push(kelurahan); // Tambahkan kelurahan ke daftar jika belum ada
            }
        });

        // Menambahkan daftar kelurahan di bawah input pencarian
        var searchContainer = document.querySelector('.leaflet-control-search'); // Kontainer search
        var kelurahanDropdown = document.createElement('div'); // Elemen dropdown
        kelurahanDropdown.className = 'kelurahan-dropdown'; // Kelas CSS untuk styling

        // Buat elemen daftar kelurahan
        kelurahanList.sort().forEach(function (kelurahan) {
            var kelurahanItem = document.createElement('div');
            kelurahanItem.className = 'kelurahan-item';
            kelurahanItem.textContent = kelurahan;

            // Event klik pada item kelurahan
            kelurahanItem.onclick = function () {
                searchControl.searchText(kelurahan); // Jalankan pencarian menggunakan plugin
            };

            kelurahanDropdown.appendChild(kelurahanItem);
        });

        // Tambahkan dropdown ke kontainer pencarian
        searchContainer.appendChild(kelurahanDropdown);

        // Styling tambahan menggunakan CSS
        var style = document.createElement('style');
        style.innerHTML = `
    .kelurahan-dropdown {
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        position: absolute;
        top: 40px;
        z-index: 1000;
        width: 300px;
    }
    .kelurahan-item {
        padding: 5px;
        cursor: pointer;
    }
    .kelurahan-item:hover {
        background: #f0f0f0;
    }
    .leaflet-control-search input {
        width: 300px;
    }
`;
        document.head.appendChild(style);

        map.addControl(searchControl);  //inizialize search control
        

        // Default Control
        L.control.defaultExtent().addTo(map);

        // Logo Watermark
        L.Control.Watermark = L.Control.extend({
            onAdd: function (map) {
                var img = L.DomUtil.create('img');

                img.src = 'icon/logo _manado.png';
                img.style.width = '100px';
                img.style.bottom = '10px';
                img.style.right = '10px';

                 // Add animation for smooth transitions (fade in/out)
        img.style.transition = 'opacity 0.2s ease-in-out';

                // Hover effect to make it stand out more when hovered
        img.addEventListener('mouseover', function() {
        img.style.opacity = '1'; // Full opacity when hovered
        });
        img.addEventListener('mouseout', function() {
        img.style.opacity = '0.7'; // Return to the original opacity when not hovered
        });

                return img;
            },

            onRemove: function (map) {
                // Nothing to do here
            }
        });

        L.control.watermark = function (opts) {
            return new L.Control.Watermark(opts);
        }

        L.control.watermark({ position: 'bottomright' }).addTo(map);

    </script>

</body>

</html>