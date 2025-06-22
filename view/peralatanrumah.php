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
        footer {
            background-color: #1a4d2e !important;
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
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
        .container.pb-5 {
            padding-top: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 100px !important; /* Agar tidak tertutup footer */
        }
        .container.pb-5 h2 {
            color: #1a4d2e;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .btn-light.w-100.mb-2 {
            background-color: #f8fcf8; /* Latar tombol kategori */
            border-color: #e6ffe6;
            color: #1a4d2e;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        .btn-light.w-100.mb-2:hover {
            background-color: #e6ffe6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card.p-3.mb-3 {
            background-color: #f8fcf8; /* Latar detail input */
            border: 1px solid #e6ffe6;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .form-control {
            border-radius: 8px;
            border-color: #c3e6cb;
        }
        .input-group-append .btn, .input-group-prepend .btn {
            border-radius: 8px;
            background-color: #2e8b57;
            border-color: #2e8b57;
            color: white;
            font-weight: bold;
        }
        .input-group-append .btn:hover, .input-group-prepend .btn:hover {
            background-color: #1a4d2e;
            border-color: #1a4d2e;
        }
        .input-group .form-control {
            z-index: 0; /* Pastikan input di tengah tidak tertutup tombol */
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

        function toggleDetail(id) {
            const panel = document.getElementById(id);
            panel.classList.toggle("d-none");
            updateTotalEmission();
        }

        function increment(id) {
            const el = document.getElementById(id);
            el.value = parseInt(el.value || '0') + 1;
            updateTotalEmission();
        }

        function decrement(id) {
            const el = document.getElementById(id);
            el.value = Math.max(0, parseInt(el.value || '0') - 1);
            updateTotalEmission();
        }

        function calculateApplianceEmission() {
            const lampuCount = parseFloat(document.getElementById('lampuCount').value) || 0;
            const jamLampu = parseFloat(document.getElementById('jamLampu').value) || 0;
            const kipasCount = parseFloat(document.getElementById('kipasCount').value) || 0;
            const jamKipas = parseFloat(document.getElementById('jamKipas').value) || 0;
            const acCount = parseFloat(document.getElementById('acCount').value) || 0;
            const jamAc = parseFloat(document.getElementById('jamAc').value) || 0;

            const emissionPerLampuJam = 0.00001; // Ton CO2 (dummy value)
            const emissionPerKipasJam = 0.00001; // Ton CO2 (dummy value)
            const emissionPerAcJam = 0.00005; // Ton CO2 (dummy value)

            const lampuEmission = lampuCount * jamLampu * emissionPerLampuJam * 365;
            const kipasEmission = kipasCount * jamKipas * emissionPerKipasJam * 365;
            const acEmission = acCount * jamAc * emissionPerAcJam * 365;

            return lampuEmission + kipasEmission + acEmission;
        }

        function updateTotalEmission() {
            let currentTotalEmission = parseFloat(sessionStorage.getItem('totalCarbonEmission')) || 0;
            const applianceEmission = calculateApplianceEmission();

            sessionStorage.setItem('applianceEmission', applianceEmission.toFixed(2));

            const transportEmission = parseFloat(sessionStorage.getItem('transportEmission')) || 0;
            const householdEmission = parseFloat(sessionStorage.getItem('householdEmission')) || 0;
            const foodEmission = parseFloat(sessionStorage.getItem('foodEmission')) || 0;

            currentTotalEmission = transportEmission + householdEmission + applianceEmission + foodEmission;

            document.getElementById('footerTotalEmission').textContent = `${currentTotalEmission.toFixed(2)} Ton CO2/Tahun`;
            sessionStorage.setItem('totalCarbonEmission', currentTotalEmission.toFixed(2));
        }

        window.addEventListener('DOMContentLoaded', () => {
            const inputs = ['lampuCount', 'jamLampu', 'kipasCount', 'jamKipas', 'acCount', 'jamAc'];
            inputs.forEach(id => {
                const storedValue = sessionStorage.getItem(id);
                if (storedValue) {
                    document.getElementById(id).value = storedValue;
                }
                document.getElementById(id).addEventListener('input', updateTotalEmission);
            });

            updateTotalEmission();
        });

        function navigateToNextPage(url) {
            const inputs = ['lampuCount', 'jamLampu', 'kipasCount', 'jamKipas', 'acCount', 'jamAc'];
            inputs.forEach(id => {
                sessionStorage.setItem(id, document.getElementById(id).value);
            });
            window.location.href = url;
        }
    </script>
</head>

<body class="bg-light">
      <?php @include "header.php";?>

  <div class="d-flex justify-content-center my-3">
    <div class="step"></div>
    <div class="step"></div>
    <div class="step active"></div>
    <div class="step"></div>
  </div>

  <div class="container pb-5">
    <h2 class="text-center">Peralatan Rumah</h2>
    <button class="btn btn-light w-100 mb-2" onclick="toggleDetail('lampuDetail')">Lampu</button>
    <div id="lampuDetail" class="card p-3 mb-3 d-none">
      <label class="mb-1">Berapa jumlah lampu yang ada di rumah?</label>
      <div class="input-group mb-2">
        <button class="btn btn-outline-secondary" onclick="decrement('lampuCount')">−</button>
        <input type="number" id="lampuCount" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('lampuCount')">＋</button>
      </div>
      <label class="mb-1">Berapa lama penggunaan lampu perharinya? (Jam)</label>
      <div class="input-group">
        <button class="btn btn-outline-secondary" onclick="decrement('jamLampu')">−</button>
        <input type="number" id="jamLampu" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('jamLampu')">＋</button>
      </div>
    </div>

    <button class="btn btn-light w-100 mb-2" onclick="toggleDetail('kipasDetail')">Kipas Angin</button>
    <div id="kipasDetail" class="card p-3 mb-3 d-none">
      <label class="mb-1">Jumlah kipas angin?</label>
      <div class="input-group mb-2">
        <button class="btn btn-outline-secondary" onclick="decrement('kipasCount')">−</button>
        <input type="number" id="kipasCount" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('kipasCount')">＋</button>
      </div>
      <label class="mb-1">Berapa jam digunakan per hari?</label>
      <div class="input-group">
        <button class="btn btn-outline-secondary" onclick="decrement('jamKipas')">−</button>
        <input type="number" id="jamKipas" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('jamKipas')">＋</button>
      </div>
    </div>

    <button class="btn btn-light w-100 mb-2" onclick="toggleDetail('acDetail')">AC</button>
    <div id="acDetail" class="card p-3 mb-3 d-none">
      <label class="mb-1">Jumlah AC?</label>
      <div class="input-group mb-2">
        <button class="btn btn-outline-secondary" onclick="decrement('acCount')">−</button>
        <input type="number" id="acCount" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('acCount')">＋</button>
      </div>
      <label class="mb-1">Berapa jam digunakan per hari?</label>
      <div class="input-group">
        <button class="btn btn-outline-secondary" onclick="decrement('jamAc')">−</button>
        <input type="number" id="jamAc" class="form-control text-center" value="0" min="0">
        <button class="btn btn-outline-secondary" onclick="increment('jamAc')">＋</button>
      </div>
    </div>
  </div>

  <div class="sticky-footer">
  <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=rumah')">←</button>
    <div class="text-center">
      <strong>Total Emisi</strong><br><span id="footerTotalEmission">0.00 Ton CO2/Tahun</span>
    </div>
    <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=makanan')">→</button>
  </div>

</body>
</html>
