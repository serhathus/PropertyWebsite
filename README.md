# Naziremlak

Basit bir PHP tabanlı emlak ilanı yönetim sistemi.

## Dosyalar
- `index.php`: Ana sayfa, ilanları widget tarzında 3 sütunlu grid olarak listeler.
- `hakkimizda.php`: Firma hakkında bilgilendirici sayfa.
- `iletisim.php`: İletişim bilgilerinin bulunduğu sayfa.

- `ilan-ekle.php`: Admin girişi yaparak ilan ekleyip var olan ilanları silebilmenizi sağlar.
- `ilan-kaydet.php`: Formdan gelen verileri `ilanlar.json` dosyasına kaydeder ve fotoğrafları `uploads/` klasörüne yükler.
- `ilan-sil.php`: Seçilen ilanı ve varsa fotoğraflarını siler.
- `ilanlar.json`: İlan verilerinin tutulduğu JSON dosyası.
- `uploads/`: Yüklenen fotoğrafların saklandığı klasör.

Repo içerisinde örnek olarak birkaç ilan eklenmiştir. İlanlar `ilanlar.json` dosyasında JSON formatında saklanır.

Admin kullanıcı adı **admin**, şifre **1234**'tür.
Giriş yaptıktan sonra üst menüdeki "Çıkış Yap" bağlantısıyla oturum kapatılabilir.


## Çalıştırma
Bu proje PHP'nin yerleşik sunucusu ile kolayca çalıştırılabilir:

```bash
php -S localhost:8000
```

Ardından tarayıcıda [http://localhost:8000](http://localhost:8000) adresini açarak ilanları görebilirsiniz.
