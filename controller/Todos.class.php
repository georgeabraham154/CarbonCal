<?php

// Memastikan kelas Controller dasar sudah dimuat
require_once('Controller.class.php');
// Memastikan CarbonModel sudah dimuat
require_once('model/CarbonModel.class.php');
// Memastikan TodoModel sudah dimuat (jika masih diperlukan untuk fitur terkait 'todos')
require_once('model/TodoModel.class.php');


class Todos extends Controller {

    // Method untuk halaman utama CarbonCal (index.php di root)
    function index() {
        // Asumsi 'index.php' di root adalah halaman utama Anda, bukan di folder view
        $this->loadView('index.php');
    }

    // Method untuk halaman form Carbon Calculator
    function form() {
        $this->loadView('form.php');
    }

    // Method untuk halaman Transportasi
    function transport() {
        $this->loadView('transportasi.php');
    }

    // Method untuk halaman Rumah Tangga
    function rumah() {
        $this->loadView('rumahtangga.php');
    }

    // Method untuk halaman Peralatan Rumah
    function peralatan() {
        $this->loadView('peralatanrumah.php');
    }

    // Method untuk halaman Makanan
    function makanan() {
        // Jika ada model khusus makanan/kalori, bisa diimplementasikan di sini.
        // Untuk saat ini, hanya memuat view.
        $this->loadView('makanan.php');
    }

    // Method untuk halaman Hasil perhitungan emisi
    function hasil() {
        // Pastikan session sudah dimulai jika Anda menggunakan $_SESSION['user_id']
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $carbonModel = $this->loadModel('CarbonModel');

        // PENTING: userId harus didapatkan dari sesi setelah user login.
        // Untuk tujuan pengembangan, menggunakan ID dummy 1.
        $userId = $_SESSION['user_id'] ?? 1;

        $recordDate = date('Y-m-d');

        // Ambil data emisi dari $_POST
        $transportEmission = (float)($_POST['transport_emission'] ?? 0.00);
        $householdEmission = (float)($_POST['household_emission'] ?? 0.00);
        $applianceEmission = (float)($_POST['appliance_emission'] ?? 0.00);
        $foodEmission = (float)($_POST['food_emission'] ?? 0.00);
        $totalEmission = (float)($_POST['total_emission'] ?? 0.00); // Total dari JS / form

        // Simpan data ke database melalui CarbonModel
        $saveSuccess = $carbonModel->saveCarbonRecord(
            $userId,
            $recordDate,
            $transportEmission,
            $householdEmission,
            $applianceEmission,
            $foodEmission,
            $totalEmission
        );

        $message = '';
        if ($saveSuccess) {
            $message = "Catatan emisi berhasil disimpan!";
        } else {
            $message = "Gagal menyimpan catatan emisi. Error: " . $carbonModel->db->error;
            error_log("Database Save Error: " . $carbonModel->db->error);
        }

        // Dapatkan data emisi terbaru dan total keseluruhan dari database untuk ditampilkan
        $latestRecords = $carbonModel->getCarbonRecordsByUserId($userId);
        $overallTotalEmission = $carbonModel->getTotalCarbonEmission($userId); // Total kumulatif

        // Kirim data ke View
        $data = [
            'message' => $message,
            'totalEmission' => $totalEmission, // Ini adalah total emisi untuk record yang baru saja disimpan
            'overallTotalEmission' => $overallTotalEmission, // Ini adalah total emisi kumulatif dari semua record
            'latestRecords' => $latestRecords
        ];

        $this->loadView('hasil.php', $data);
    }

    // Method untuk halaman menu Carbon Track (Menu.php)
    function menu() {
        $this->loadView("Menu.php");
    }

    // Method untuk halaman Leaderboard
    function leaderboard() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $carbonModel = $this->loadModel('CarbonModel');
        $leaderboardData = $carbonModel->getCarbonLeaderboard(); // Ambil data leaderboard

        // Mengambil data rank pengguna saat ini
        $userId = $_SESSION['user_id'] ?? null; // Gunakan null jika tidak ada user ID
        $my_rank = [];

        if ($userId) {
            // Loop untuk menemukan rank pengguna saat ini dari data leaderboard
            foreach ($leaderboardData as $entry) {
                if (isset($entry['user_id']) && $entry['user_id'] == $userId) {
                    $my_rank = $entry;
                    break;
                }
            }
        }
        
        $this->loadView('leaderboard.php', [
            'leaderboard' => $leaderboardData,
            'my_rank' => $my_rank
        ]);
    }

    // Method untuk halaman Riwayat Emisi
    function riwayatEmisi() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $carbonModel = $this->loadModel('CarbonModel');
        $userId = $_SESSION['user_id'] ?? 1;
        $carbon_records = $carbonModel->getCarbonRecordsByUserId($userId); // Memanggil fungsi dari CarbonModel
        $this->loadView("riwayatEmisi.php", ['carbon_records' => $carbon_records]);
    }

    // Method untuk halaman Kurangi Emisi
    function kurangiEmisi() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $carbonModel = $this->loadModel('CarbonModel');
        $userId = $_SESSION['user_id'] ?? 1;
        $totalEmission = $carbonModel->getLatestTotalEmissionForUserId($userId); // Memanggil fungsi dari CarbonModel
        $this->loadView('kurangiEmisi.php', ['total_emission' => $totalEmission]);
    }
    
    // Method untuk menghapus emisi karbon
    public function hapusEmisi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $deleteId = (int)$_POST['delete_id'];
            $carbonModel = $this->loadModel('CarbonModel');
            
            if ($carbonModel->deleteCarbonRecord($deleteId)) {
                // Berhasil dihapus, redirect kembali ke riwayat emisi
                header('Location: index.php?c=Todos&m=riwayatEmisi');
                exit;
            } else {
                // Gagal menghapus
                echo "Gagal menghapus data emisi karbon.";
                error_log("Failed to delete carbon record with ID: " . $deleteId . " Error: " . $carbonModel->db->error);
            }
        } else {
            // Jika tidak ada ID atau bukan POST request, redirect
            header('Location: index.php?c=Todos&m=riwayatEmisi');
            exit;
        }
    }
}