<?php

namespace PanduanVIP\WebExtractor;

use \RoNoLo\JsonExtractor\JsonExtractorService; 

class GoogleImage
{

    public static function get($keyword, $proxy='')
    {
		$html = self::curl($keyword, $proxy);

		$jsonExtractor = new JsonExtractorService();
		$data = $jsonExtractor->extractAllJsonData($html);

		$results = [];
		
		foreach($data as $index=>$dt){
			$json = json_encode($dt);
			if(strpos($json, 'https:\/\/encrypted')!==false){
				break;
			}
		}	

		$blocks = $data[$index]['data'][31][0][12][2] ?? [];
		
		if(empty($blocks)){
			$blocks = $data[$index][31][0][12][2] ?? [];
		}

        foreach ($blocks as $block) {
			$alt = $block[1][9][2003][3] ?? '';
			$image = $block[1][3][0] ?? '';
			$thumbnail = $block[1][2][0] ?? '';
			$source = $block[1][9][2003][2] ?? '';			
			
			if (empty($alt) || empty($image) || empty($thumbnail) || empty($source)){
				$alt = $block[0][1][9][2003][3] ?? '';
				$image = $block[0][1][3][0] ?? '';
				$thumbnail = $block[0][1][2][0] ?? '';
				$source = $block[0][1][9][2003][2] ?? '';
			}

			if (!empty($alt) && !empty($image) && !empty($thumbnail) && !empty($source)) {
				$results[] = ['alt' => $alt, 'image' => $image, 'thumbnail' => $thumbnail, 'source' => $source];
			}
        }
		
        return json_encode($results);
    }
	
	private static function curl($keyword, $proxy='')
	{
		if (!function_exists('curl_version')) {
			die('cURL extension is disabled on your server!');
		}

		$keyword = str_replace(' ', '+', $keyword);
		$url = "https://www.google.com/search?q=$keyword&source=lnms&tbm=isch&safe=strict&tbs=isz:l";

		$user_agent = 'Mozilla/5.0 (Linux; Android 10; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.72 Mobile Safari/537.36.';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		if (isset($_SERVER['HTTP_REFERER'])) {
			curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		if (!empty($proxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
  
}