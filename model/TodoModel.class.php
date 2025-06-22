<?php

// Pastikan kelas Model dasar sudah dimuat
require_once('Model.class.php'); // Atau cukup 'Model.class.php' jika sudah ada di path yang sama

class TodoModel extends Model { // Mewarisi dari kelas Model

    // Fungsi untuk memasukkan data todo baru
    function insert($title) {
        $sql = "INSERT INTO todos (title) "
        . "VALUES (?)"; // Menggunakan placeholder untuk prepared statement
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for TodoModel::insert: " . $this->db->error);
            return false;
        }
        $stmt->bind_param("s", $title);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Fungsi untuk mendapatkan semua data todo
    function getAllTodos() {
        $sql = "SELECT * FROM todos";
        $result = $this->db->query($sql);
        if ($result === false) {
            error_log("Failed to execute query for TodoModel::getAllTodos: " . $this->db->error);
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fungsi untuk mendapatkan satu todo berdasarkan ID
    function getTodo($id) {
        $sql = "SELECT * FROM todos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for TodoModel::getTodo: " . $this->db->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    // Fungsi untuk memperbarui data todo
    function update($title, $id) {
        $sql = "UPDATE todos SET title = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for TodoModel::update: " . $this->db->error);
            return false;
        }
        $stmt->bind_param("si", $title, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Fungsi untuk menghapus data todo
    function delete($id) {
        $sql = "DELETE FROM todos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            error_log("Failed to prepare statement for TodoModel::delete: " . $this->db->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // *** FUNGSI TERKAIT KARBON DIHAPUS DARI SINI ***
    // getLeaderboard(), getriwayatEmisi(), getTotalEmissionForUserId()
    // Semua fungsi ini sudah dipindahkan ke CarbonModel.class.php
}