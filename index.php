<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Portal Informasi Kelulusan</title>
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
    <h1>📘 Portal Informasi Kelulusan</h1>

    <div class="card">
        <h2>👨‍🎓 Siswa</h2>
        <p>Cek kelulusan berdasarkan NISN Anda.</p>
        <a href="cek-kelulusan.php" class="button">Cek Kelulusan</a>
    </div>

    <div class="card">
        <h2>🧑‍💼 Admin</h2>
        <?php if (!isset($_SESSION['admin'])): ?>
            <p>Login untuk mengelola data kelulusan.</p>
            <a href="login.php" class="button">Login Admin</a>
        <?php else: ?>
            <p>Anda login sebagai <strong><?= $_SESSION['admin']; ?></strong></p>
            <a href="admin.php" class="button">Dashboard Admin</a><br>
        <?php endif; ?>
    </div>
</body>
</html>
