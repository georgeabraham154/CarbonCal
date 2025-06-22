<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Emisi Karbon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-dropdown {
            display: none;
            position: fixed;
            right: 10px;
            top: 60px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            z-index: 1050;
        }
        .menu-dropdown button {
            display: block;
            width: 100%;
            background: none;
            border: none;
            padding: 10px;
            text-align: left;
        }
        .menu-dropdown button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-light">
      <?php @include "header.php";?>

  <div class="container my-5">
    <h2 class="mb-4 text-center">Riwayat Emisi Karbon</h2>

    <?php if (!empty($records)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Transportasi</th>
                        <th>Rumah Tangga</th>
                        <th>Peralatan</th>
                        <th>Makanan</th>
                        <th>Total Emisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['record_date']); ?></td>
                            <td><?php echo number_format($record['transport_emission'], 2); ?></td>
                            <td><?php echo number_format($record['household_emission'], 2); ?></td>
                            <td><?php echo number_format($record['appliance_emission'], 2); ?></td>
                            <td><?php echo number_format($record['food_emission'], 2); ?></td>
                            <td><?php echo number_format($record['total_emission'], 2); ?> Ton CO2</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Belum ada riwayat emisi yang tercatat.</p>
    <?php endif; ?>

    <div class="text-center mt-5">
      <button class="btn btn-primary" onclick="window.location.href='index.php?c=Todos&m=menu'">
          Kembali ke Menu
        </button>
    </div>
  </div>

  <footer class="bg-dark text-white py-3 text-center mt-5">
    <div>© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fungsi untuk toggle menu dropdown
    function toggleMenu() {
      let menu = document.getElementById("menuDropdown");
      menu.style.display = menu.style.display === "block" ? "none" : "block";
    }

    // Fungsi untuk kembali ke halaman sebelumnya
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
