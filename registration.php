<?php
require_once('./db.php');
$link = mysqli_connect('db', 'root', 'qwe', 'first_db');

session_start();

if (isset($_COOKIE['User'])) {
    header("Location: profile.php");
    exit;
}

$error = '';
$success = '';

if (isset($_POST['submit'])) 
{
    $username = $_POST['login'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$email || !$password) {
        $error = 'Пожалуйста, заполните все поля!';
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if(!mysqli_query($link, $sql)) {
            $error = "Не удалось добавить пользователя: " . mysqli_error($link);
        } else {
            $success = "Пользователь успешно зарегистрирован. Теперь можно <a href='login.php'>войти</a>.";
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
    <h1>Регистрация</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="login" placeholder="Login" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Продолжить</button>
    </form>
</body>
</html>
