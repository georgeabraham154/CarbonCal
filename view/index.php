<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; /* Warna latar belakang lembut */
        }
        .navbar {
            background-color: #1a4d2e !important; /* Hijau tua */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: #e6ffe6 !important; /* Hijau muda */
        }
        .menu-dropdown {
            display: none;
            position: fixed;
            right: 10px;
            top: 60px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px; /* Sudut lebih membulat */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); /* Bayangan lebih dalam */
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
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 2rem;
        }
        .card-title {
            font-weight: 700;
            color: #1a4d2e;
            margin-bottom: 1rem;
        }
        .card-text {
            color: #555;
            line-height: 1.6;
        }
        .btn-primary {
            background-color: #1a4d2e;
            border-color: #1a4d2e;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0e331f;
            border-color: #0e331f;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
            transition: background-color 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
        .footer {
            background-color: #1a4d2e;
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
        }
    </style>
    <title>CarbonCal</title>
</head>

<body>
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
                <a href="index.php?c=Todos&m=menu" class="btn">🌍 Carbon Track</a> </div>
        </div>
    </nav>

    <main class="container my-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="card text-center w-100 p-4">
                    <div class="card-body">
                        <h2 class="card-title">Carbon Calculator</h2>
                        <p class="card-text">Hitung jejak karbon Anda dari berbagai aktivitas sehari-hari seperti berkendara dan penggunaan listrik.</p>
                        <button class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=form'">Hitung</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="card text-center w-100 p-4">
                    <div class="card-body">
                        <h2 class="card-title">Calories Calculator</h2>
                        <p class="card-text">Gunakan kalkulator ini untuk memperkirakan jumlah kalori yang Anda konsumsi dan butuhkan berdasarkan aktivitas harian Anda.</p>
                        <button class="btn btn-success" onclick="window.location.href='calories.html'">Hitung</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="card text-center w-100 p-4">
                    <div class="card-body">
                        <h2 class="card-title">Carbon Track</h2>
                        <p class="card-text">Lacak jejak karbon Anda dan pantau perubahan emisi karbon yang dihasilkan dari kebiasaan sehari-hari.</p>
                        <button class="btn btn-warning" onclick="window.location.href='index.php?c=Todos&m=menu'">Lihat</button> </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            var dropdown = document.getElementById('menuDropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            } else {
                dropdown.style.display = 'block';
            }
        });

        // Close the dropdown if the user clicks outside of it
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

    <footer class="footer mt-5">
        <div class="container">
            <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
        </div>
    </footer>
</body>

</html>