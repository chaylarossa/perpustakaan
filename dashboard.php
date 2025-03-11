<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

require 'koneksi.php';

// Search functionality
try {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $query = "SELECT * FROM buku";
    if (!empty($search)) {
        $query .= " WHERE judul LIKE '%$search%' OR pengarang LIKE '%$search%'";
    }
    $query .= " ORDER BY id ASC";
    $buku = $conn->query($query);
    
    if (!$buku) {
        throw new Exception("Error executing query");
    }
} catch (Exception $e) {
    die("Maaf, terjadi kesalahan saat mengambil data buku.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header-section">
                <h1>Dashboard Perpustakaan</h1>
                
                <div class="search-section">
                    <form method="GET" action="">
                        <input type="text" name="search" class="search-box" 
                               placeholder="Cari judul atau pengarang..."
                               value="<?= htmlspecialchars($search) ?>">
                    </form>
                </div>
                
                <div class="actions-section">
                    <a href="tambah_buku.php" class="tambah_btn">Tambah Buku</a>
                    <a href="generate_report.php" class="btn">Download Laporan</a>
                    <a href="logout.php" class="logout_btn">Logout</a>
                </div>
            </div>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                    <?php unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                    <?php unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>

            <div class="book-grid">
                <?php if ($buku && $buku->num_rows > 0): ?>
                    <?php while ($row = $buku->fetch_assoc()): ?>
                        <div class="book-card">
                            <a href="detail_buku.php?id=<?= $row['id'] ?>">
                                <?php if (!empty($row['cover']) && file_exists('uploads/' . $row['cover'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($row['cover']) ?>" 
                                        class="book-cover" alt="<?= htmlspecialchars($row['judul']) ?>">
                                <?php else: ?>
                                    <div class="book-cover" style="background: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #666;">
                                        <span>Cover tidak tersedia</span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            
                            <div class="book-info">
                                <h3><a href="detail_buku.php?id=<?= $row['id'] ?>" class="book-title"><?= htmlspecialchars($row['judul']) ?></a></h3>
                                <p>Pengarang: <?= htmlspecialchars($row['pengarang']) ?></p>
                                <p>Tahun: <?= htmlspecialchars($row['tahun_terbit']) ?></p>
                                <div class="actions">
                                    <a href="edit_buku.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
                                    <a href="hapus_buku.php?id=<?= $row['id'] ?>" 
                                       onclick="return confirm('Yakin ingin menghapus buku ini?')" 
                                       class="btn">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div style="text-align: center; width: 100%; padding: 20px;">
                        <p>Tidak ada buku yang ditemukan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>