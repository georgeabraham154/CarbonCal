<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kurangi Emisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <?php @include "header.php";?>
  <style>
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

    footer {
            background-color: #1a4d2e !important;
            color: #e6ffe6;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;}
  </style>
</head>

<body class="bg-light">

  <div class="container py-4">
    <div class="text-center mb-4">
      <h1 class="fw-bold">Kurangi Emisi Karbonmu!</h1>
    </div>

    <div class="card mb-4 p-4 text-center">
      <h5 class="fw-bold mb-3">Tips & Trik Mengurangi Emisi Karbon</h5>
      <ul class="fs-6">
        <li>Gunakan transportasi umum, sepeda, atau berjalan kaki dibanding kendaraan pribadi.</li>
        <li>Kurangi konsumsi listrik dengan mematikan alat elektronik saat tidak digunakan.</li>
        <li>Pilih makanan lokal dan nabati yang jejak karbonnya lebih rendah.</li>
        <li>Kurangi penggunaan plastik sekali pakai dan lebih banyak mendaur ulang.</li>
        <li>Gunakan energi terbarukan jika tersedia, seperti panel surya di rumah.</li>
      </ul>
      <h5 class="fw-bold mb-3">Bagaimana Fitur Ini Bekerja?</h5>
      <p class="fs-6">
        Kamu dapat memasukkan target pengurangan emisi karbon tahunanmu pada form di bawah.
        Sistem akan membandingkan target tersebut dengan jumlah emisi karbonmu saat ini.
        <strong>Jika targetmu lebih kecil dari emisi saat ini</strong>, maka selamat!
        Kamu dianggap berhasil mengurangi emisi dan akan mendapatkan notifikasi sukses.
        Sebaliknya, jika <strong>targetmu masih lebih tinggi atau sama dengan emisi saat ini</strong>,
        maka sistem akan menampilkan notifikasi bahwa target belum tercapai.
      </p>
      <p class="fs-6 mb-0">
        Fitur ini membantumu untuk terus termotivasi dalam menurunkan jejak karbon secara bertahap.
      </p>
    </div>

    <div class="card mb-4 p-4 text-center">
      <span class="fs-5">Emisi Karbonmu saat ini:</span>
      <span class="fs-4 fw-semibold text-danger" id="emisi-angka">
          <?php echo number_format($total_emission, 2); ?> ton CO<sub>2</sub>
      </span>
    </div>

    <div class="mb-3 text-center">
      <form id="targetForm" class="row justify-content-center">
        <div class="col-md-6 mb-3">
          <input type="number" id="targetInput" name="minemisi" class="form-control form-control-lg" placeholder="Masukkan target anda!" required />
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-green px-4">submit</button>
        </div>
      </form>
    </div>
  </div>

  <!-- pop up Sukses -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <h5 class="modal-title mb-3" id="successModalLabel">🎉 Target Berhasil Dicapai!</h5>
        <p class="mb-4">Keren banget! Kamu berhasil mencapai target pengurangan emisi karbon.</p>
        <a href="?c=Todos&m=leaderboard" class="btn btn-green">Lihat Leaderboard</a>
      </div>
    </div>
  </div>

  <!-- pop up Gagal -->
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

      if (target > currentEmission) {
        new bootstrap.Modal(document.getElementById("successModal")).show();
      } else {
        new bootstrap.Modal(document.getElementById("failedModal")).show();
      }
    });
  </script>
</body>

<footer class="bg-green text-white mt-5 py-4">
  <div class="container text-center">
    <p class="mb-2">© 2025 CarbonCal. Kelompok 7 Pemrograman Web.</p>
  </div>
</footer>

</html>