<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Emisi Karbon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f0f2f5; /* Warna latar belakang lembut */
    }
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
        min-width: 200px;
    }
    .menu-dropdown a {
        padding: 8px 10px;
        display: block;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
    }
    .menu-dropdown a:hover {
        background-color: #f0f0f0;
    }
    .footer {
        background-color: #1a4d2e;
        color: #e6ffe6;
        padding: 20px 0;
        text-align: center;
    }
    .emission-card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      padding: 1rem 1.5rem;
      background-color: #fff;
    }
    .bg-green { /* This seems to be a custom class from your friend's code. I'll keep it as is, but primary colors are defined above. */
      background-color: #28a745;
      color: white;
    }
    .btn-green { /* This seems to be a custom class from your friend's code. I'll keep it as is, but primary colors are defined above. */
      background-color: #28a745;
      color: white;
      border-radius: 0.8rem;
      border: none;
    }
    .btn-green:hover {
      background-color: #218838;
    }
    .table-responsive {
        margin-top: 20px;
    }
    .table thead th {
        background-color: #1a4d2e; /* Changed to match primary color */
        color: white;
        border-color: #1a4d2e; /* Changed to match primary color */
    }
    .table tbody tr:nth-of-type(odd) {
        background-color: #f8fcf8;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }
    .text-green { /* Kept for text styling */
        color: #28a745;
    }
  </style>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">CarbonCal</a>
          <div class="d-flex align-items-center">
              <div id="menuToggle" style="cursor: pointer;">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Hamburger_icon.svg" alt="Menu" width="30" height="30" style="filter: invert(100%);">
              </div>
          </div>
          <div class="menu-dropdown" id="menuDropdown">
              <a href="index.php?c=Todos&m=index" class="btn">🏠 Home</a>
              <a href="index.php?c=Todos&m=form" class="btn">♻️ Carbon Calculator</a>
              <a href="index.php?c=Todos&m=menu" class="btn">🌍 Carbon Track</a>
          </div>
      </div>
  </nav>

  <main class="container my-5">
    <h2 class="text-center mb-4 text-green">Riwayat Emisi Karbon Anda</h2>

    <div class="emission-card mb-4">
      <p class="text-center text-muted">Berikut adalah catatan emisi karbon Anda dari waktu ke waktu.</p>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Transportasi (Ton)</th>
            <th>Rumah Tangga (Ton)</th>
            <th>Peralatan (Ton)</th>
            <th>Makanan (Ton)</th>
            <th>Total (Ton)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($carbon_records)): ?>
            <?php foreach ($carbon_records as $emisi): ?>
              <tr>
                <td><?php echo date("d/m/Y", strtotime($emisi['record_date'])); ?></td>
                <td><?php echo number_format($emisi['transport_emission'], 2); ?></td>
                <td><?php echo number_format($emisi['household_emission'], 2); ?></td>
                <td><?php echo number_format($emisi['appliance_emission'], 2); ?></td>
                <td><?php echo number_format($emisi['food_emission'], 2); ?></td>
                <td><?php echo number_format($emisi['total_emission'], 2); ?> ton CO<sub>2</sub></td>
                <td>
                  <form method="POST" action="index.php?c=Todos&m=hapusEmisi" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <input type="hidden" name="delete_id" value="<?php echo $emisi['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center text-muted">Belum ada riwayat emisi karbon yang tercatat.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="footer mt-5">
    <div class="container text-center">
      <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
      document.getElementById('menuToggle').addEventListener('click', function() {
          var dropdown = document.getElementById('menuDropdown');
          if (dropdown.style.display === 'block') {
              dropdown.style.display = 'none';
          } else {
              dropdown.style.display = 'block';
          }
      });

      // Close the dropdown if the user clicks outside of it
      window.addEventListener('click', function(event) {
          var dropdown = document.getElementById('menuDropdown');
          var toggle = document.getElementById('menuToggle');
          if (!event.target.closest('#menuToggle') && !event.target.closest('#menuDropdown')) {
              if (dropdown.style.display === 'block') {
                  dropdown.style.display = 'none';
              }
          }
      });
  </script>
</body>
</html>