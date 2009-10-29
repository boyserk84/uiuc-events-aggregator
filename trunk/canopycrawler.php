<?php

class FeedCrawler {
	function run($urlTarget) {

	}
	 
}

class CanopyClubCrawler extends FeedCrawler {
	function run($urlTarget) {
		$file = implode(file('http://www.canopyclub.com/canopy.php'));
		$file = str_replace("\n","",$file);
		preg_match_all('/\<div class\=\"show\"\>(.*?)\<p class\=\"info\"\>(.*?)\<\/p\>.+?\<\/div\>/',$file,$matches,PREG_PATTERN_ORDER);
		

		foreach ($matches[0] as $key=>$match)
		{
	
			//Get the image (eventually)		
			$match = str_replace("<img src=\"","<img src=\"http://www.canopyclub.com/",$match);
			$matches[$key] = $match;
	
			//Get the date
			preg_match("/\<p class=\"date\"\>(.*?)\<\/p>/",$match,$date);
			
			print_r($date[1]." ");
			
			//Get the band
			preg_match("/\<p class=\"band\"\>\<a.*?\>(.*?)\<\/a>\<\/p\>/",$match,$band);
			print_r($band[1]. "<br/>");
	
			//Get the time
			preg_match("/\<p class=\"info\"\>.*?(\d{1,2}\:\d\d\s?[ap]m).*?\<\/p\>/i",$match,$time);
			if (sizeof($time) > 1)
			print_r($time[1]. "<br/>");
	
			
			//Opening bands
			preg_match("/\<p class=\"secband\"\>(.*?)\<\/p>/",$match,$openingbands);
			if (sizeof($openingbands) > 1)
				print_r($openingbands[1] . "<br />") ;
			
			//Price
			preg_match("/\<div class=\"caltix\"\>.*?\<p\>(.*?)\<\/p\>/",$match,$price);
			if (sizeof($price) > 1)
				print_r($price[1]. "<br/>");
			
			preg_match("/onclick\=\"NewWindow\(\'showinfo\.php\?id\=(.*?)\'/",$match,$urlShow);
			if (sizeof($urlShow) > 1)
			{
				$goTo = "http://www.canopyclub.com/showinfo.php?id=".$urlShow[1];
				$file2 = implode(file($goTo));
				$file2 = str_replace("\n","",$file2);
				
				preg_match("/\<p class\=\"showcontent\"\>(.*?)\<\/p\>/",$file2,$desc);
				echo($desc[1]."<br>");
				
			}
		
		}
		
	

	}

}


$crawler = new CanopyClubCrawler();
$crawler->run('');



