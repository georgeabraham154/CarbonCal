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
            min-width: 200px; /* Lebar minimum dropdown */
        }
        .menu-dropdown button {
            display: block;
            width: 100%;
            background: none;
            border: none;
            padding: 12px; /* Padding lebih besar */
            text-align: left;
            font-weight: 600;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }
        .menu-dropdown button:hover {
            background-color: #e6ffe6; /* Hijau muda saat hover */
        }
        main {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .section-title {
            color: #1a4d2e; /* Warna judul bagian */
            font-weight: 700;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 12px; /* Sudut kartu lebih membulat */
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); /* Bayangan kartu */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px; /* Jarak antar kartu */
        }
        .card:hover {
            transform: translateY(-5px); /* Efek angkat saat hover */
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        .card-title {
            color: #1a4d2e;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .card-text {
            color: #555;
            line-height: 1.6;
        }
        .btn {
            border-radius: 25px; /* Tombol lebih membulat */
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #2e8b57; /* Hijau sedang */
            border-color: #2e8b57;
        }
        .btn-primary:hover {
            background-color: #1a4d2e; /* Hijau tua saat hover */
            border-color: #1a4d2e;
            transform: translateY(-2px);
        }
        .btn-success {
            background-color: #66bb6a; /* Hijau terang */
            border-color: #66bb6a;
        }
        .btn-success:hover {
            background-color: #4caf50;
            border-color: #4caf50;
            transform: translateY(-2px);
        }
        .btn-warning {
            background-color: #ffc107; /* Kuning */
            border-color: #ffc107;
            color: #333; /* Teks gelap untuk kontras */
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
            transform: translateY(-2px);
        }
        footer {
            background-color: #1a4d2e !important; /* Hijau tua */
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
        }
        .sdgs-icon {
            font-size: 1.2em;
            margin-right: 5px;
            color: #2e8b57; /* Warna ikon SDGs */
        }
    </style>
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>

<body>
    <!-- Navbar dengan Burger Menu -->
    <nav class="navbar navbar-dark p-3 position-relative">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">CarbonCal</a>
            <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
        </div>
    </nav>

    <!-- Dropdown Menu -->
    <div id="menuDropdown" class="menu-dropdown text-start">
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=form'">🏠 Home</button>
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=calories'">🔥 Calories Calculator</button>
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=track'">🌍 Carbon Track</button>
    </div>

    <main class="container mt-4">
        <!-- Penjelasan CarbonCal -->
        <section class="text-center mb-5 p-4 bg-white rounded-lg shadow-sm">
            <h2 class="section-title">Apa itu CarbonCal?</h2>
            <p class="text-secondary">CarbonCal adalah aplikasi yang membantu Anda menghitung, memantau, dan mengurangi jejak karbon dari aktivitas sehari-hari. Dengan teknologi berbasis data, kami bertujuan untuk meningkatkan kesadaran dan mendorong perubahan gaya hidup yang lebih ramah lingkungan.</p>
            <h3 class="section-title mt-4">Tujuan CarbonCal</h3>
            <p class="text-secondary">Kami mendukung keberlanjutan dengan membantu individu dan komunitas mengadopsi kebiasaan yang lebih hijau, sejalan dengan tujuan SDGs (Sustainable Development Goals).</p>
            <h4 class="section-title mt-4"><span class="sdgs-icon">🌱</span> SDGs Scope 12 & 13</h4>
            <p class="text-secondary"><strong>Goal 12 (Konsumsi & Produksi Berkelanjutan):</strong> Mengurangi dampak lingkungan melalui pengelolaan sumber daya yang lebih efisien.</p>
            <p class="text-secondary"><strong>Goal 13 (Aksi Iklim):</strong> Mengedukasi dan memberikan solusi untuk mengurangi emisi karbon guna memerangi perubahan iklim.</p>
        </section>

        <div class="d-flex flex-column align-items-center gap-3">
            <div class="card text-center w-100 p-4">
                <div class="card-body">
                    <h2 class="card-title">Carbon Calculator</h2>
                    <p class="card-text">Kalkulator ini membantu Anda menghitung jumlah emisi karbon yang dihasilkan dari aktivitas sehari-hari seperti berkendara dan penggunaan listrik.</p>
                    <button class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=form'">Hitung</button>
                </div>
            </div>

            <div class="card text-center w-100 p-4">
                <div class="card-body">
                    <h2 class="card-title">Calories Calculator</h2>
                    <p class="card-text">Gunakan kalkulator ini untuk memperkirakan jumlah kalori yang Anda konsumsi dan butuhkan berdasarkan aktivitas harian Anda.</p>
                    <button class="btn btn-success" onclick="window.location.href='calories.html'">Hitung</button>
                </div>
            </div>

            <div class="card text-center w-100 p-4">
                <div class="card-body">
                    <h2 class="card-title">Carbon Track</h2>
                    <p class="card-text">Lacak jejak karbon Anda dan pantau perubahan emisi karbon yang dihasilkan dari kebiasaan sehari-hari.</p>
                    <button class="btn btn-warning" onclick="window.location.href='track.html'">Lihat</button>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <footer>
        <div class="container">
            <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
        </div>
    </footer>

</body>
