<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

require 'koneksi.php';

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception('ID buku tidak valid');
    }

    $id = (int)$_GET['id'];
    
    // Validate if book exists
    $stmt = $conn->prepare("SELECT cover FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception('Buku tidak ditemukan');
    }

    $row = $result->fetch_assoc();
    $cover = $row['cover'];

    // Delete cover file if exists
    if (!empty($cover)) {
        $cover_path = "uploads/" . $cover;
        if (file_exists($cover_path)) {
            if (!unlink($cover_path)) {
                throw new Exception('Gagal menghapus file cover');
            }
        }
    }

    // Delete book record
    $stmt = $conn->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if (!$stmt->execute()) {
        throw new Exception('Gagal menghapus data buku');
    }

    $_SESSION['success_message'] = "Buku berhasil dihapus";
    header('Location: dashboard.php');
    exit();

} catch (Exception $e) {
    $_SESSION['error_message'] = "Error: " . $e->getMessage();
    header('Location: dashboard.php');
    exit();
}
?>