<?php

class FeedCrawler {
	function run($urlTarget) {

	}
	
}

class CanopyClubCrawler extends FeedCrawler {
	function run($urlTarget) {
		$file = implode(file('http://www.canopyclub.com/canopy.php'));
		$file = str_replace("\n","",$file);
		preg_match_all('/\<div class\=\"show\"\>(.*?)\<p class\=\"info\"\>(.*?)\<\/p\>.+?\<\/div\>/',$file,$matches);
		print_r($matches);

	}

}


$crawler = new CanopyClubCrawler();
$crawler->run('');



