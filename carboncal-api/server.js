// carboncal-api/server.js
require('dotenv').config(); // Load environment variables from .env file
const express = require('express');
const mysql = require('mysql2/promise'); // Use promise-based version for async/await
const app = express();
const port = 3000;

// Middleware untuk parse JSON bodies dari request
app.use(express.json());

// Middleware CORS untuk mengizinkan permintaan dari browser (penting untuk demo klien)
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*'); // Izinkan semua origin untuk kemudahan demo
    res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    next();
});

// Database connection pool
const pool = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Test koneksi DB
pool.getConnection()
    .then(connection => {
        console.log('Terhubung ke database MySQL!');
        connection.release(); // Lepaskan koneksi setelah pengujian
    })
    .catch(err => {
        console.error('Gagal terhubung ke database:', err.message);
    });

// Impor router API (akan kita buat di langkah berikutnya)
const carbonRoutes = require('./routes/carbonRoutes'); // Akan kita buat file ini

// Gunakan router API
app.use('/api', carbonRoutes); // Semua endpoint akan diawali dengan /api

// Error handling middleware
app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).json({ success: false, message: 'Terjadi kesalahan server.' });
});

// Mulai server Express
app.listen(port, () => {
    console.log(`Server CarbonCal API berjalan di http://localhost:${port}`);
});