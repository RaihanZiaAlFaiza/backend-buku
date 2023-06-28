<?php
include 'connect.php';
$connection = getConnection();

$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';

try {
    $connection = getConnection();

    $query = "INSERT INTO kategori (kode, kategori) 
              VALUES (:kode, :kategori)";

    $statement = $connection->prepare($query);

    $statement->bindParam(':kode', $kode);
    $statement->bindParam(':kategori', $kategori);

    $statement->execute();

    $response = [
        'status' => 'success',
        'message' => 'Data kategori berhasil ditambahkan'
    ];
} catch (PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data kategori: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$connection = null;
?>