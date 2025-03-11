<?php
session_start();

require 'koneksi.php';

// Get book ID from URL parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    // Prepare statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $buku = $result->fetch_assoc();
    
    if (!$buku) {
        throw new Exception("Buku tidak ditemukan");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku - <?= htmlspecialchars($buku['judul']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>
            
            <div class="book-detail">
                <!-- Bagian Cover -->
                <div class="detail-cover">
                    <?php if (!empty($buku['cover']) && file_exists('uploads/' . $buku['cover'])): ?>
                        <img src="uploads/<?= htmlspecialchars($buku['cover']) ?>" 
                             alt="<?= htmlspecialchars($buku['judul']) ?>">
                    <?php else: ?>
                        <div class="cover-placeholder">
                            <span>Cover tidak tersedia</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Informasi Buku -->
                <div class="detail-info">
                    <h1><?= htmlspecialchars($buku['judul']) ?></h1>
                    
                    <div class="meta-info">
                        <p><strong>Pengarang:</strong> <?= htmlspecialchars($buku['pengarang']) ?></p>
                        <p><strong>Penerbit:</strong> <?= htmlspecialchars($buku['penerbit']) ?></p>
                        <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($buku['tahun_terbit']) ?></p>
                        <p><strong>ISBN:</strong> <?= htmlspecialchars($buku['isbn']) ?></p>
                        <p><strong>Jumlah Halaman:</strong> <?= htmlspecialchars($buku['jumlah_halaman']) ?></p>
                        <p><strong>Kategori:</strong> <?= htmlspecialchars($buku['kategori']) ?></p>
                    </div>
                    
                    <!-- Sinopsis/Deskripsi -->
                    <div class="synopsis">
                        <h2>Sinopsis</h2>
                        <p><?= nl2br(htmlspecialchars($buku['deskripsi'])) ?></p>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="edit_buku.php?id=<?= $buku['id'] ?>" class="btn edit-btn">✏️ Edit Buku</a>
                        <a href="dashboard.php" class="btn back-btn">← Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>