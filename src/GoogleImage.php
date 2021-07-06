<?php

namespace PanduanVIP\WebExtractor;

use PanduanVIP\Helpers\Please;
use RoNoLo\JsonExtractor\JsonExtractorService;  

class GoogleImage
{

    public static function get($keyword, $proxy='')
    {
        $keyword = str_replace(' ', '+', $keyword);
		$url = "https://www.google.com/search?q=$keyword&source=lnms&tbm=isch&safe=strict&tbs=isz:l";

		$userAgent = 'Mozilla/5.0 (Linux; Android 10; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.72 Mobile Safari/537.36.';
		
		$html = Please::getWebContent($url, $proxy, $userAgent);

        $results = [];

        if(!empty($html)){
		    $jsonExtractor = new JsonExtractorService();
		    $data = $jsonExtractor->extractAllJsonData($html);
        } else {
            return $results;
        }
		
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
	 
}