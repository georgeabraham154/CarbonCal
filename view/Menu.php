<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carbon Track Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; 
        }
        .navbar {
            background-color: #1a4d2e !important; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: #e6ffe6 !important; 
        }
        .menu-dropdown {
            display: none;
            position: fixed;
            right: 10px;
            top: 60px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px; 
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px;
            z-index: 1050;
            min-width: 200px;
        }
        .menu-dropdown a {
            padding: 8px 10px;
            display: block;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu-dropdown a:hover {
            background-color: #f0f0f0;
        }
        .footer {
            background-color: #1a4d2e;
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
        }
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

        .text-green { /* Kept for text styling */
            color: #28a745 ;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CarbonCal</a>
            <div class="d-flex align-items-center">
                <div id="menuToggle" style="cursor: pointer;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Hamburger_icon.svg" alt="Menu" width="30" height="30" style="filter: invert(100%);">
                </div>
            </div>
            <div class="menu-dropdown" id="menuDropdown">
                <a href="index.php?c=Todos&m=index" class="btn">🏠 Home</a>
                <a href="index.php?c=Todos&m=form" class="btn">♻️ Carbon Calculator</a>
                <a href="index.php?c=Todos&m=menu" class="btn">🌍 Carbon Track</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4 text-green">Selamat Datang di Carbon Track!</h2>
        <p class="text-center mb-5 text-muted">
            Pantau dan kelola jejak karbon Anda dengan mudah. Pilih salah satu opsi di bawah ini:
        </p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-title fw-bold">Kurangi Emisi</p>
                        <p class="card-text text-muted">
                            Dapatkan rekomendasi dan tetapkan target untuk mengurangi jejak karbon Anda.
                        </p>
                        <button class="btn btn-lg btn-green " onclick="window.location.href='index.php?c=Todos&m=kurangiEmisi'">lihat</button>
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
                        <button class="btn btn-lg btn-green " onclick="window.location.href='index.php?c=Todos&m=leaderboard'">lihat</button>
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
                        <button class="btn btn-lg btn-green " onclick="window.location.href='index.php?c=Todos&m=riwayatEmisi'">lihat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            var dropdown = document.getElementById('menuDropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            } else {
                dropdown.style.display = 'block';
            }
        });

        
        window.addEventListener('click', function(event) {
            var dropdown = document.getElementById('menuDropdown');
            var toggle = document.getElementById('menuToggle');
            if (!event.target.closest('#menuToggle') && !event.target.closest('#menuDropdown')) {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>