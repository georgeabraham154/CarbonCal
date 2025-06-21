// carboncal-api/routes/carbonRoutes.js
const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise'); // Pastikan menggunakan mysql2/promise

// Ambil konfigurasi database dari environment variables
const pool = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

/**
 * Replikasi dari CarbonModel.class.php -> saveCarbonRecord()
 * Menyimpan catatan emisi karbon baru ke database.
 *
 * PHP Input:
 * public function saveCarbonRecord($userId, $recordDate, $transportEmission, $householdEmission, $applianceEmission, $foodEmission, $totalEmission)
 *
 * NodeJS API:
 * HTTP Method: POST
 * Endpoint: /api/carbon-records
 * Request Body (JSON):
 * {
 * "user_id": 1,
 * "record_date": "YYYY-MM-DD",
 * "transport_emission": 0.0,
 * "household_emission": 0.0,
 * "appliance_emission": 0.0,
 * "food_emission": 0.0,
 * "total_emission": 0.0
 * }
 * Return Value (JSON): { "success": true, "message": "Catatan emisi berhasil disimpan!", "recordId": 123 }
 * Atau: { "success": false, "message": "Gagal menyimpan catatan emisi." }
 */
router.post('/carbon-records', async (req, res) => {
    const {
        user_id,
        record_date,
        transport_emission,
        household_emission,
        appliance_emission,
        food_emission,
        total_emission
    } = req.body; // Ambil data dari body request

    // Validasi input (opsional tapi sangat disarankan)
    if (!user_id || !record_date || typeof transport_emission === 'undefined' || typeof household_emission === 'undefined' || typeof appliance_emission === 'undefined' || typeof food_emission === 'undefined' || typeof total_emission === 'undefined') {
        return res.status(400).json({ success: false, message: 'Semua field emisi diperlukan.' });
    }

    let connection;
    try {
        connection = await pool.getConnection();
        const sql = `INSERT INTO carbon_records (user_id, record_date, transport_emission, household_emission, appliance_emission, food_emission, total_emission)
                     VALUES (?, ?, ?, ?, ?, ?, ?)`;

        const [result] = await connection.execute(
            sql,
            [user_id, record_date, transport_emission, household_emission, appliance_emission, food_emission, total_emission]
        );

        // Periksa apakah ada baris yang terpengaruh (artinya insert berhasil)
        if (result.affectedRows > 0) {
            res.status(201).json({ success: true, message: 'Catatan emisi berhasil disimpan!', recordId: result.insertId });
        } else {
            res.status(500).json({ success: false, message: 'Gagal menyimpan catatan emisi. Tidak ada baris yang terpengaruh.' });
        }
    } catch (error) {
        console.error('Error saat menyimpan catatan emisi:', error);
        res.status(500).json({ success: false, message: 'Gagal menyimpan catatan emisi.', error: error.message });
    } finally {
        if (connection) connection.release(); // Pastikan koneksi dilepaskan
    }
});

/**
 * Replikasi dari CarbonModel.class.php -> getCarbonRecordsByUserId()
 * Mendapatkan semua catatan emisi karbon untuk pengguna tertentu.
 *
 * PHP Input:
 * public function getCarbonRecordsByUserId($userId)
 *
 * NodeJS API:
 * HTTP Method: GET
 * Endpoint: /api/carbon-records/user/:userId
 * Parameters: userId (path parameter)
 * Return Value (JSON Array): [{id: 1, user_id: 1, record_date: "...", transport_emission: "...", ...}]
 * Atau: { "success": false, "message": "Gagal mengambil catatan emisi." }
 */
router.get('/carbon-records/user/:userId', async (req, res) => {
    const userId = req.params.userId; // Ambil userId dari URL parameter

    let connection;
    try {
        connection = await pool.getConnection();
        const sql = "SELECT * FROM carbon_records WHERE user_id = ? ORDER BY record_date DESC";
        const [rows] = await connection.execute(sql, [userId]);

        if (rows.length > 0) {
            res.status(200).json({ success: true, data: rows });
        } else {
            res.status(404).json({ success: false, message: 'Tidak ada catatan emisi ditemukan untuk pengguna ini.' });
        }
    } catch (error) {
        console.error('Error saat mengambil catatan emisi:', error);
        res.status(500).json({ success: false, message: 'Gagal mengambil catatan emisi.', error: error.message });
    } finally {
        if (connection) connection.release();
    }
});

/**
 * Replikasi dari CarbonModel.class.php -> getTotalCarbonEmission()
 * Mendapatkan total emisi karbon untuk pengguna tertentu.
 *
 * PHP Input:
 * public function getTotalCarbonEmission($userId)
 *
 * NodeJS API:
 * HTTP Method: GET
 * Endpoint: /api/carbon-records/total/:userId
 * Parameters: userId (path parameter)
 * Return Value (JSON): { "success": true, "total_emission": 123.45 }
 * Atau: { "success": false, "message": "Gagal menghitung total emisi." }
 */
router.get('/carbon-records/total/:userId', async (req, res) => {
    const userId = req.params.userId;

    let connection;
    try {
        connection = await pool.getConnection();
        const sql = "SELECT SUM(total_emission) as total FROM carbon_records WHERE user_id = ?";
        const [rows] = await connection.execute(sql, [userId]);

        const totalEmission = rows[0].total ? parseFloat(rows[0].total) : 0.00;
        res.status(200).json({ success: true, total_emission: totalEmission });
    } catch (error) {
        console.error('Error saat menghitung total emisi:', error);
        res.status(500).json({ success: false, message: 'Gagal menghitung total emisi.', error: error.message });
    } finally {
        if (connection) connection.release();
    }
});

module.exports = router; // Ekspor router agar bisa digunakan di server.js