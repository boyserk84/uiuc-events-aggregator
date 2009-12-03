<?php

define("CANOPY_CLUB", 2);
define("ILLINI_PERFORMANCES",3);
class RawEventProcessor
{

	public $db;
	
	function run($source_id)
	{
		$this->db = 0;
		$this->connectToDatabase();
		
		//Clear all events with the current source id
		$this->clear_table_of_source($source_id);
		//Insert events with this source id into the events table, from the raw events table.
		$this->process_events($source_id);
		
	
	} 

	function clear_table_of_source($source_id)
	{
		$source_id = (int)$source_id;
		$query = "DELETE FROM events_events WHERE source_id = ".$source_id;
		mysql_query($query,$this->db);
	}
	
	function process_events($source_id)
	{
		switch ($source_id)
		{
			case CANOPY_CLUB:	
				$this->insert_data_directly_from_source($source_id);
				break;
			case ILLINI_PERFORMANCES:
				$this->insert_data_directly_from_source($source_id);
				break;
		
		}
	}
	
	function insert_data_directly_from_source($source_id)
	{
		$query = "INSERT INTO events_events (source_id,event_time_added_at,"
				. "event_title, event_description, event_datetime, event_location, "
				. "event_link, event_tags)"
				. " SELECT rr.source_id,rr.event_time_added_at,rr.event_title,rr.event_description,"
				. " rr.event_datetime, rr.event_location, rr.event_link, rr.event_tags"
				. " FROM events_raw_events AS rr WHERE rr.source_id=".$source_id;
		echo($query);
		mysql_query($query,$this->db);
	}

	function connectToDatabase()
	{
	 $this->db = mysql_connect("localhost","root","");
	 mysql_select_db("events",$this->db);
	}


}



?>
