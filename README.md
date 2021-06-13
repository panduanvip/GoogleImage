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

// hanya untuk keperluan testing
 
if(! class_exists('RoNoLo\JsonExtractor\JsonExtractorService')){
	include_once '../ronolo-json-extract/src/JsonExtractorService.php';
	include_once '../ronolo-json-extract/src/JsonExtractorException.php';
}

$keyword = 'sepatu roda';
$results = json_decode(GoogleImage::get($keyword));

echo '<pre>';
```

**Result:** 
```
Array
(
    [0] => stdClass Object
        (
            [alt] => SEPATU RODA INLINE SKATE ANAK / BAJAJ TERBARU MERK POWER UKURAN S ...
            [image] => https://cf.shopee.co.id/file/5fde8c3fd04b556c14fdc2ebd1d48bf2
            [thumbnail] => https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRI7QOJHoC25YnuiyoWWNRy1bO-vXjkSZAYnw&usqp=CAU
            [source] => https://shopee.co.id/SEPATU-RODA-INLINE-SKATE-ANAK-BAJAJ-TERBARU-MERK-POWER-UKURAN-S-M-L-FREE-BAUT-KUNCI-L-i.289749233.6744518264
        )

    [1] => stdClass Object
        (
            [alt] => Inline Skate atau Sepatu Roda Power baru - Olahraga - 805169403
            [image] => https://apollo-singapore.akamaized.net/v1/files/wwwueflk7xyv3-ID/image;s=850x0
            [thumbnail] => https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_DKFC2tjHPAiRvwoE_3WCrcVFA4n6Pq5Lww&usqp=CAU
            [source] => https://www.olx.co.id/item/inline-skate-atau-sepatu-roda-power-baru-iid-805169403
        )

    .........
```
