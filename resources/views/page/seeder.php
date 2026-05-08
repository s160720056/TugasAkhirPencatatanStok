<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TAFernando"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_user = 30;
$id_toko = 9;
$status_absensi = 2;

for ($day = 1; $day <= 30; $day++) {
    $date = new DateTime("2024-11-$day");
    $dayOfWeek = $date->format('N'); 

    if ($dayOfWeek < 7) { // Exclude Sundays (7)
        $tgl_masuk = $date->format('Y-m-d 08:00:00'); // Example time for tgl_masuk
        $tgl_keluar = $date->format('Y-m-d 17:00:00'); // Example time for tgl_keluar

        $sql = "INSERT INTO absensi (id_user, id_toko, tgl_masuk, tgl_keluar, STATUS_ABSENSI) 
                VALUES ($id_user, $id_toko, '$tgl_masuk', '$tgl_keluar', $status_absensi)";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully for date: " . $date->format('Y-m-d') . "\n";
        } else {
            echo "Error: " . $sql . "\n" . $conn->error;
        }
    } 
}

$conn->close();
?>