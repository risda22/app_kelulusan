<?php 
include 'config.php';
include 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Data Kelulusan</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        form { margin-top: 20px; }
        .container { width: 80%; margin: auto; }
        .actions a { margin-right: 10px; }
        .logout { float: right; }
    </style>
</head>
<body>
<div class="container">
    <h2>📋 Data Kelulusan Siswa</h2>
    <div class="logout">
        Login sebagai <b><?= $_SESSION['admin']; ?></b> | 
        <a href="logout.php">Logout</a>
      <hr>
    </div>

    <!-- Tabel Data -->
    <table width="100%">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Status Kelulusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $result = mysqli_query($conn, "SELECT * FROM kelulusan");
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nisn']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['status_kelulusan']; ?></td>
            <td class="actions">
                <a href="admin.php?edit=<?= $row['nisn']; ?>">✏️ Edit</a>
                <a href="admin.php?hapus=<?= $row['nisn']; ?>" onclick="return confirm('Yakin hapus data?')">🗑️ Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <hr>

    <!-- Form Tambah/Edit -->
    <?php
    $edit_mode = false;
    $nisn = $nama = $status = "";

    // Jika mode edit
    if (isset($_GET['edit'])) {
        $edit_mode = true;
        $edit_nisn = $_GET['edit'];
        $q = mysqli_query($conn, "SELECT * FROM kelulusan WHERE nisn='$edit_nisn'");
        $data = mysqli_fetch_assoc($q);
        $nisn = $data['nisn'];
        $nama = $data['nama'];
        $status = $data['status_kelulusan'];
    }

    // Proses simpan/tambah
    if (isset($_POST['simpan'])) {
        $nisn = $_POST['nisn'];
        $nama = $_POST['nama'];
        $status = $_POST['status_kelulusan'];

        mysqli_query($conn, "INSERT INTO kelulusan (nisn, nama, status_kelulusan) VALUES ('$nisn', '$nama', '$status')");
        header("Location: admin.php");
        exit;
    }

    // Proses update
    if (isset($_POST['update'])) {
        $nisn = $_POST['nisn'];
        $nama = $_POST['nama'];
        $status = $_POST['status_kelulusan'];

        mysqli_query($conn, "UPDATE kelulusan SET nama='$nama', status_kelulusan='$status' WHERE nisn='$nisn'");
        header("Location: admin.php");
        exit;
    }

    // Proses hapus
    if (isset($_GET['hapus'])) {
        $hapus_nisn = $_GET['hapus'];
        mysqli_query($conn, "DELETE FROM kelulusan WHERE nisn='$hapus_nisn'");
        header("Location: admin.php");
        exit;
    }
    ?>

    <h3><?= $edit_mode ? "✏️ Edit Data" : "➕ Tambah Data" ?></h3>
    <form method="post">
        <table>
            <tr>
                <td>NISN</td>
                <td><input type="text" name="nisn" value="<?= $nisn; ?>" <?= $edit_mode ? 'readonly' : '' ?> required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= $nama; ?>" required></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status_kelulusan" required>
                        <option value="">-- Pilih --</option>
                        <option value="Lulus" <?= $status == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                        <option value="Tidak Lulus" <?= $status == 'Tidak Lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <?php if ($edit_mode): ?>
                        <button type="submit" name="update">Update</button>
                        <a href="admin.php">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="simpan">Simpan</button>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
