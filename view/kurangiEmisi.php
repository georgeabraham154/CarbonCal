<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kurangi Emisi</title>
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
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .input-group input {
      border-radius: 1.5rem;
    }
    .btn {
      border-radius: 1rem;
    }
    .btn-outline-light {
      border-radius: 0.3rem;
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
    /* Styles untuk modal */
    .modal-content {
      border-radius: 1rem;
    }
    .modal-header {
      border-bottom: none;
    }
    .modal-footer {
      border-top: none;
    }
    .btn-close {
      color: #000; /* Warna ikon close */
      opacity: 0.7;
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
    <h2 class="text-center mb-4 text-green">Kurangi Emisi Karbon Anda</h2>

    <div class="card p-4 mb-4 text-center">
      <div class="card-body">
        <p class="mb-2 text-muted">Total emisi karbon Anda saat ini:</p>
        <h3 class="fw-bold text-green"><?php echo number_format($total_emission, 2); ?> Ton CO<sub>2</sub>/Tahun</h3>
      </div>
    </div>

    <div class="card p-4 mb-4">
      <h4 class="mb-3 text-center">Tetapkan Target Pengurangan Emisi</h4>
      <form id="targetForm">
        <div class="input-group mb-3">
          <input type="number" step="0.01" class="form-control" id="targetInput" placeholder="Masukkan target emisi (ton CO2/tahun)" required />
          <button class="btn btn-green" type="submit">Tetapkan Target</button>
        </div>
      </form>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <h5 class="modal-title mb-3" id="successModalLabel">🎉 Target Berhasil Tercapai!</h5>
        <p class="mb-4">Selamat! Kamu berhasil mencapai target pengurangan emisi karbonmu. Terus semangat ya! 💪</p>
        <button class="btn btn-green" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="failedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <h5 class="modal-title mb-3" id="failedModalLabel">⚠️ Target Belum Tercapai</h5>
        <p class="mb-4">Semangat terus ya! Yuk kurangi emisi karbonmu lebih banyak lagi 💪</p>
        <button class="btn btn-green" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Tampilkan kembali target tersimpan di input
    const currentEmission = <?php echo $total_emission; ?>;

    window.addEventListener("DOMContentLoaded", () => {
      const savedTarget = localStorage.getItem("targetEmisi");
      if (savedTarget) {
        document.getElementById("targetInput").value = savedTarget;
      }
    });

    // Form submit handler
    document.getElementById("targetForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const target = parseFloat(document.getElementById("targetInput").value);
      localStorage.setItem("targetEmisi", target);

      if (target < currentEmission) {
        new bootstrap.Modal(document.getElementById("successModal")).show();
      } else {
        new bootstrap.Modal(document.getElementById("failedModal")).show();
      }
    });
  </script>
</body>

<footer class="footer mt-5">
    <div class="container text-center">
        <p class="mb-0">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
    </div>
</footer>
</html>