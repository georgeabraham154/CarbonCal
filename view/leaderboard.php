<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Leaderboard Carbon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
    .rank-card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      background-color: #fff;
    }
    .leaderboard-item {
      display: flex;
      justify-content: space-around;
      padding: 0.75rem 1rem;
      border: 1px solid #dee2e6;
      border-radius: 0.5rem;
      background-color: #fff;
      margin-bottom: 0.5rem; /* Menambahkan sedikit margin */
    }

    .btn-dark {
      border-radius: 0.8rem;
    }

    .bg-green { /* This seems to be a custom class from your friend's code. I'll keep it as is, but primary colors are defined above. */
          background-color: #28a745 ;
          color: white ;
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

    .text-green { /* Kept for text styling */
        color: #28a745 ;
    }

    /* Style untuk my rank card */
    .my-rank-card {
        background-color: #e6ffe6; /* Latar belakang hijau muda */
        border: 2px solid #28a745; /* Border hijau tua */
        box-shadow: 0 6px 12px rgba(40, 167, 69, 0.2); /* Bayangan lebih kuat */
        color: #1a4d2e; /* Warna teks hijau tua */
    }
    .my-rank-card .rank-number {
        font-size: 2.5rem; /* Lebih besar */
        color: #1a4d2e;
    }
    .my-rank-card .fw-semibold {
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
    <h2 class="text-center mb-4 text-green">Leaderboard Emisi Karbon</h2>

    <h4 class="text-center mb-3 fw-semibold">Rank Saya</h4>
    <?php if (!empty($my_rank)): ?>
      <div class="rank-card my-rank-card mb-4 text-center p-4">
        <div class="rank-number mb-3 fw-bold"><?php echo $my_rank['rank']; ?></div>
        <div class="mt-2"><?php echo htmlspecialchars($my_rank['nama']); ?></div>
        <div class="fw-semibold"><?php echo number_format($my_rank['emisi_tahunan'], 2); ?> ton CO<sub>2</sub>/tahun</div>
      </div>
    <?php else: ?>
      <div class="rank-card mb-4 text-center p-4">
        <div class="text-muted">Data rank Anda belum tersedia. Pastikan Anda sudah masuk dan mencatat emisi.</div>
      </div>
    <?php endif; ?>

    <div class="rank-card p-4 mb-4">
      <h4 class="text-center mb-3 fw-semibold">Peringkat Umum</h4>
      <?php if (!empty($leaderboard)): ?>
        <?php foreach($leaderboard as $entry): ?>
          <div class="leaderboard-item mb-2">
            <div class="fw-bold"><?php echo $entry['rank']; ?></div>
            <div><?php echo htmlspecialchars($entry['nama']); ?></div>
            <div><?php echo number_format($entry['emisi_tahunan'], 1); ?> ton CO<sub>2</sub>/tahun</div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-muted">Belum ada data leaderboard.</p>
      <?php endif; ?>
    </div>

    <div class="text-center mt-4">
      <button class="btn btn-lg btn-green" onclick="window.location.href='index.php?c=Todos&m=riwayatEmisi'">
        Lihat Riwayat Emisi Karbonmu!
      </button>
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