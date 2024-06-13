<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT title, content, created_at FROM posts WHERE id = ?');
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die('Post not found!');
}
?>

<!doctype html>
<html amp>
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link rel="canonical" href="post.php?id=<?= $id ?>">
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
        time {
            display: block;
            font-size: 0.9em;
            color: #999;
            margin-bottom: 20px;
            text-align: center;
        }
        .content {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <time datetime="<?= $post['created_at'] ?>"><?= $post['created_at'] ?></time>
        <div class="content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
    </div>
</body>
</html>
