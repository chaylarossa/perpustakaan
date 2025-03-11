<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

require 'koneksi.php';
require 'vendor/autoload.php';

class PDF extends FPDF {
    function Header() {
        // Pink theme colors
        $this->SetFillColor(255, 192, 203); // Pink background
        $this->SetTextColor(199, 21, 133); // Deep pink text
        
        // Header Rectangle
        $this->Rect(0, 0, $this->GetPageWidth(), 40, 'F');
        
        // Title
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(0, 25, 'LAPORAN DATA BUKU PERPUSTAKAAN', 0, 1, 'C');
        
        // Date
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 5, 'Tanggal: ' . date('d F Y'), 0, 1, 'C');
        
        // Reset text color for content
        $this->SetTextColor(0, 0, 0);
        
        // Add some spacing
        $this->Ln(20);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(199, 21, 133);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'C');
    }
    
    function ChapterTitle($title) {
        $this->SetFillColor(255, 182, 193); // Lighter pink
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1, 'L', true);
        $this->Ln(4);
    }
    
    function BookEntry($no, $cover, $judul, $pengarang, $tahun, $isbn) {
    $initialY = $this->GetY();
    $this->SetFillColor(255, 240, 245);
    
    // Hitung tinggi entry
    $lineHeight = 6;
    $maxLines = max(
        ceil($this->GetStringWidth($judul) / 40),
        ceil($this->GetStringWidth($pengarang) / 30),
        1 // Minimal 1 baris
    );
    $entryHeight = max(30, $maxLines * $lineHeight);
    
    if ($initialY + $entryHeight > $this->GetPageHeight() - 20) {
        $this->AddPage();
        $initialY = $this->GetY(); // Update initialY jika pindah halaman
    }
    
    // Gambar background
    $this->Rect(10, $initialY, 190, $entryHeight, 'F');

    // Perbaikan di sini: tambahkan $initialY ke use()
    $calculateVerticalPosition = function($textHeight) use ($entryHeight, $initialY) {
        return $initialY + (($entryHeight - $textHeight) / 2);
    };

        // Nomor
        $this->SetXY(10, $calculateVerticalPosition(6));
        $this->Cell(10, 6, $no, 0, 0, 'C');

        // Cover
        if (!empty($cover) && file_exists('uploads/' . $cover)) {
            $this->Image('uploads/' . $cover, 25, $initialY + 2, 26, $entryHeight - 4);
        } else {
            $this->SetXY(25, $calculateVerticalPosition(6));
            $this->Cell(26, 6, '[No Cover]', 0, 0, 'C');
        }

        // Judul Buku (Rata tengah vertikal)
        $judulHeight = $this->getMultiCellHeight(60, 6, $judul);
        $this->SetXY(55, $calculateVerticalPosition($judulHeight));
        $this->SetFont('Arial', 'B', 11);
        $this->MultiCell(60, 6, $judul, 0, 'C');

        // Pengarang (Rata tengah vertikal)
        $pengarangHeight = $this->getMultiCellHeight(35, 6, $pengarang);
        $this->SetXY(120, $calculateVerticalPosition($pengarangHeight));
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(35, 6, $pengarang, 0, 'C');

        // Tahun
        $this->SetXY(160, $calculateVerticalPosition(6));
        $this->Cell(20, 6, $tahun, 0, 0, 'C');

        // ISBN
        $this->SetFont('Arial', '', 8);
        $isbnHeight = $this->getMultiCellHeight(25, 4, $isbn);
        $this->SetXY(175, $calculateVerticalPosition($isbnHeight));
        $this->MultiCell(25, 4, $isbn, 0, 'C');

        $this->Ln($entryHeight + 5);
    }

    // Tambahkan fungsi helper baru di class PDF
    function getMultiCellHeight($w, $h, $txt) {
        // Hitung jumlah baris
        $nb = max(
            ceil($this->GetStringWidth($txt) / $w),
            1
        );
        return $h * $nb;
    }
}

// Create PDF instance
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);

// Add table header
$pdf->ChapterTitle('DAFTAR BUKU');

// Get books from database
$query = "SELECT * FROM buku ORDER BY id ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->BookEntry(
            $no++,
            $row['cover'],
            $row['judul'],
            $row['pengarang'],
            $row['tahun_terbit'],
            $row['isbn'] ?? '-'
        );
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data buku yang tersedia', 0, 1, 'C');
}

// Output PDF
$pdf->Output('laporan_perpustakaan.pdf', 'D');
?>