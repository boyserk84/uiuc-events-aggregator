<?php
define("CANOPY_CLUB", 2);
define ('ILLINI_PERFORMANCES',3); 
define ('ILLINI_SPEAKERS',4); 
define ('HIGHDIVE',5);
define ('DB_NAME',"events");
class FeedCrawler {
	public $db;
	function run($urlTarget) {

	} 
	
	function clear_table_of_source($source_id)
	{

		$query = "DELETE FROM events_raw_events WHERE source_id = ".$source_id;
		echo($query);
		mysql_query($query,$this->db) or die(mysql_error());
	}
	
	
	function connectToDatabase()
	{

	 $this->db = mysql_connect("localhost","root","");
	 mysql_select_db(DB_NAME,$this->db);
	
	}
	
	function submitEventDataToDatabase($name,$date,$time,$desc,$location,$source_id,$link,$tags)
	{

		
		$name = mysql_real_escape_string($name);
		$date = mysql_real_escape_string($date);
		$time = mysql_real_escape_string($time);

		$desc = mysql_real_escape_string(strip_tags($desc));
		$location = mysql_real_escape_string($location);
		$datetime = strtotime($date ." ". $time);

		if ($datetime < time()) 
		
		{ $datetime = mktime(
		date("G",$datetime),
		date("i",$datetime),
		date("s",$datetime),
		date("m",$datetime),
		date("d",$datetime),
		date("y",$datetime)+1);
		}
		
		$sql = "INSERT INTO `".DB_NAME."`.`events_raw_events` (`source_id`, `event_time_added_at`, `event_title`, `event_description`, `event_datetime`, `event_location`, `event_link`, `event_tags`) VALUES (".$source_id.", NOW(), '".$name."', '".$desc."', FROM_UNIXTIME(".$datetime."), '".$location."', '".$link."', '".$tags."');";
		
		echo($sql);
		mysql_query($sql,$this->db);
		 echo("***SUBMITTED***");
	}

	function submitEventDataToDatabaseTimeStamp($name,$date,$timestamp,$desc,$location,$source_id,$link,$tags)
	{
		$this->connectToDatabase();
		
		$name = mysql_real_escape_string($name);
		$date = mysql_real_escape_string($date);


		$desc = mysql_real_escape_string(strip_tags($desc));
		$location = mysql_real_escape_string($location);
		
		$link = mysql_real_escape_string($link);


		
		
		$sql = "INSERT INTO `".DB_NAME."`.`events_raw_events` (`source_id`, `event_time_added_at`, `event_title`, `event_description`, `event_datetime`, `event_location`, `event_link`, `event_tags`) VALUES (".$source_id.", NOW(), '".$name."', '".$desc."', FROM_UNIXTIME(".$timestamp."), '".$location."', '".$link."', '".$tags."');";
		
		echo($sql);
		mysql_query($sql,$this->db);
		 echo("***SUBMITTED***");
	}

	 
}

class HighDiveCrawler extends FeedCrawler {


	
	

	function run()
	{
		parent::connectToDatabase();
		
		parent::clear_table_of_source(HIGHDIVE);
		
		$urlarray = array("http://thehighdive.com/modules/calendar_ve/index.php?op=month");
		$totalevents = array();
		
		
		foreach ($urlarray as $url)
		{
			$html = $this->page_to_string($url);
			$events = $this->get_array_of_events($html);
			//$totalevents += $events; 
		}
		$totalevents = $events;
		
		foreach ($totalevents as $single)
		{
		
		 $this->submit_event_details($single);
	
		
		}
	
			
	}
	
	function page_to_string($url)
	{
		$page = file($url);  
		$buffer = implode($page); 
    	$buffer = str_replace("\n","&nbsp;",$buffer);
		return $buffer;
	}
	
	function get_array_of_events($pagehtml)
	{
		//echo($pagehtml);
	
		$regex = '/'.preg_quote('<img src="http://www.thehighdive.com/themes/highdive/hr_red.gif" width="530" height="10" alt="" />','/')
		."(.*?)(?=".preg_quote('<img src="http://www.thehighdive.com/themes/highdive/hr_red.gif" width="530" height="10" alt="" />','/').')/';
	

		preg_match_all($regex,$pagehtml,$result,PREG_PATTERN_ORDER);
		
//		print_r($result[1]);
		
		return $result[1];
	}
	
	function submit_event_details($event)
	{

	//	echo($event);
		//TITLE, LINK
		//First pattern match is event link, second is title.
		$regex_titlelink = '/'.preg_quote('<font size="+1"><strong><a href="','/').'(.*?)'.'"\>'."(.*?)"."\<\/a\>\<\/strong\>/";
		preg_match($regex_titlelink,$event,$matches);
		$details['event_link'] = $matches[1];
		$details['event_title'] = $matches[2];
	
		
		//DESCRIPTION
		$regex_desc = '/Cover\: (.*?)\<table width\="100\%" cellspacing\="0" cellpadding\="0"\>/';
		preg_match($regex_desc,$event,$matches);
		$details['event_description'] = $matches[1];
		
		//DATETIME
	
		$regex_datetime = "/".preg_quote('&nbsp;<strong>','/')."(.*?)".preg_quote("</strong>",'/').'/';
	
		
	
		preg_match($regex_datetime,$event,$matches);
		$timestr = str_replace('@','',$matches[1]);
		$details['event_datetime'] = strtotime($timestr);
		
		//LOCATION
		$details['event_location'] = "The High Dive @ 51 Main St Champaign";
		
		//TAGS
		$details['event_tags'] = "highdive,music,champaign";
	
		print_r($details);	

		//Submit event
		parent::submitEventDataToDatabase($details['event_title'],$details['event_datetime'],$details['event_datetime'],$details['event_description'],
			$details['event_location'],HIGHDIVE,$details['event_link'],$details['event_link']);
	}

}



class IllinoisPerformancesCrawler extends FeedCrawler {
	public $eventData;


	function run($cal_id)
	{
		$this->connectToDatabase();
		
		if ($cal_id == 597) //PERFORMANCES
		{
				parent::clear_table_of_source(ILLINI_PERFORMANCES);
				$source = ILLINI_PERFORMANCES;
		}
		elseif ($cal_id == 598) //SPEAKERS
		{ 
			
				parent::clear_table_of_source(ILLINI_SPEAKERS);
				$source = ILLINI_SPEAKERS;
		}
		
		
		$target_url = "http://illinois.edu/calendar/RSS?calId=".$cal_id;
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

				$event['time'] = strtotime($item->pubDate);
				$event['desc'] = $item->description;
				//$eventData[$key] = $event;

				
				parent::submitEventDataToDatabaseTimeStamp($item->title,"",$event['time'],$matches_cost[1]." ".$item->description,$matches_place[1],$source,$item->link,					($source==3?"illinois,performance":"speaker,illinois"));
							
			}
		
		}
		
	
	}


}

class CanopyClubCrawler extends FeedCrawler {

	public $eventData;


	function run() {

		parent::connectToDatabase();
		parent::clear_table_of_source(CANOPY_CLUB);
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



