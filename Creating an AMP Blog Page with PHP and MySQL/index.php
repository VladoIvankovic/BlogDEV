<?php
require 'db.php';

$stmt = $pdo->query('SELECT id, title, created_at FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();
?>

<!doctype html>
<html amp>
<head>
    <meta charset="utf-8">
    <title>AMP Blog</title>
    <link rel="canonical" href="index.php">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-custom>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .post {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post h2 {
            margin-top: 0;
            font-size: 1.5em;
        }
        .post time {
            display: block;
            font-size: 0.9em;
            color: #999;
            margin-bottom: 10px;
        }
        .post a {
            text-decoration: none;
            color: #333;
        }
        .post a:hover {
            text-decoration: underline;
        }
    </style>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
</head>
<body>
    <div class="container">
        <h1>My AMP Blog</h1>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                <time datetime="<?= $post['created_at'] ?>"><?= $post['created_at'] ?></time>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
