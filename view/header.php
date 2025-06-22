<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
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
            border-radius: 25px !important; 
            padding: 10px 25px !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        document.addEventListener('click', function(event) {
        const menu = document.getElementById("menuDropdown");
        const trigger = event.target.closest('[onclick*="toggleMenu"]');
    
        if (!trigger && menu && menu.style.display === "block") {
        menu.style.display = "none";
        menu.classList.remove("show");
        }   
        });
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>
</head>
<body>
    <nav class="navbar  bg-green p-3 position-relative">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">CarbonCal</a>
            <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
        </div>
    </nav>
    <div id="menuDropdown" class="menu-dropdown text-start">
        <button onclick="window.location.href='index.php?c=Todos&m=index'">🏠 Home</button>
        <button onclick="window.location.href='index.php?c=Calories&m=index'">🔥 Calories Calculator</button>
        <button onclick="window.location.href='index.php?c=Todos&m=menu'">🌍 Carbon Track</button>
    </div>
</body>
