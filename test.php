<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\GoogleImage;

// hanya untuk keperluan testing
 
if(! class_exists('RoNoLo\JsonExtractor\JsonExtractorService')){
	include_once '../ronolo-json-extract/src/JsonExtractorService.php';
	include_once '../ronolo-json-extract/src/JsonExtractorException.php';
}

$url = 'https://www.google.com/search?q=sepatu+roda&source=lnms&tbm=isch';
$user_agent = 'Mozilla/5.0 (Linux; Android 10; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.72 Mobile Safari/537.36.';

$options  = array('http' => array('user_agent' => $user_agent));
$context  = stream_context_create($options);
$html = file_get_contents($url, false, $context);

$results = json_decode(GoogleImage::extractor($html));

echo '<pre>';
print_r($results);