<?php
$url = 'https://jsonplaceholder.typicode.com/posts';

$response = file_get_contents($url);

$data = json_decode($response, true);

$filter_id = isset($_GET['id']) ? $_GET['id'] : '';
$filter_title = isset($_GET['title']) ? $_GET['title'] : '';

if ($filter_id !== '' || $filter_title !== '') {
    $data = array_filter($data, function($post) use ($filter_id, $filter_title) {
        $id_match = $filter_id === '' || $post['id'] == $filter_id;
        $title_match = $filter_title === '' || stripos($post['title'], $filter_title) !== false;
        return $id_match && $title_match;
    });
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devide-width, initial-scale=1.0">
        <title>Data Post (PHP)</title>
        <link rel="stylesheet" href="style.css?v=1.1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


</head>
<body>
    <h1 >Data Posts dari JSONPIaceholder API (PHP)</h1>
    <form method="GET">
        <label for="id">Filter by ID:</label>
        <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($filter_id); ?>">
        
        <label for="title">Filter by Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($filter_title); ?>">
        
        <button type="submit">Filter</button>
        <button type="button" onclick="window.location.href='index.php';">Reset</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach ($data as $post): ?>
    <tr>
        <td><?php echo $post['id']; ?></td>
        <td><?php echo htmlspecialchars($post['title']); ?></td>
        <td><?php echo htmlspecialchars($post['body']); ?></td>
    </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

