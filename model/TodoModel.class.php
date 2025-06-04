<?php

class TodoModel extends Model { // Mewarisi dari kelas Model

    // Fungsi untuk memasukkan data todo baru
    function insert($title) {
        $sql = "INSERT INTO todos (title) "
        . "VALUES ('$title')";
        $result = $this->db->query($sql); // Menjalankan query
        return $result; // Mengembalikan hasil
    }

    // Fungsi untuk mendapatkan semua data todo
    function getAllTodos() {
        $sql = "SELECT * FROM todos";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC); // Mengembalikan semua baris sebagai array asosiatif
    }

    // Fungsi untuk mendapatkan satu todo berdasarkan ID
    function getTodo($id) {
        $sql = "SELECT * FROM todos WHERE id = '$id'";
        $result = $this->db->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows[0]; // Mengembalikan baris pertama
    }

    // Fungsi untuk memperbarui data todo
    function update($title, $id) {
        $sql = "UPDATE todos SET title = '$title' "
         . "WHERE id = '$id'";
        return $this->db->query($sql);
    }

    // Fungsi untuk menghapus data todo
    function delete($id) {
        $sql = "DELETE FROM todos WHERE id = '$id'";
        return $this->db->query($sql);
    }
}