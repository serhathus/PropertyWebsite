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
    <title>İlan Ekle</title>
</head>
<body>
<?php if (!$loggedIn): ?>
    <h1>Admin Girişi</h1>
    <?php if ($loginError): ?><p style="color:red;"><?php echo $loginError; ?></p><?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Kullanıcı Adı">
        <input type="password" name="password" placeholder="Şifre">
        <button type="submit" name="login">Giriş</button>
    </form>
<?php else: ?>
    <h1>İlan Ekle</h1>
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
<?php endif; ?>
</body>
</html>
