<?php
session_start();
$loggedIn = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
$loginError = '';
if (isset($_POST['login'])) {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['admin'] = true;
        $loggedIn = true;
    } else {
        $loginError = 'Hatalı giriş';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Naziremlak - İlan Ekle</title>
</head>
<body>
<?php if (!$loggedIn): ?>
    <h1>Naziremlak Admin Girişi</h1>
    <?php if ($loginError): ?><p style="color:red;"><?php echo $loginError; ?></p><?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Kullanıcı Adı">
        <input type="password" name="password" placeholder="Şifre">
        <button type="submit" name="login">Giriş</button>
    </form>
<?php else: ?>
    <h1>Naziremlak - İlan Ekle</h1>
    <form action="ilan-kaydet.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Başlık" required><br>
        <input type="number" name="price" placeholder="Fiyat" required><br>
        <select name="category">
            <option>Ev</option>
            <option>Arsa</option>
            <option>Zeytinlik</option>
            <option>Tarla</option>
        </select><br>
        <select name="rooms">
            <option>1+0</option>
            <option>1+1</option>
            <option>2+1</option>
            <option>3+1</option>
            <option>4+1</option>
        </select><br>
        <input type="number" name="size" placeholder="m²" required><br>
        <select name="neighborhood">
            <option>Merkez</option>
            <option>Çarşı</option>
            <option>Sanayi</option>
            <option>Kıyı</option>
        </select><br>
        <textarea name="description" placeholder="Açıklama"></textarea><br>
        <input type="file" name="photos[]" multiple accept="image/*"><br>
        <button type="submit">İlanı Yayınla</button>
    </form>

    <h2>Mevcut İlanlar</h2>
    <?php
    $file = 'ilanlar.json';
    $ads = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    if ($ads): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Başlık</th>
                <th>Fiyat</th>
                <th>İşlem</th>
            </tr>
            <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ad['title']); ?></td>
                    <td><?php echo htmlspecialchars($ad['price']); ?> TL</td>
                    <td><a href="ilan-sil.php?id=<?php echo urlencode($ad['id']); ?>" onclick="return confirm('Silinsin mi?');">Sil</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Henüz ilan yok.</p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
