<?php

include 'connect.php';

$connection = getConnection();


$id = isset($_POST['id']) ? $_POST['id'] : '';
$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$kode_kategori = isset($_POST['kode_kategori']) ? $_POST['kode_kategori'] : '';
$judul = isset($_POST['judul']) ? $_POST['judul'] : '';
$pengarang = isset($_POST['pengarang']) ? $_POST['pengarang'] : '';
$penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
$tanggal_input = isset($_POST['tanggal_input']) ? $_POST['tanggal_input'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';
$file_cover = isset($_POST['file_cover']) ? $_POST['file_cover'] : '';

try {

    $query = "UPDATE buku SET id = :id, kode_kategori = :kode_kategori, judul = :judul, pengarang = :pengarang, penerbit = :penerbit, tahun = :tahun, tanggal_input = :tanggal_input, harga = :harga, file_cover = :file_cover WHERE kode = :kode";


    $statement = $connection->prepare($query);


    $statement->bindParam(':id', $id);
    $statement->bindParam(':kode', $kode);
    $statement->bindParam(':kode_kategori', $kode_kategori);
    $statement->bindParam(':judul', $judul);
    $statement->bindParam(':pengarang', $pengarang);
    $statement->bindParam(':penerbit', $penerbit);
    $statement->bindParam(':tahun', $tahun);
    $statement->bindParam(':tanggal_input', $tanggal_input);
    $statement->bindParam(':harga', $harga);
    $statement->bindParam(':file_cover', $file_cover);


    $statement->execute();


    $response = [
        'status' => 'success',
        'message' => 'Data buku berhasil diupdate'
    ];
} catch (PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat memperbarui data buku: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$connection = null;
?>