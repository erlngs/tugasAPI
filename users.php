<?php
$url = 'https://jsonplaceholder.typicode.com/users';

$response = file_get_contents($url);

$data = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users (PHP)</title>
    <link rel="stylesheet" href="style.css?v=1.1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

</head>
<body>
    <h1>Data Users dari JSONPlaceholder API (PHP)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                
                <td>
                    <?php
                    echo htmlspecialchars($user['address']['street']) . ', ' . 
                         htmlspecialchars($user['address']['suite']) . ', ' . 
                         htmlspecialchars($user['address']['city']) . ', ' . 
                         htmlspecialchars($user['address']['zipcode']);
                    ?>
                </td>
                
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                <td><?php echo htmlspecialchars($user['website']); ?></td>
                
                <td><?php echo htmlspecialchars($user['company']['name']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
