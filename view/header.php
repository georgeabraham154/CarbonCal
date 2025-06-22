<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3 position-relative">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-light me-2" onclick="history.back()">←</button>
                <a class="navbar-brand mb-0" href="#">CarbonCal</a>
            </div>
            <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
        </div>
    </nav>
    <div id="menuDropdown" class="menu-dropdown text-start">
        <button onclick="window.location.href='carboncal.html'">🏠 Home</button>
        <button onclick="window.location.href='calories.html'">🔥 Calories Calculator</button>
        <button onclick="window.location.href='track.html'">🌍 Carbon Track</button>
    </div>
</body>
