<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cek Kelulusan Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 100px; }
        .card {
            display: inline-block;
            padding: 30px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 { margin-bottom: 40px; }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Cek Informasi Kelulusan</h2>
    <form method="post">
        Masukkan NISN Anda:<br>
        <input type="text" name="nisn" required>
        <input type="submit" name="cek" value="Cek Kelulusan">
    </form>

    <?php
    if (isset($_POST['cek'])) {
        $nisn = $_POST['nisn'];
        $query = mysqli_query($conn, "SELECT * FROM kelulusan WHERE nisn = '$nisn'");
        
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            echo "<h3>Hasil Kelulusan:</h3>";
            echo "<p>Nama: <strong>" . $data['nama'] . "</strong></p>";
            echo "<p>Status: <strong>" . $data['status_kelulusan'] . "</strong></p>";
        } else {
            echo "<p style='color:red;'>NISN tidak ditemukan. Periksa kembali!</p>";
        }
    }
    ?>
    <hr>
    <a href="index.php" class="button" style="background-color: red;">Kembali</a>
</body>
</html>
