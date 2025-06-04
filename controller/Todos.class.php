<?php

// Memastikan kelas Controller dasar sudah dimuat
require_once('Controller.class.php');
// Memastikan CarbonModel sudah dimuat
require_once('model/CarbonModel.class.php'); // Pastikan path ini benar

class Todos extends Controller {

    // Method untuk halaman utama CarbonCal
    function index() {
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
        // Di sini Anda bisa mengambil data kalori dari model jika sudah ada
        // Contoh:
        // $foodModel = $this->loadModel('FoodModel'); // Anda perlu membuat FoodModel.class.php
        // $userId = 1; // Ganti dengan ID pengguna yang sebenarnya
        // $calorieData = $foodModel->getLatestFoodCaloriesByUserId($userId);
        // $this->loadView('makanan.php', ['calorieData' => $calorieData]);

        // Untuk saat ini, kita hanya akan memuat view.
        // Data kalori akan diambil dari sessionStorage di sisi klien oleh JavaScript di makanan.php
        $this->loadView('makanan.php');
    }

    // Method untuk halaman Hasil perhitungan emisi
    function hasil() {
        // 1. Muat CarbonModel
        $carbonModel = $this->loadModel('CarbonModel');

        // 2. Dapatkan data yang dikirim dari form (melalui POST)
        // PENTING: Dalam aplikasi nyata, userId harus didapatkan dari sesi setelah user login.
        // Untuk tujuan pengujian saat ini, kita menggunakan ID dummy 1.
        // Pastikan ada user dengan ID ini di tabel `users` database Anda.
        $userId = 1; // Ganti dengan ID pengguna yang sebenarnya (dari sesi/autentikasi)

        $recordDate = date('Y-m-d'); // Tanggal hari ini

        // --- DEBUGGING START ---
        // Tambahkan ini untuk melihat apa yang diterima oleh $_POST
        error_log("POST Data: " . print_r($_POST, true));
        // --- DEBUGGING END ---

        // Ambil data emisi dari $_POST
        $transportEmission = isset($_POST['transport_emission']) ? (float)$_POST['transport_emission'] : 0.00;
        $householdEmission = isset($_POST['household_emission']) ? (float)$_POST['household_emission'] : 0.00;
        $applianceEmission = isset($_POST['appliance_emission']) ? (float)$_POST['appliance_emission'] : 0.00;
        $foodEmission = isset($_POST['food_emission']) ? (float)$_POST['food_emission'] : 0.00;
        $totalEmission = isset($_POST['total_emission']) ? (float)$_POST['total_emission'] : 0.00; // Total dari JS

        // --- DEBUGGING START ---
        // Tambahkan ini untuk melihat nilai variabel setelah diambil dari $_POST
        error_log("Parsed Emissions: transport=" . $transportEmission . ", household=" . $householdEmission . ", appliance=" . $applianceEmission . ", food=" . $foodEmission . ", total=" . $totalEmission);
        // --- DEBUGGING END ---

        // 3. Simpan data ke database melalui Model
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
            // Menampilkan error database jika penyimpanan gagal
            $message = "Gagal menyimpan catatan emisi. Error: " . $carbonModel->db->error;
            error_log("Database Save Error: " . $carbonModel->db->error); // Log error database
        }

        // 4. Dapatkan data emisi terbaru dari database untuk ditampilkan
        // Ambil catatan terbaru untuk ditampilkan di halaman hasil
        $latestRecords = $carbonModel->getCarbonRecordsByUserId($userId);
        // Ambil total emisi keseluruhan dari database
        $overallTotalEmission = $carbonModel->getTotalCarbonEmission($userId);


        // 5. Kirim data ke View
        $data = [
            'message' => $message,
            'totalEmission' => $totalEmission, // Total yang dikirim dari JS
            'overallTotalEmission' => $overallTotalEmission, // Total keseluruhan dari DB
            'latestRecords' => $latestRecords
        ];

        $this->loadView('hasil.php', $data);
    }

    // Method untuk halaman menu Carbon Track
    function menu() {
        $this->loadView("Menu.php");
    }

    // Method untuk halaman Kurangi Emisi
    function kurangiEmisi() {
        $this->loadView("kurangiEmisi.php");
    }

    // Method untuk halaman Leaderboard
    function leaderboard() {
        // Contoh: Mengambil data leaderboard dari model
        $carbonModel = $this->loadModel('CarbonModel');
        // Anda perlu menambahkan fungsi di CarbonModel untuk mendapatkan data leaderboard
        // $leaderboardData = $carbonModel->getLeaderboardData();
        // $this->loadView("Leaderboard.php", ['leaderboardData' => $leaderboardData]);
        $this->loadView("Leaderboard.php");
    }

    // Method untuk halaman Riwayat Emisi
    function riwayatEmisi() {
        $carbonModel = $this->loadModel('CarbonModel');
        $userId = 1; // Ganti dengan ID pengguna yang sebenarnya
        $records = $carbonModel->getCarbonRecordsByUserId($userId);
        $this->loadView("riwayatEmisi.php", ['records' => $records]);
    }
}
