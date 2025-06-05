<?php
$host = "db.smkxyz.sch.local";
$user = "appdb";
$pass = "Appdb123!";
$db = "kelulusandb";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

session_start();

?>
