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
        $sql = "INSERT INTO carbon_records (user_id, record_date, transport_emission, household_emission, appliance_emission, food_emission, total_emission)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            error_log("Failed to prepare statement for saveCarbonRecord: " . $this->db->error);
            return false;
        }

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

        $result = $stmt->execute();
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
        $sql = "SELECT * FROM carbon_records WHERE user_id = ? ORDER BY record_date DESC";

        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for getCarbonRecordsByUserId: " . $this->db->error);
            return [];
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $records;
    }

    /**
     * Mendapatkan total emisi karbon kumulatif untuk pengguna tertentu.
     *
     * @param int $userId ID pengguna.
     * @return float Total emisi karbon.
     */
    public function getTotalCarbonEmission($userId) {
        $sql = "SELECT SUM(total_emission) as total FROM carbon_records WHERE user_id = ?";

        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for getTotalCarbonEmission: " . $this->db->error);
            return 0.00;
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return (float) ($row['total'] ?? 0.00);
    }

    /**
     * Mendapatkan total emisi terbaru (dari record terakhir) untuk pengguna tertentu.
     * Ini digunakan untuk halaman "Kurangi Emisi".
     *
     * @param int $userId ID pengguna.
     * @return float Total emisi dari record terakhir.
     */
    public function getLatestTotalEmissionForUserId($userId) {
        $sql = "SELECT total_emission FROM carbon_records WHERE user_id = ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for getLatestTotalEmissionForUserId: " . $this->db->error);
            return 0.00;
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return (float) ($row['total_emission'] ?? 0.00);
    }

    /**
     * Mendapatkan data leaderboard (emisi tahunan terendah).
     * Diasumsikan 'leaderboard' adalah tabel yang sudah ada atau Anda menghitungnya dari 'carbon_records'.
     * Jika dari 'carbon_records', diperlukan join dengan tabel 'users' untuk mendapatkan nama.
     *
     * @return array Array asosiatif dari data leaderboard, termasuk 'rank' dan 'user_id'.
     */
    public function getCarbonLeaderboard() {
        // Contoh: Mengambil total emisi kumulatif per user dari carbon_records dan mengurutkan
        // Anda perlu JOIN dengan tabel user untuk mendapatkan nama pengguna
        $sql = "SELECT u.id as user_id, u.nama, SUM(cr.total_emission) as emisi_tahunan
                FROM carbon_records cr
                JOIN users u ON cr.user_id = u.id
                GROUP BY cr.user_id, u.nama
                ORDER BY emisi_tahunan ASC"; // ASC untuk emisi terendah pertama

        $result = $this->db->query($sql);
        if ($result === false) {
            error_log("Failed to execute query for getCarbonLeaderboard: " . $this->db->error);
            return [];
        }

        $leaderboard = $result->fetch_all(MYSQLI_ASSOC);
        // Menambahkan rank secara manual setelah query
        foreach ($leaderboard as $key => $row) {
            $leaderboard[$key]['rank'] = $key + 1;
        }
        return $leaderboard;
    }


    /**
     * Menghapus catatan emisi berdasarkan ID.
     *
     * @param int $id ID catatan emisi yang akan dihapus.
     * @return bool True jika berhasil, False jika gagal.
     */
    public function deleteCarbonRecord($id) {
        $sql = "DELETE FROM carbon_records WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for deleteCarbonRecord: " . $this->db->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}