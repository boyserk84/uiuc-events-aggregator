<?php
/**
 * Event model: The model of an event, as represented by
 * its data fields. This essentially corresponds directly
 * to the database.
 */
class Event extends AppModel {
	// Define a name for this model.
	var $name = 'Event';
	// CakePHP will automatically assume this model works off of
	// a database called `events`, which saves us time: we don't
	// have to write out all the fields and such for it.
	
	function findCount($conditions) {
		return $this->find('count', $conditions);
	}

	/**
	 * Get an HTML string of icons for this event.
	 */
	function getIcons($data, $limit=-1) {
		$str = "";
		$i = 0;

			
		// Iterate through tags.
		$tags = split(', ?', $data['event_tags']);
		asort($tags);
		foreach ($tags as $tag) {
			$icon = "";
			switch ($tag) {
				case 'music':
					$icon = "wmonkey_icon03_piano";
					break;
				case 'illini':
					$icon = "wmonkey_icon01_i";
					break;
				case 'christmas':
					$icon = "wmonkey_icon08_xmas";
					break;
				case 'food':
					$icon = "wmonkey_icon13_pizza";
					break;
				case 'speaker':
					$icon = "wmonkey_icon15_speak";
					break;
				case 'illinois':
					$icon = "wmonkey_icon01_i";
					break;
				case 'performance':
					$icon = "wmonkey_icon16_mic";
					break;
			}

			if ($icon != "") {
				if ($limit > 0 && $i++ >= $limit) return $str;			
				$str .= "<img src='pub_icons/" . $icon . ".gif' alt=\"$tag\" title=\"$tag\"/>";
			}
		}
		
		return $str;
	}
}



?>
