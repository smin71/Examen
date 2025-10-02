<?php
$servername = "db";
$username = "root";
$password = "qwe";
$dbName = "first_db";

$link = mysqli_connect($servername, $username, $password, $dbName);
if (!$link) {
    die("Ошибка подключения к базе: " . mysqli_connect_error());
}

$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($link, $sql_users);
if (!$result_users) {
    die("Ошибка запроса users: " . mysqli_error($link));
}

$sql_posts = "SELECT * FROM posts";
$result_posts = mysqli_query($link, $sql_posts);
if (!$result_posts) {
    die("Ошибка запроса posts: " . mysqli_error($link));
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Check DB</title>
</head>
<body>
    <h1>Пользователи</h1>
    <?php if (mysqli_num_rows($result_users) > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>username</th>
                    <th>email</th>
                    <th>password</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Пользователей нет.</p>
    <?php endif; ?>

    <h1>Посты</h1>
    <?php if (mysqli_num_rows($result_posts) > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>content</th>
                    <th>image_path</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_posts)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
                    <td><?= htmlspecialchars($row['image_path']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Постов нет.</p>
    <?php endif; ?>

<?php
mysqli_close($link);
?>
</body>
</html>
