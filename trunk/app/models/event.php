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
}


?>
