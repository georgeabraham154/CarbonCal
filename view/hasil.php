<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Emisi Karbon</title>
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
        .menu-dropdown.show {
            display: block;
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
        .emission-result {
          background-color: #ffffff; /* Latar putih bersih */
          border-radius: 15px;
          padding: 30px;
          margin: 20px auto; /* Tengahkan */
          text-align: center;
          box-shadow: 0 5px 15px rgba(0,0,0,0.08); /* Bayangan lebih halus */
          max-width: 700px; /* Batasi lebar */
        }
        .total-emission {
          font-size: 3.5rem; /* Lebih besar */
          font-weight: bold;
          color: #2e8b57; /* Hijau utama */
          margin: 20px 0;
          text-shadow: 1px 1px 3px rgba(0,0,0,0.1); /* Sedikit bayangan teks */
        }
        .progress {
            height: 25px; /* Lebih tinggi */
            border-radius: 12px; /* Lebih membulat */
            background-color: #e0e0e0; /* Warna latar progress bar */
        }
        .progress-bar {
            background-color: #4caf50; /* Hijau cerah */
            border-radius: 12px;
        }
        .lead {
            color: #666;
            font-size: 1.1em;
        }
        .bg-light.p-4.rounded-lg.text-center.mb-8 { /* Untuk total keseluruhan */
            background-color: #e6ffe6 !important; /* Latar hijau muda */
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            padding: 25px !important;
        }
        .bg-light.p-4.rounded-lg.text-center.mb-8 p {
            color: #1a4d2e; /* Teks hijau tua */
        }
        .bg-light.p-4.rounded-lg.text-center.mb-8 .text-4xl {
            color: #2e8b57; /* Warna total emisi */
            font-size: 3.2rem; /* Ukuran lebih besar */
        }
        .table-responsive {
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            overflow: hidden; /* Pastikan sudut tabel ikut membulat */
        }
        .table {
            margin-bottom: 0; /* Hapus margin bawah default tabel */
        }
        .table thead th {
            background-color: #1a4d2e; /* Header tabel hijau tua */
            color: #e6ffe6;
            border-bottom: none;
            padding: 15px;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: #f8fcf8; /* Warna stripe */
        }
        .table tbody tr:hover {
            background-color: #e6ffe6; /* Hover hijau muda */
        }
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #444;
        }
        .recommendation-card {
          border-left: 8px solid #4caf50; /* Border lebih tebal */
          border-radius: 12px; /* Sudut lebih membulat */
          margin-bottom: 20px;
          background-color: #ffffff;
          box-shadow: 0 2px 8px rgba(0,0,0,0.05);
          transition: transform 0.2s ease;
        }
        .recommendation-card:hover {
            transform: translateY(-3px);
        }
        .recommendation-card h5 {
            color: #2e8b57;
            font-weight: 600;
        }
        .recommendation-card p {
            color: #777;
        }
        .btn-primary {
            background-color: #2e8b57;
            border-color: #2e8b57;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
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
</head>
<body class="bg-light">
      <?php @include "header.php";?>

  <div class="container my-5">
    <div class="emission-result">
      <h2 class="mb-4">Total Emisi Karbon Kamu</h2>
      <div class="total-emission" id="total-emisi">
          <?php echo number_format($totalEmission, 2); ?> Ton CO2/Tahun
      </div>

      <div class="progress mb-4" style="height: 20px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
      </div>

      <p class="lead">Kamu menghasilkan emisi 15% lebih rendah dari rata-rata orang di daerahmu!</p>
    </div>

    <div class="bg-light p-4 rounded-lg text-center mb-8">
        <p class="text-xl font-semibold text-gray-700">Total Keseluruhan Emisi Tercatat:</p>
        <p class="text-4xl font-bold text-purple-700 mt-2">
            <?php echo number_format($overallTotalEmission, 2); ?> Ton CO2
        </p>
    </div>

    <div class="mt-5">
      <h4 class="mb-4">Riwayat Emisi Terbaru</h4>
      <?php if (!empty($latestRecords)): ?>
          <div class="table-responsive">
              <table class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th>Tanggal</th>
                          <th>Transportasi</th>
                          <th>Rumah Tangga</th>
                          <th>Peralatan</th>
                          <th>Makanan</th>
                          <th>Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($latestRecords as $record): ?>
                          <tr>
                              <td><?php echo htmlspecialchars($record['record_date']); ?></td>
                              <td><?php echo number_format($record['transport_emission'], 2); ?></td>
                              <td><?php echo number_format($record['household_emission'], 2); ?></td>
                              <td><?php echo number_format($record['appliance_emission'], 2); ?></td>
                              <td><?php echo number_format($record['food_emission'], 2); ?></td>
                              <td><?php echo number_format($record['total_emission'], 2); ?></td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
          </div>
      <?php else: ?>
          <p class="text-center text-muted">Belum ada catatan emisi yang disimpan.</p>
      <?php endif; ?>
    </div>

    <div class="mt-5">
      <h4 class="mb-4">Rekomendasi Pengurangan Emisi</h4>

      <div class="card recommendation-card">
        <div class="card-body">
          <h5>💡 Ganti ke Lampu LED</h5>
          <p>Dapat mengurangi emisi hingga 0.2 Ton/tahun</p>
        </div>
      </div>

      <div class="card recommendation-card">
        <div class="card-body">
          <h5>🚗 Kurangi Penggunaan Mobil Pribadi</h5>
          <p>Beralih ke transportasi umum 2x seminggu bisa mengurangi 0.5 Ton/tahun</p>
        </div>
      </div>

      <div class="text-center mt-5">
      <button class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=form'">
          <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
        </button>
      </div>
    </div>
  </div>

  <footer>
    <div>© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fungsi Navigasi
    function toggleMenu() {
      document.getElementById("menuDropdown").classList.toggle("show");
    }

    function goBack() {
      window.history.back();
    }

    function navigate(to) {
      window.location.href = to;
    }
  </script>
</body>
</html>
