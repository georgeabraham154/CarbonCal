<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Emisi Karbon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    .emission-card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      padding: 1rem 1.5rem;
      background-color: #fff;
    }

    .bg-green {
      background-color: #28a745;
      color: white;
    }

    .btn-green {
      background-color: #28a745;
      color: white;
      border-radius: 0.8rem;
      border: none;
    }

    .btn-green:hover {
      background-color: #218838;
    }

    .text-green {
      color: #28a745;
    }

    .table-header-green th {
      background-color: #28a745 !important;
      color: white !important;
    }
  </style>
</head>

<body>
      <?php @include "header.php";?>

  <!-- Main content -->
  <main class="container py-5">
    <div class="text-center mb-4">
      <h1 class="fw-bold">Riwayat Emisi Karbon</h1>
    </div>

    <!-- Tabel Riwayat Emisi -->
    <div class="table-responsive ">
      <table class="table table-bordered rounded overflow-hidden border  align-middle text-center">
        <thead class="table-header-green fw-semibold fs-5">
          <tr>
            <th>Tanggal</th>
            <th>Transportasi</th>
            <th>Rumah Tangga</th>
            <th>Peralatan</th>
            <th>Makanan</th>
            <th>Total Emisi</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($carbon_records as $emisi): ?>
            <tr>
              <td><?php echo date("d/m/Y", strtotime($emisi['record_date'])); ?></td>
              <td><?php echo number_format($emisi['transport_emission'], 2); ?></td>
              <td><?php echo number_format($emisi['household_emission'], 2); ?></td>
              <td><?php echo number_format($emisi['appliance_emission'], 2); ?></td>
              <td><?php echo number_format($emisi['food_emission'], 2); ?></td>
              <td><?php echo number_format($emisi['total_emission'], 2); ?> ton CO<sub>2</sub></td>
              <td>
                <form method="POST" action="index.php?c=Todos&m=hapusEmisi" onsubmit="return confirm('Hapus data ini?');">
                  <input type="hidden" name="delete_id" value="<?php echo $emisi['id']; ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-green text-white py-4">
    <div class="container text-center">
      <p class="mb-2">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
