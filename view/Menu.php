<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carbon Track Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .container {
            max-width: 800px;
            margin: 50px auto;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.3rem;
        }
        .bg-green {
            background-color: #28a745 ; 
            color: white ;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
            border-radius: 0.8rem;
            border: none;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .text-green {
            color: #28a745 ;
        }
            
    </style>
</head>
<body class="bg-light">
    <nav class="navbar  bg-green p-3 position-relative">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">CarbonCal</a>
            <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
        </div>
    </nav>
    <div class="container py-4">
        <div class="text-center mb-3">
                <h1 class="fw-bold">Carbon Track</h1>
            <p class="text-muted ">
                Lacak, kurangi, dan pantau jejak karbonmu untuk masa depan yang lebih hijau dan berkelanjutan.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-title fw-bold">Kurangi Emisi Karbonmu!</p>
                        <p class="card-text text-muted">
                            Temukan cara-cara sederhana untuk mengurangi emisi karbon dalam aktivitas sehari-harimu.
                        </p>
                        <button class="btn btn-lg btn-green " onclick="window.location.href='?c=Todos&m=kurangiEmisi'">lihat</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-title fw-bold">Leaderboard</p>
                        <p class="card-text text-muted">
                            Lihat peringkat pengguna lain berdasarkan pengurangan emisi karbon yang telah mereka capai.
                        </p>
                        <button class="btn btn-lg btn-green " onclick="window.location.href='?c=Todos&m=leaderboard'">lihat</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-title fw-bold">Riwayat Emisi Karbonmu!</p>
                        <p class="card-text text-muted">
                            Pantau dan telusuri catatan emisi karbon yang telah kamu hasilkan dari waktu ke waktu.
                        </p>
                        <button class="btn btn-lg btn-green " onclick="window.location.href='?c=Todos&m=riwayatEmisi'">lihat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="bg-green text-white mt-5 py-4">
    <div class="container text-center">
        <p class="mb-2">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
    </div>
</footer>
</html>
