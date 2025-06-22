<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .menu-dropdown button {
            display: block;
            width: 100%;
            background: none;
            border: none;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }
        .menu-dropdown button:hover {
            background-color: #e6ffe6;
        }
        main {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        h1 {
            color: #1a4d2e;
            font-weight: 700;
            margin-bottom: 20px;
        }
        p {
            color: #555;
        }
        .alert-info {
            background-color: #d4edda; /* Hijau muda */
            border-color: #c3e6cb;
            color: #155724; /* Hijau gelap */
            border-radius: 8px;
            padding: 20px;
            font-size: 1.1em;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .img-fluid.rounded.shadow {
            border-radius: 12px !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            margin-top: 30px;
            max-width: 80%; /* Batasi lebar gambar */
            height: auto;
        }
        .btn {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            margin-top: 40px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #2e8b57;
            border-color: #2e8b57;
        }
        .btn-primary:hover {
            background-color: #1a4d2e;
            border-color: #1a4d2e;
            transform: translateY(-2px);
        }
        footer {
            background-color: #1a4d2e !important;
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
        }
    </style>
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>

<body>
        <?php @include "header.php";?>

    <main class="container mt-4 text-center">
        <h1>Carbon Calculator</h1>
        <p>Gunakan kalkulator ini untuk menghitung emisi karbon dari aktivitas sehari-hari.</p>

        <!-- Fun Facts Section -->
        <section class="mt-4 p-4 bg-white rounded-lg shadow-sm">
            <h3 class="text-success">🌱 Fakta Menarik</h3>
            <div class="alert alert-info" role="alert">
                "Tahukah kamu? Satu pohon dapat menyerap hingga 22 kg karbon dioksida setiap tahunnya!"
            </div>
            <!-- Menggunakan placeholder image karena 'hutan.jpg' tidak tersedia -->
            <img src="hutan.jpg" class="img-fluid rounded shadow" alt="Hutan hijau">
        </section>

        <!-- Call to Action -->
        <button class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=transport'">Mulai Perhitungan</button>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <footer>
        <div class="container">
            <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
        </div>
    </footer>
</body>
