<?php
$adsFile = 'ilanlar.json';
$ads = file_exists($adsFile) ? json_decode(file_get_contents($adsFile), true) : [];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Naziremlak - Ana Sayfa</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 0; padding: 20px;}
        header {text-align: center; margin-bottom: 20px;}
        nav a {margin: 0 10px; text-decoration: none; color: #333;}
        .grid {display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;}
        @media (min-width: 900px) { .grid {grid-template-columns: repeat(3, 1fr);} }
        .card {border: 1px solid #ccc; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);} 
        .card img {width: 100%; height: 200px; object-fit: cover; border-radius: 5px;}
        .card h3 {margin: 10px 0 5px;}
        .card p {margin: 5px 0;}
    </style>
</head>
<body>
<header>
    <h1>Naziremlak</h1>
    <nav>
        <a href="index.php">Ana Sayfa</a>
        <a href="hakkimizda.php">Hakkımızda</a>
        <a href="iletisim.php">İletişim</a>
        <a href="ilan-ekle.php">İlan Ekle</a>
    </nav>
</header>
<div class="grid">
<?php foreach ($ads as $ad): ?>
    <div class="card">
        <?php if (!empty($ad['photos'])): ?>
            <img src="<?php echo htmlspecialchars($ad['photos'][0]); ?>" alt="<?php echo htmlspecialchars($ad['title']); ?>">
        <?php else: ?>
            <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No image">
        <?php endif; ?>
        <h3><?php echo htmlspecialchars($ad['title']); ?></h3>
        <p>Fiyat: <?php echo htmlspecialchars($ad['price']); ?> TL</p>
        <p>Oda Sayısı: <?php echo htmlspecialchars($ad['rooms']); ?></p>
        <p>m²: <?php echo htmlspecialchars($ad['size']); ?></p>
        <p>Mahalle: <?php echo htmlspecialchars($ad['neighborhood']); ?></p>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>
