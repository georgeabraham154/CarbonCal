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
          background: #ffffff; /* Latar putih */
          box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1); /* Bayangan lebih dalam */
          z-index: 1000;
          padding: 15px 20px; /* Padding lebih besar */
          border-top-left-radius: 15px; /* Sudut membulat */
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
        section {
            padding: 20px;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .calorie-result {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            background-color: #e6ffe6; /* Latar hijau muda */
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .calorie-result h3 {
            color: #1a4d2e;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .calorie-result p {
            color: #555;
        }
        .emission-badge {
            display: inline-block;
            background-color: #2e8b57; /* Hijau utama */
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 1.2em;
            font-weight: 700;
            margin: 10px 0;
        }
        .alert-warning {
            background-color: #fff3cd; /* Kuning muda */
            border-color: #ffeeba;
            color: #664d03; /* Kuning gelap */
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .alert-warning h4 {
            color: #664d03;
            font-weight: 700;
            margin-bottom: 15px;
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

        // Fungsi untuk menghitung emisi makanan berdasarkan kalori (contoh)
        function calculateFoodEmission() {
            const calorieData = JSON.parse(sessionStorage.getItem('calorieData')) || { calories: 0, emission: 0 };
            const emissionPerKcal = 0.000001; // Ton CO2 per Kkal (dummy value)
            return calorieData.calories * emissionPerKcal * 365; // Emisi per tahun
        }

        // Fungsi untuk memperbarui total emisi di footer
        function updateTotalEmission() {
            let currentTotalEmission = parseFloat(sessionStorage.getItem('totalCarbonEmission')) || 0;
            const foodEmission = calculateFoodEmission();

            sessionStorage.setItem('foodEmission', foodEmission.toFixed(2));

            const transportEmission = parseFloat(sessionStorage.getItem('transportEmission')) || 0;
            const householdEmission = parseFloat(sessionStorage.getItem('householdEmission')) || 0;
            const applianceEmission = parseFloat(sessionStorage.getItem('applianceEmission')) || 0;

            currentTotalEmission = transportEmission + householdEmission + applianceEmission + foodEmission;

            document.getElementById('footerTotalEmission').textContent = `${currentTotalEmission.toFixed(2)} Ton CO2/Tahun`;
            sessionStorage.setItem('totalCarbonEmission', currentTotalEmission.toFixed(2));
        }

        window.addEventListener('DOMContentLoaded', () => {
            updateTotalEmission();

            const calorieData = JSON.parse(sessionStorage.getItem('calorieData'));
            if (calorieData && calorieData.calories > 0) {
                document.getElementById('no-calorie-data').classList.add('d-none');
                document.getElementById('calorie-data').classList.remove('d-none');
                document.querySelector('#calorie-data .emission-badge:nth-of-type(1)').textContent = `${calorieData.calories} Kkal`;
                document.querySelector('#calorie-data .emission-badge:nth-of-type(2)').textContent = `${calorieData.emission} Ton CO2/Tahun`;
            } else {
                document.getElementById('no-calorie-data').classList.remove('d-none');
                document.getElementById('calorie-data').classList.add('d-none');
            }
        });

        function submitCarbonData() {
            const transportEmission = parseFloat(sessionStorage.getItem('transportEmission')) || 0;
            const householdEmission = parseFloat(sessionStorage.getItem('householdEmission')) || 0;
            const applianceEmission = parseFloat(sessionStorage.getItem('applianceEmission')) || 0;
            const foodEmission = parseFloat(sessionStorage.getItem('foodEmission')) || 0;
            const totalCarbonEmission = parseFloat(sessionStorage.getItem('totalCarbonEmission')) || 0;

            document.getElementById('transport_emission_input').value = transportEmission;
            document.getElementById('household_emission_input').value = householdEmission;
            document.getElementById('appliance_emission_input').value = applianceEmission;
            document.getElementById('food_emission_input').value = foodEmission;
            document.getElementById('total_emission_input').value = totalCarbonEmission;

            sessionStorage.clear();

            document.getElementById('carbonForm').submit();
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
    <div class="step"></div>
    <div class="step"></div>
    <div class="step active"></div>
  </div>

  <section class="container mt-4" id="food-section">
    <h2 class="text-center mb-4" style="color: #1a4d2e; font-weight: 700;">Emisi Makanan</h2>
    <div id="calorie-data" class="d-none">
      <div class="calorie-result text-center mb-4">
        <h3>Jumlah Kalori Kamu</h3>
        <p class="mb-1">Dari jumlah kalori mu yang sebesar</p>
        <h4 class="emission-badge"></h4>
        <p class="mb-1 mt-3">Kamu menyumbang emisi karbon sebesar</p>
        <h4 class="emission-badge"></h4>
      </div>
    </div>

    <div id="no-calorie-data">
      <div class="alert alert-warning text-center">
        <h4 class="alert-heading">Kamu belum mengisi data dari makanan kamu!</h4>
        <button class="btn btn-primary" onclick="window.location.href='index.php?c=Calories&m=form'">Hitung Sekarang</button>
      </div>
    </div>
  </section>

  <form id="carbonForm" action="index.php?c=Todos&m=hasil" method="POST">
    <input type="hidden" id="transport_emission_input" name="transport_emission">
    <input type="hidden" id="household_emission_input" name="household_emission">
    <input type="hidden" id="appliance_emission_input" name="appliance_emission">
    <input type="hidden" id="food_emission_input" name="food_emission">
    <input type="hidden" id="total_emission_input" name="total_emission">

    <div class="sticky-footer">
      <button type="button" class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=peralatan'">←</button>
      <div class="text-center">
        <strong>Total Emisi</strong><br><span id="footerTotalEmission">0.00 Ton CO2/Tahun</span>
      </div>
      <button type="button" class="btn btn-primary" onclick="submitCarbonData()">→</button>
    </div>
  </form>

</body>
</html>
