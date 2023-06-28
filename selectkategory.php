<?php
include 'connect.php';

$connection = getConnection();
header('Access-Control-Allow-Origin: http://localhost:5173');

if ($connection) {
    try {
        $statement = $connection->query("SELECT * FROM kategori");

        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        echo json_encode($result, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo $e;
    }
} else {
    echo "Failed to connect to the database.";
}
?>