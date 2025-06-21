<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Leaderboard Carbon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
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
    }

    .btn-dark {
      border-radius: 0.8rem;
    }

    .bg-green {
          background-color: #28a745 ; 
          color: white ;
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
        color: #28a745 ;
    }
  </style>
</head>
<body class="bg-light">

  <nav class="navbar bg-green p-3 position-relative">
    <div class="container-fluid d-flex justify-content-between">
      <a class="navbar-brand" href="#">CarbonCal</a>
      <button class="btn btn-outline-light" onclick="toggleMenu()">☰</button>
    </div>
  </nav>

  <div class="container py-5">
    <!-- Judul -->
    <div class="text-center mb-4">
      <h1 class="fw-bold">Leaderboard</h1>
    </div>

    <!-- Rank Anda -->
    <?php
    $my_rank = isset($leaderboard[8]) ? $leaderboard[8] : null;
    ?>
    <?php if ($my_rank): ?>
      <div class="rank-card mb-4 text-center p-4">
        <div class="fw-bold ">Rank Anda</div>
        <div class="fs-3 fw-bold"><?php echo $my_rank['rank']; ?></div>
        <div class="mt-2"><?php echo $my_rank['nama']; ?></div>
        <div class="fw-semibold"><?php echo number_format($my_rank['emisi_tahunan'], 2); ?> ton CO<sub>2</sub>/tahun</div>
      </div>
    <?php else: ?>
      <div class="rank-card mb-4 text-center p-4">
        <div class="text-muted">Data rank Anda belum tersedia.</div>
      </div>
    <?php endif; ?>

    <!-- Peringkat Umum -->
    <div class="rank-card p-4 mb-4">
      <h4 class="text-center mb-3 fw-semibold">Peringkat Umum</h4>
      <?php foreach($leaderboard as $todo): ?>
        <div class="leaderboard-item mb-2">
          <div class="fw-bold"><?php echo $todo['rank']; ?></div>
          <div><?php echo $todo['nama']; ?></div>
          <div><?php echo number_format($todo['emisi_tahunan'], 1); ?> ton CO<sub>2</sub>/tahun</div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Button Riwayat -->
    <div class="text-center mt-4">
      <button class="btn btn-lg btn-green" onclick="window.location.href='?c=Todos&m=riwayatEmisi'">
        Lihat Riwayat Emisi Karbonmu!
      </button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <footer class="bg-green text-white mt-5 py-4">
    <div class="container text-center">
      <p class="mb-2">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
    </div>
  </footer>
</body>
</html>
