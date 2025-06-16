<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die('Yetkisiz erişim');
}

$id = $_GET['id'] ?? '';
if ($id === '') {
    die('Geçersiz istek');
}

$file = 'ilanlar.json';
$ads = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$newAds = [];
foreach ($ads as $ad) {
    if ($ad['id'] === $id) {
        if (!empty($ad['photos'])) {
            foreach ($ad['photos'] as $photo) {
                if (is_file($photo)) {
                    @unlink($photo);
                }
            }
        }
        continue;
    }
    $newAds[] = $ad;
}

file_put_contents($file, json_encode($newAds, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
header('Location: ilan-ekle.php');
exit;
?>
