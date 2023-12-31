<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'connect.php';

$connection = getConnection();

// Mendapatkan data yang dikirim melalui metode GET
$kode = isset($_GET['kode']) ? $_GET['kode'] : '';

try {
    // Query SQL untuk memilih data buku berdasarkan kode
    $query = "SELECT * FROM buku WHERE kode = :kode";

    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $connection->prepare($query);

    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':kode', $kode);

    // Eksekusi statement
    $statement->execute();

    // Mendapatkan hasil seleksi
    $buku = $statement->fetch(PDO::FETCH_ASSOC);

    // Mengirimkan response dengan data buku
    if ($buku) {
        $response = [
            'status' => 'success',
            'data' => $buku
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data buku tidak ditemukan'
        ];
    }
} catch (PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat memilih data buku: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$connection = null;
?>