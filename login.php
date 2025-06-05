<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Login Admin</title></head>
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


<body>
<h2>Login Admin</h2>
<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" name="login" value="Login">
</form>

<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: admin.php");
    } else {
        echo "<p style='color:red;'>Login gagal. Cek username dan password!</p>";
    }
}
?>
</body>
</html>
