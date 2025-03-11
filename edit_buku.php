<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

require 'koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$buku = $conn->query("SELECT * FROM buku WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $conn->real_escape_string($_POST['judul']);
    $pengarang = $conn->real_escape_string($_POST['pengarang']);
    $tahun_terbit = $conn->real_escape_string($_POST['tahun_terbit']);
    
    $cover = $buku['cover']; // Keep existing cover by default
    
    // Handle new cover upload
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
        $cover = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $cover;
        
        // Delete old cover if exists
        if (!empty($buku['cover']) && file_exists($target_dir . $buku['cover'])) {
            unlink($target_dir . $buku['cover']);
        }
        
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            // File uploaded successfully
        } else {
            $error = "Gagal mengupload file.";
        }
    }

    $query = "UPDATE buku SET 
              judul='$judul', 
              cover='$cover', 
              pengarang='$pengarang', 
              tahun_terbit='$tahun_terbit' 
              WHERE id=$id";
              
    if ($conn->query($query)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Gagal mengupdate buku: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Buku</h1>
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Cover Buku:</label>
                    <?php if (!empty($buku['cover'])): ?>
                        <img src="uploads/<?= htmlspecialchars($buku['cover']) ?>" class="cover-preview">
                    <?php endif; ?>
                    <div class="file-upload">
                        <input type="file" name="cover" accept="image/*" class="file-input" id="cover">
                        <label for="cover">Pilih Cover Baru</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Judul Buku:</label>
                    <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Pengarang:</label>
                    <input type="text" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Tahun Terbit:</label>
                    <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required>
                </div>
                <button type="submit" class="btn">Update Buku</button>
            </form>
        </div>
    </div>
</body>
</html>