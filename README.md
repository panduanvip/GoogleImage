# Google Image Extractor

Web extractor for Google Image website

## Installation:

```bash
composer require panduanvip/google-image
```

### Usage:

```php
<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\GoogleImage;

$url = 'https://www.google.com/search?q=sepatu+roda&source=lnms&tbm=isch';
$user_agent = 'Mozilla/5.0 (Linux; Android 10; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.72 Mobile Safari/537.36.';

$options  = array('http' => array('user_agent' => $user_agent));
$context  = stream_context_create($options);
$html = file_get_contents($url, false, $context);

$results = json_decode(GoogleImage::extractor($html));

echo '<pre>';
print_r($results);
```

**Result:** 
```
Array
(
    [0] => stdClass Object
        (
            [alt] => Dishi Sepatu Roda Anak Umur 3-6-10 Tahun, Set Lengkap Sepatu Roda ...
            [image] => https://my-test-11.slatic.net/p/103107a9a1c177bb632be00ebd9ebc0b.jpg_720x720q80.jpg_.webp
            [thumbnail] => https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeMzQP3n_uNmstjaMl2w9J3A97em4mxqCcxw&usqp=CAU
            [source] => https://www.lazada.co.id/products/dishi-sepatu-roda-anak-umur-3-6-10-tahun-set-lengkap-sepatu-roda-5-anak-perempuan-4-sepatu-roda-8-anak-laki-laki-i2182174557.html
        )

    [1] => stdClass Object
        (
            [alt] => SEPATU RODA INLINE SKATE BISA MODEL BAJAJ MERK POWER | Shopee ...
            [image] => https://cf.shopee.co.id/file/82e05948911460c0f6c508c95161cf38
            [thumbnail] => https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgAlWmKtaRk5kh89y7flGiO0OPvhSroQogWQ&usqp=CAU
            [source] => https://shopee.co.id/SEPATU-RODA-INLINE-SKATE-BISA-MODEL-BAJAJ-MERK-POWER-i.11295973.610356241
        )

    .........
```
