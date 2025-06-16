<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die('Yetkisiz erişim');
}

$title = $_POST['title'] ?? '';
$price = $_POST['price'] ?? '';
$category = $_POST['category'] ?? '';
$rooms = $_POST['rooms'] ?? '';
$size = $_POST['size'] ?? '';
$neighborhood = $_POST['neighborhood'] ?? '';
$description = $_POST['description'] ?? '';

$photos = [];
if (!empty($_FILES['photos']['name'][0])) {
    $uploadDir = 'uploads/';
    foreach ($_FILES['photos']['name'] as $index => $name) {
        if ($_FILES['photos']['error'][$index] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['photos']['tmp_name'][$index];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newName = uniqid('img_', true).'.'.$ext;
            $dest = $uploadDir.$newName;
            if (move_uploaded_file($tmpName, $dest)) {
                $photos[] = $dest;
            }
            if (count($photos) >= 15) break; // max 15
        }
    }
}

$newAd = [
    'id' => uniqid('ad_', true),
    'title' => $title,
    'price' => $price,
    'category' => $category,
    'rooms' => $rooms,
    'size' => $size,
    'neighborhood' => $neighborhood,
    'description' => $description,
    'photos' => $photos
];

$file = 'ilanlar.json';
$ads = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$ads[] = $newAd;
file_put_contents($file, json_encode($ads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: index.php');
exit;
