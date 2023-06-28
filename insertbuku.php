<?php
include 'connect.php';
// Establish database connection
$conn = getConnection();

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
    $connection = getConnection();
   

    $query = "INSERT INTO buku (kode, kode_kategori, judul, pengarang, penerbit, tahun, tanggal_input, harga, file_cover) 
              VALUES (:kode, :kode_kategori, :judul, :pengarang, :penerbit, :tahun, :tanggal_input, :harga, :file_cover)";

    $statement = $connection->prepare($query);

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
        'message' => 'Data buku berhasil ditambahkan'
    ];
} catch (PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data buku: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$connection = null;
?>