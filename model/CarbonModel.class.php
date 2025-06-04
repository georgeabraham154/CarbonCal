<?php

// Memastikan kelas Model dasar sudah dimuat
require_once('Model.class.php');

class CarbonModel extends Model {

    /**
     * Menyimpan catatan emisi karbon baru ke database.
     *
     * @param int $userId ID pengguna yang mencatat emisi.
     * @param string $recordDate Tanggal pencatatan emisi (format YYYY-MM-DD).
     * @param float $transportEmission Emisi dari transportasi.
     * @param float $householdEmission Emisi dari rumah tangga.
     * @param float $applianceEmission Emisi dari peralatan.
     * @param float $foodEmission Emisi dari makanan.
     * @param float $totalEmission Total emisi gabungan.
     * @return bool True jika berhasil, False jika gagal.
     */
    public function saveCarbonRecord(
        $userId,
        $recordDate,
        $transportEmission,
        $householdEmission,
        $applianceEmission,
        $foodEmission,
        $totalEmission
    ) {
        // Query SQL untuk memasukkan data ke tabel carbon_records
        $sql = "INSERT INTO carbon_records (user_id, record_date, transport_emission, household_emission, appliance_emission, food_emission, total_emission)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Menggunakan prepared statement untuk mencegah SQL Injection
        $stmt = $this->db->prepare($sql);

        // Memeriksa apakah prepared statement berhasil dibuat
        if ($stmt === false) {
            error_log("Failed to prepare statement: " . $this->db->error);
            return false;
        }

        // Mengikat parameter ke prepared statement
        // 'isddddd' berarti: integer, string, decimal, decimal, decimal, decimal, decimal
        $stmt->bind_param(
            'isddddd',
            $userId,
            $recordDate,
            $transportEmission,
            $householdEmission,
            $applianceEmission,
            $foodEmission,
            $totalEmission
        );

        // Menjalankan prepared statement
        $result = $stmt->execute();

        // Menutup statement
        $stmt->close();

        return $result;
    }

    /**
     * Mendapatkan semua catatan emisi karbon untuk pengguna tertentu.
     *
     * @param int $userId ID pengguna.
     * @return array Array asosiatif dari catatan emisi.
     */
    public function getCarbonRecordsByUserId($userId) {
        // Query SQL untuk mendapatkan data berdasarkan user_id
        $sql = "SELECT * FROM carbon_records WHERE user_id = ? ORDER BY record_date DESC";

        // Menggunakan prepared statement
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement: " . $this->db->error);
            return [];
        }

        // Mengikat parameter
        $stmt->bind_param('i', $userId);

        // Menjalankan statement
        $stmt->execute();

        // Mendapatkan hasil
        $result = $stmt->get_result();

        // Mengambil semua baris sebagai array asosiatif
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Menutup statement
        $stmt->close();

        return $records;
    }

    /**
     * Mendapatkan total emisi karbon untuk pengguna tertentu.
     *
     * @param int $userId ID pengguna.
     * @return float Total emisi karbon.
     */
    public function getTotalCarbonEmission($userId) {
        // Query SQL untuk menjumlahkan total_emission untuk pengguna tertentu
        $sql = "SELECT SUM(total_emission) as total FROM carbon_records WHERE user_id = ?";

        // Menggunakan prepared statement
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement: " . $this->db->error);
            return 0.00;
        }

        // Mengikat parameter
        $stmt->bind_param('i', $userId);

        // Menjalankan statement
        $stmt->execute();

        // Mendapatkan hasil
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Menutup statement
        $stmt->close();

        return (float) $row['total'];
    }

    // Anda bisa menambahkan fungsi lain di sini, seperti:
    // - updateCarbonRecord($id, ...)
    // - deleteCarbonRecord($id)
    // - getFoodCaloriesByUserId($userId)
    // - saveFoodCalories($userId, $foodItem, $quantityGrams, $calories)
}