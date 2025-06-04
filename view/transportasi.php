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
        .transport-btn {
            background-color: #f8fcf8;
            border-color: #e6ffe6;
            color: #1a4d2e;
            font-weight: 600;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            padding: 12px;
        }
        .transport-btn:hover {
            background-color: #e6ffe6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .transport-btn.active { /* Kelas baru untuk tombol aktif */
            background-color: #2e8b57 !important;
            border-color: #2e8b57 !important;
            color: white !important;
        }
        .transport-desc {
            background-color: #e6ffe6;
            border: 1px solid #c3e6cb;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            color: #1a4d2e;
            font-size: 0.95em;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .input-group .form-control {
            border-radius: 8px;
            border-color: #c3e6cb;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
            z-index: 0; /* Pastikan input di tengah tidak tertutup tombol */
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
    </style>
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function goBack() {
            window.history.back();
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

        // Data emisi per jenis transportasi (dummy values, sesuaikan dengan data akurat Anda)
        const transportEmissionFactors = {
            "Mobil": { description: "Mobil adalah kendaraan roda empat yang digerakkan oleh mesin.", emissionPerKm: 0.00025 }, // Ton CO2 per KM
            "Motor": { description: "Motor adalah sepeda yang dijalankan dengan tenaga mesin.", emissionPerKm: 0.00015 }, // Ton CO2 per KM
            "Bus": { description: "Bus adalah kendaraan besar yang digunakan untuk mengangkut banyak penumpang.", emissionPerKm: 0.00035 }, // Ton CO2 per KM
            "Pesawat": { description: "Pesawat adalah moda transportasi udara untuk perjalanan jarak jauh.", emissionPerKm: 0.00100 } // Ton CO2 per KM (sangat disederhanakan)
        };

        // Variabel untuk menyimpan jenis transportasi yang dipilih
        let selectedTransportType = "Motor"; // Default aktif

        function calculateTransportEmission() {
            const kmValue = parseFloat(document.getElementById('kmValue').value) || 0;
            const factor = transportEmissionFactors[selectedTransportType] ? transportEmissionFactors[selectedTransportType].emissionPerKm : 0;
            return kmValue * factor * 365; // Emisi per tahun
        }

        function updateTotalEmission() {
            let currentTotalEmission = parseFloat(sessionStorage.getItem('totalCarbonEmission')) || 0;
            const transportEmission = calculateTransportEmission();

            sessionStorage.setItem('transportEmission', transportEmission.toFixed(2));

            const householdEmission = parseFloat(sessionStorage.getItem('householdEmission')) || 0;
            const applianceEmission = parseFloat(sessionStorage.getItem('applianceEmission')) || 0;
            const foodEmission = parseFloat(sessionStorage.getItem('foodEmission')) || 0;

            currentTotalEmission = transportEmission + householdEmission + applianceEmission + foodEmission;

            document.getElementById('footerTotalEmission').textContent = `${currentTotalEmission.toFixed(2)} Ton CO2/Tahun`;
            sessionStorage.setItem('totalCarbonEmission', currentTotalEmission.toFixed(2));
        }

        // Fungsi untuk menangani klik tombol transportasi
        function selectTransportType(type, buttonElement) {
            // Hapus kelas 'active' dari semua tombol
            document.querySelectorAll('.transport-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Tambahkan kelas 'active' ke tombol yang diklik
            buttonElement.classList.add('active');

            // Perbarui jenis transportasi yang dipilih
            selectedTransportType = type;

            // Perbarui deskripsi
            document.querySelector('.transport-desc').textContent = transportEmissionFactors[type].description;

            // Perbarui total emisi
            updateTotalEmission();
        }

        window.addEventListener('DOMContentLoaded', () => {
            const storedKmValue = sessionStorage.getItem('kmValue');
            if (storedKmValue) {
                document.getElementById('kmValue').value = storedKmValue;
            }

            // Inisialisasi tombol aktif dan deskripsi berdasarkan default atau yang tersimpan
            const storedTransportType = sessionStorage.getItem('selectedTransportType');
            if (storedTransportType && transportEmissionFactors[storedTransportType]) {
                selectedTransportType = storedTransportType;
                document.querySelectorAll('.transport-btn').forEach(btn => {
                    if (btn.textContent.trim() === storedTransportType) {
                        btn.classList.add('active');
                    }
                });
                document.querySelector('.transport-desc').textContent = transportEmissionFactors[storedTransportType].description;
            } else {
                // Set default "Motor" sebagai aktif jika belum ada yang tersimpan
                document.querySelector('.transport-btn:nth-of-type(2)').classList.add('active'); // Tombol Motor
                document.querySelector('.transport-desc').textContent = transportEmissionFactors["Motor"].description;
            }


            updateTotalEmission();

            document.getElementById('kmValue').addEventListener('input', updateTotalEmission);

            // Tambahkan event listener untuk setiap tombol transportasi
            document.querySelectorAll('.transport-btn').forEach(button => {
                button.addEventListener('click', () => {
                    selectTransportType(button.textContent.trim(), button);
                });
            });
        });

        function navigateToNextPage(url) {
            sessionStorage.setItem('kmValue', document.getElementById('kmValue').value);
            sessionStorage.setItem('selectedTransportType', selectedTransportType); // Simpan jenis transportasi yang dipilih
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
    <div class="step active"></div>
    <div class="step"></div>
    <div class="step"></div>
    <div class="step"></div>
  </div>

  <main class="container text-center pb-5">
    <h2>Transportasi</h2>

    <div class="d-grid gap-2">
      <button class="btn transport-btn">Mobil</button>
      <button class="btn transport-btn">Motor</button>
      <button class="btn transport-btn">Bus</button>
      <button class="btn transport-btn">Pesawat</button>
      <div class="transport-desc">
        Motor adalah sepeda yang dijalankan dengan tenaga mesin
      </div>
    </div>

    <div class="mt-4">
      <p>Jarak Tempuh</p>
      <div class="d-flex justify-content-center align-items-center">
        <div class="input-group" style="width: 200px;">
          <button class="btn btn-outline-secondary" onclick="decrement('kmValue')">−</button>
          <input type="number" class="form-control text-center" id="kmValue" value="0" min="0">
          <button class="btn btn-outline-secondary" onclick="increment('kmValue')">＋</button>
        </div>
        <span class="ms-2">KM/Hari</span>
      </div>
    </div>
  </main>

  <div class="sticky-footer">
    <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=form')">←</button>
    <div class="text-center">
      <strong>Total Emisi</strong><br><span id="footerTotalEmission">0.00 Ton CO2/Tahun</span>
    </div>
    <button class="btn btn-primary" onclick="navigateToNextPage('index.php?c=Todos&m=rumah')">→</button>
  </div>

</body>
</html>
