<?php
include 'connect.php';
$conn = getConnection();

$nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
$tanggal_terdaftar = isset($_POST['tanggal_terdaftar']) ? $_POST['tanggal_terdaftar'] : '';


try {
    $conn = getConnection();

    $query = "INSERT INTO anggota (nomor, nama, jenis_kelamin, alamat, no_hp, tanggal_terdaftar) 
              VALUES (:nomor, :nama, :jenis_kelamin, :alamat, :no_hp, :tanggal_terdaftar)";
    
    $statement = $conn->prepare($query);
    
    $statement->bindParam(':nomor', $nomor);
    $statement->bindParam(':nama', $nama);
    $statement->bindParam(':jenis_kelamin', $jenis_kelamin);
    $statement->bindParam(':alamat', $alamat);
    $statement->bindParam(':no_hp', $no_hp);
    $statement->bindParam(':tanggal_terdaftar', $tanggal_terdaftar);

    $statement->execute();
    
    $response = [
        'status' => 'success',
        'message' => 'Data anggota berhasil ditambahkan'
    ];
} catch(PDOException $e) {
    
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data anggota: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$conn = null;
?>