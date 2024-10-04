<?php
$url = 'https://jsonplaceholder.typicode.com/comments';

$response = file_get_contents($url);

$data = json_decode($response, true);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devide-width, initial-scale=1.0">
        <title>Data Comments (PHP)</title>
        <link rel="stylesheet" href="style.css?v=1.1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


</head>
<body>
    <h1 >Data Comments dari JSONPIaceholder API (PHP)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach ($data as $comments): ?>
    <tr>
        <td><?php echo $comments['id']; ?></td>
        <td><?php echo htmlspecialchars($comments['name']); ?></td>
        <td><?php echo htmlspecialchars($comments['email']); ?></td>
        <td><?php echo htmlspecialchars($comments['body']); ?></td>
    </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

