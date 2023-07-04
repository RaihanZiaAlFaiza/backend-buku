<?php
include 'connect.php';

// Peminjaman buku
function peminjamanBuku($id_peminjaman, $tanggal_peminjaman, $nomor_anggota, $kode_buku)
{
    global $conn; // Use the global variable $conn inside the function

    try {
        // Lakukan validasi dan proses peminjaman buku
        // ...

        // Simpan data ke tabel peminjaman_master
        $sql = "INSERT INTO peminjaman_master (id, tanggal_peminjaman, nomor_anggota, status_peminjaman)
                VALUES (?, ?, ?, 'DIPINJAM')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_peminjaman, $tanggal_peminjaman, $nomor_anggota]);

        // Simpan data ke tabel peminjaman_detail
        $sql = "INSERT INTO peminjaman_detail (id, id_peminjaman_master, kode_buku)
                VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_peminjaman, $id_peminjaman, $kode_buku]);

        // Berikan respons API
        $response = [
            'status' => 'success',
            'message' => 'Peminjaman buku berhasil'
        ];

        return $response;
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat meminjam buku: ' . $e->getMessage()
        ];
        return $response;
    }
}

$conn = getConnection();

// Assign values to variables
$id_peminjaman = 15; // Assign a valid value
$tanggal_peminjaman = '2023-07-03'; // Assign a valid value
$nomor_anggota = 'RZA001'; // Assign a valid value
$kode_buku = 'RZ01'; // Assign a valid value

// Call the function and echo the response
$response = peminjamanBuku($id_peminjaman, $tanggal_peminjaman, $nomor_anggota, $kode_buku);
echo json_encode($response);

// Tutup koneksi
$conn = null;
?>
