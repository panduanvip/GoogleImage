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
print_r($results);