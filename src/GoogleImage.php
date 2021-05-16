<?php

namespace PanduanVIP\WebExtractor;

use \RoNoLo\JsonExtractor\JsonExtractorService; 

class GoogleImage
{

    public static function extractor($html)
    {
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
  
}