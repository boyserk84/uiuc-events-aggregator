<?php
define ('ILLINI_PERFORMANCES',3);
class FeedCrawler {
	public $db;
	function run($urlTarget) {

	} 
	
	function connectToDatabase()
	{
	 $this->db = mysql_connect("localhost","root","");
	}
	
	function submitEventDataToDatabase($name,$date,$time,$desc,$location,$source_id,$link,$tags)
	{
		$this->connectToDatabase();
		$name = mysql_real_escape_string($name);
		$date = mysql_real_escape_string($date);
		$time = mysql_real_escape_string($time);
		$desc = mysql_real_escape_string(strip_tags($desc));
		$location = mysql_real_escape_string($location);
		$datetime = strtotime($date ." ". $time);
		
		
		$sql = "INSERT INTO `events`.`events_raw_events` (`source_id`, `event_time_added_at`, `event_title`, `event_description`, `event_datetime`, `event_location`, `event_link`, `event_tags`) VALUES (".$source_id.", NOW(), '".$name."', '".$desc."', FROM_UNIXTIME(".$datetime."), '".$location."', '".$link."', '".$tags."');";
		
		echo($sql);
		mysql_query($sql,$this->db);
		 
	}
	 
}

class IllinoisPerformancesCrawler extends FeedCrawler {
	public $eventData;

	function clear_table_of_source($source_id)
	{
		$source_id = 3;
		$query = "DELETE FROM events_raw_events WHERE source_id = ".$source_id;
		mysql_query($query,$this->db);
	}
	
	function run()
	{
		$this->connectToDatabase();
		$this->clear_table_of_source(ILLINI_PERFORMANCES);
		
		
		$target_url = "http://illinois.edu/calendar/RSS?calId=597";
		$file = implode(file($target_url));
		$file = str_replace("\n","",$file);		
		
		$element = simplexml_load_string($file);
		$child = $element->channel;
		
		foreach($child->children() as $item)
		{
		

			if ($item->title != "")
			{
				echo("<hr>");
				//print_r($item->children());
				echo("Title:".$item->title);
				

				$file = implode(file($item->link));
				$file = str_replace("\n","",$file);
		
				preg_match("/<td class\=\"edu\-uiuc\-webservices\-calendar\-category\"\>Location\<\/td\>\<td\>\&nbsp\;\<\/td\>\<td class\=\"edu\-uiuc\-webservices\-calendar\-info\"\>(.+?)\<\/td\>/",$file,$matches_place);
		
		
				preg_match("/<td class\=\"edu\-uiuc\-webservices\-calendar\-category\"\>Cost\<\/td\>\<td\>\&nbsp\;\<\/td\>\<td class\=\"edu\-uiuc\-webservices\-calendar\-info\"\>(.+?)\<\/td\>/",$file,$matches_cost);
		
				//Add event to eventData.
				
				//global $eventData;

				$event['time'] = strtotime($item->date);
				$event['desc'] = $item->description;
				//$eventData[$key] = $event;

				
				parent::submitEventDataToDatabase($item->title,"",$event['time'],$matches_cost[1]." ".$item->description,$matches_place[1],ILLINI_PERFORMANCES,$item->link,					"illini,performance");
							
			}
		
		}
		
	
	}


}

class CanopyClubCrawler extends FeedCrawler {

	public $eventData;


	function clear_table_of_source($source_id)
	{
		$source_id = (int)$source_id;
		$query = "DELETE FROM events_raw_events WHERE source_id = ".$source_id;
		mysql_query($query,$this->db);
	}
	
	
	function run($urlTarget) {
	
		$this->clear_table_of_source(2);
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
			
			//print_r($date[1]." ");
			$d_date = $date[1];
			
			//Get the band
			preg_match("/\<p class=\"band\"\>\<a.*?\>(.*?)\<\/a>\<\/p\>/",$match,$band);
			//print_r($band[1]. "<br/>");
			$d_band = $band[1];
	
			//Get the time
			$d_time = "";
			preg_match("/\<p class=\"info\"\>.*?(\d{1,2}\:\d\d\s?[ap]m).*?\<\/p\>/i",$match,$time);
			if (sizeof($time) > 1)
				$d_time = $time[1];
	
			
			//Opening bands
			preg_match("/\<p class=\"secband\"\>(.*?)\<\/p>/",$match,$openingbands);
			$d_opening = "";
			if (sizeof($openingbands) > 1)
				//print_r($openingbands[1] . "<br />") ;
				$d_opening = $openingbands[1];
			
			//Price
			preg_match("/\<div class=\"caltix\"\>.*?\<p\>(.*?)\<\/p\>/",$match,$price);
			$d_price = "";
			if (sizeof($price) > 1)
				//print_r($price[1]. "<br/>");
				$d_price = $price[1];
			
			//Description
			preg_match("/onclick\=\"NewWindow\(\'showinfo\.php\?id\=(.*?)\'/",$match,$urlShow);
			if (sizeof($urlShow) > 1)
			{
				$goTo = "http://www.canopyclub.com/showinfo.php?id=".$urlShow[1];
				$file2 = implode(file($goTo));
				$file2 = str_replace("\n","",$file2);
				
				preg_match("/\<p class\=\"showcontent\"\>(.*?)\<\/p\>/",$file2,$desc);
				//echo($desc[1]."<br>");
				$d_desc = $desc[1];
				
			}
			
			//Add event to eventData.
		global $eventData;
		$event['name'] = $d_band;
		if($d_opening != '') $event['name'] .= " with " . $d_opening;
		$event['date'] = $d_date;
		$event['time'] = $d_time;
		$event['price'] = $d_price;
		$event['location'] = "Canopy Club";
		$event['desc'] = $d_desc;
		$eventData[$key] = $event;
		$this->submitEventDataToDB($event);
		
		
		}
	
		
	}
	
	function submitEventDataToDB($event)
	{
		parent::submitEventDataToDatabase($event['name'],$event['date'],$event['time'],$event['price'].": ".$event['desc'],$event['location'],2,"http://www.canopyclub.com","canopy, club, music");
	}

}



