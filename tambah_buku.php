<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    
    // Handle file upload
    $cover = '';
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
        $cover = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $cover;
        
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            // File uploaded successfully
        } else {
            $error = "Gagal mengupload file.";
        }
    }

    $query = "INSERT INTO buku (judul, cover, pengarang, tahun_terbit) 
          VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $judul, $cover, $pengarang, $tahun_terbit);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Gagal menambahkan buku: " . $stmt->error;
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Tambah Buku</h1>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <input type="file" name="cover" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Judul Buku:</label>
                    <input type="text" name="judul" required>
                </div>
                <div class="form-group">
                    <label>Pengarang:</label>
                    <input type="text" name="pengarang" required>
                </div>
                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="number" name="tahun_terbit" required>
                </div>
                <button type="submit" class="btn">Tambah</button>
            </form>
        </div>
    </div>
</body>
</html>