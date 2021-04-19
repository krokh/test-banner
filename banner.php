<?php
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$pageUrl = $_SERVER['HTTP_REFERER'];

$pdo = new PDO('mysql:host=db;dbname=laravel', 'laravel', 'laravel');

$sql = "SELECT id, views_count 
        FROM users 
        WHERE ip_address = :ip_address 
            AND user_agent = :user_agent 
            AND page_url = :page_url
        LIMIT 1
";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'ip_address' => $ip ?? '',
    'user_agent' => $userAgent ?? '',
    'page_url' => $pageUrl ?? '',
]);
$user = $stmt->fetch();

if ($user) {
    $sql = "UPDATE users SET view_date = :view_date, views_count = :views_count WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'view_date' => (new DateTime())->format('Y-m-d H:i:s'),
        'views_count' => ++$user['views_count'],
        'id' => $user['id'],
    ]);
} else {
    $sql = "INSERT INTO users (ip_address, user_agent, view_date, page_url, views_count) 
            VALUES (:ip_address, :user_agent, :view_date, :page_url, :views_count)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'ip_address' => $ip ?? '',
        'user_agent' => $userAgent ?? '',
        'view_date' => (new DateTime())->format('Y-m-d H:i:s'),
        'page_url' => $pageUrl ?? '',
        'views_count' => 1,
    ]);
}

header('Content-type:image/jpg');
echo file_get_contents('banner.jpg');