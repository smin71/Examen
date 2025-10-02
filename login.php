<?php
require_once('./db.php');
$link = mysqli_connect('db', 'root', 'qwe', 'first_db');

session_start();

$error = '';

if (isset($_POST['submit'])) 
{
    $username = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = 'Заполните все поля';
    } else {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) == 1) {
            setcookie("User", $username, time() + 7200, "/");
            header('Location: profile.php');
            exit;
        } else {
            $error = "Неверное имя или пароль";
        }
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Surin</title>
</head>
<body>
    <h1>Вход</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="login" placeholder="Login" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Продолжить</button>
    </form>
</body>
</html>
