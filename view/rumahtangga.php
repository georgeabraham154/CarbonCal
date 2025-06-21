<!DOCTYPE html>
<html lang="id">
<head>
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
        .step {
          width: 12px;
          height: 12px;
          background-color: #ccc;
          border-radius: 50%;
          margin: 0 6px;
        }
        .step.active {
          background-color: #0d6efd;
        }
        .sticky-footer {
          position: fixed;
          bottom: 0;
          left: 0;
          width: 100%;
          background: #ffffff;
          box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
          z-index: 1000;
          padding: 15px 20px;
          border-top-left-radius: 15px;
          border-top-right-radius: 15px;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        .sticky-footer .btn {
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            background-color: #2e8b57;
            border-color: #2e8b57;
            transition: all 0.3s ease;
        }
        .sticky-footer .btn:hover {
            background-color: #1a4d2e;
            border-color: #1a4d2e;
            transform: translateY(-2px);
        }
        .sticky-footer span {
            font-size: 0.9em;
            color: #555;
            text-align: center;
        }
        .sticky-footer strong {
            font-size: 1.1em;
            color: #1a4d2e;
        }
        main.container.text-center.pb-5 {
            padding-top: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 100px !important; /* Agar tidak tertutup footer */
        }
        main.container.text-center.pb-5 h2 {
            color: #1a4d2e;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            border-color: #c3e6cb;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
    </style>
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function goBack() {
            window.history.back();
        }

        function calculateHouseholdEmission() {
            const dayaListrik = parseFloat(document.getElementById('daya-listrik').value) || 0;
            const tagihan = parseFloat(document.getElementById('tagihan').value) || 0;
            const emissionPerRp1000 = 0.0005; // Ton CO2 per Rp 1000 (dummy value)
            return (tagihan / 1000) * emissionPerRp1000 * 12; // Emisi per tahun
        }

        function updateTotalEmission() {
            let currentTotalEmission = parseFloat(sessionStorage.getItem('totalCarbonEmission')) || 0;
            const householdEmission = calculateHouseholdEmission();

            sessionStorage.setItem('householdEmission', householdEmission.toFixed(2));

            const transportEmission = parseFloat(sessionStorage.getItem('transportEmission')) || 0;
            const applianceEmission = parseFloat(sessionStorage.getItem('applianceEmission')) || 0;
            const foodEmission = parseFloat(sessionStorage.getItem('foodEmission')) || 0;

            currentTotalEmission = transportEmission + householdEmission + applianceEmission + foodEmission;

            document.getElementById('footerTotalEmission').textContent = `${currentTotalEmission.toFixed(2)} Ton CO2/Tahun`;
            sessionStorage.setItem('totalCarbonEmission', currentTotalEmission.toFixed(2));
        }

        window.addEventListener('DOMContentLoaded', () => {
            const storedDayaListrik = sessionStorage.getItem('dayaListrik');
            if (storedDayaListrik) {
                document.getElementById('daya-listrik').value = storedDayaListrik;
            }
            const storedTagihan = sessionStorage.getItem('tagihan');
            if (storedTagihan) {
                document.getElementById('tagihan').value = storedTagihan;
            }

            updateTotalEmission();

            document.getElementById('daya-listrik').addEventListener('input', updateTotalEmission);
            document.getElementById('tagihan').addEventListener('input', updateTotalEmission);
        });

        function navigateToNextPage(url) {
            sessionStorage.setItem('dayaListrik', document.getElementById('daya-listrik').value);
            sessionStorage.setItem('tagihan', document.getElementById('tagihan').value);
            window.location.href = url;
        }
    </script>
</head>

<body class="bg-light">
  <nav class="navbar navbar-dark p-3 position-relative">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-light me-2" onclick="goBack()">←</button>
        <a class="navbar-brand mb-0" href="#">CarbonCal</a>
      </div>
      <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
    </div>
  </nav>

    <div id="menuDropdown" class="menu-dropdown text-start">
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=form'">🏠 Home</button>
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=calories'">🔥 Calories Calculator</button>
        <button class="btn" onclick="window.location.href='index.php?c=Todos&m=track'">🌍 Carbon Track</button>
    </div>

  <div class="d-flex justify-content-center my-3">
    <div class="step"></div>
    <div class="step active"></div>
    <div class="step"></div>
    <div class="step"></div>
  </div>

  <main class="container text-center pb-5">
    <h2>Rumah Tangga</h2>
    <div class="mb-3">
      <label for="daya-listrik" class="form-label">Daya Terpasang (VA):</label>
      <input type="number" class="form-control w-50 mx-auto" id="daya-listrik" min="0" value="0">
    </div>
    <div class="mb-3">
      <label for="tagihan" class="form-label">Tagihan Listrik Per Bulan (Rp):</label>
      <input type="number" class="form-control w-50 mx-auto" id="tagihan" min="0" value="0">
    </div>
  </main>

  <div class="sticky-footer">
  <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=transport')">←</button>
    <div class="text-center">
      <strong>Total Emisi</strong><br><span id="footerTotalEmission">0.00 Ton CO2/Tahun</span>
    </div>
    <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=peralatan')">→</button>
  </div>

</body>
</html>
