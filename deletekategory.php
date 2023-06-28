<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'connect.php';

$conn = getConnection();

// Mendapatkan data yang dikirim melalui metode POST
$kode = isset($_POST['kode']) ? $_POST['kode'] : '';

try {
    // Query SQL untuk menghapus data kategori berdasarkan kode
    $query = "DELETE FROM kategori WHERE kode = :kode";
    
    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);
    
    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':kode', $kode);
    
    // Eksekusi statement
    $statement->execute();
    
    // Mengirimkan response dalam format JSON
    $response = [
        'status' => 'success',
        'message' => 'Data kategori berhasil dihapus'
    ];
} catch(PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data kategori: ' . $e->getMessage()
    ];
}

// Mengirimkan response dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>