<?php

class Model {
    protected $db; // Properti untuk menyimpan koneksi database

    function __construct() {
        // Detail koneksi database
        $hostname = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname = 'carboncal'; // Nama database lokal saya (dody)

        // Membuat koneksi MySQLi
        $this->db = new mysqli($hostname,
        $username,
        $password,
        $dbname);

        // Menangani error koneksi database
        if (!$this->db) die('Database error!');
    }
}