<?php

include('canopycrawler.php');
define("VIRGINIATHEATRE",'6');

// beginning of event: <table width="100%"  border="1" cellspacing="10" bgcolor="#C47900">

// end of event: </tr></table></td></tr></table>

//

class VirginiaTheatreCrawler extends FeedCrawler {

	function run()
	{
		parent::connectToDatabase();
		
		parent::clear_table_of_source(VIRGINIATHEATRE);
	
		//Note: Current implementation can't handle mult. pages
		$urlarray = array("http://www.thevirginia.org/calendar.htm");
		$totalevents = array();
		
		
		foreach ($urlarray as $url)
		{
			$html = $this->page_to_string($url);
		//	echo($html);
			$events = $this->get_array_of_events($html);
	
		}
		$totalevents = $events;
		
		foreach ($totalevents as $single)
		{
	//	echo($single."<hr>");
		 $this->submit_event_details($single);
	
		
		}
	
			
	}
	
	function page_to_string($url)
	{
		$page = file($url);  
		$buffer = implode($page); 
    	$buffer = str_replace("\n","<br>",$buffer);
		return $buffer;
	}
	
	function get_array_of_events($pagehtml)
	{

	
		$regex = '/'.preg_quote('<table width="100%"  border="1" cellspacing="10" bgcolor="#C47900">','/')
		."(.*?)".'\<\/table\>/';
	

		preg_match_all($regex,$pagehtml,$result,PREG_PATTERN_ORDER);
		
		return $result[1];
	}
	
	function submit_event_details($event)
	{
	//TITLE, LINK
		//Matches 1,2,4 not needed.
		$regex_title = '/valign\=\"top\"\>(.{0,10}?)\<(span|p) class\=\"?label\"?\>(.*?)\<\/(span|p)\>/';
	                  	  
		//This will probably return some 'junk' html, so we make sure to strip tags too.
		preg_match($regex_title,$event,$matches);
		if (empty($matches)) return;
		$details['event_link'] = "http://www.thevirginia.org/calendar.html";
		$details['event_title'] = strip_tags($matches[3]);
		//echo($details['event_title']."<BR>");
		
		//DESCRIPTION
		$regex_desc = '/(?<!r"\>)\<(span|p) class\="?label"?\>(.*?)\<(span|p) class\=\"style4\"\>(.*?)\<\/(span|p)\>(.*?)\<\/td\>/';
		preg_match($regex_desc,$event,$matches);
		if (empty($matches)) return;
//		print_r($matches);
		$details['event_description'] = $matches[4];
		echo(strip_tags($details['event_description'],"<br>")) . "<hr/>";
		

		//LOCATION
		$details['event_location'] = "Virginia Theatre";
		
		//TAGS
		$details['event_tags'] = "virginia, theatre";
	
				
		//DATETIME
		$regex_datetime = '/\<p class\=\".*?style2.*?\"\>\<strong\>(.*?)([a-zA-Z]+) (.+?)\, (\d+)(.*?)\<\/strong\>/';
		
		preg_match($regex_datetime,$event,$matches);
		if (empty($matches)) return;
				
		$month = $matches[2];
		$year = $matches[4];
		$days = $matches[3];
		
		$daymatches = array();
		$daysFound = array();
		if (preg_match('/(\d+) \&amp\; (\d+)/',$days,$daymatches)) { echo "AAAAAAAAAAAAAA";
			// Add two events.
			$daysFound[] = $daymatches[1];
			$daysFound[] = $daymatches[2];
		} elseif (preg_match('/(\d+)\-(\d+)/', $days, $daymatches)) {			echo "BBBBBBBBBBBBBBBBBBB";
			for ($i = $daymatches[1]; $i <= $daymatches[2]; $i++) {
				$daysFound[] = $i;
			}		
		} elseif (preg_match('/(\d+)/', $days, $daymatches)) { echo "CCCCCCCCCCCCCCC";
			$daysFound[] = $daymatches[1];
		} else echo "<hr><hr>" . $days . "</hr></hr>";
		
		foreach ($daysFound as $day) {
			
			$details['event_datetime'] = strtotime($day . ' ' . $month . ' ' . $year);

			//Submit event
			parent::submitEventDataToDatabaseTimestamp($details['event_title'],$details['event_datetime'],$details['event_datetime'],$details['event_description'],
				$details['event_location'],VIRGINIATHEATRE,$details['event_link'],$details['event_tags']); 
			
		}
	


	/*
	
	// \/ \/ \/ \/ HERE BE MONSTERS


	
	
		

		
		

		//Submit event
		parent::submitEventDataToDatabase($details['event_title'],$details['event_datetime'],$details['event_datetime'],$details['event_description'],
			$details['event_location'],HIGHDIVE,$details['event_link'],$details['event_link']); */
	}

}


$vcrawl = new VirginiaTheatreCrawler();
$vcrawl->run();





?>