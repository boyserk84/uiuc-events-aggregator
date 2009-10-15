<?php
/**
 * EventsController: Controller to manage event tasks. This lets us
 * abstract the event-specific logic from the application so we
 * can write cleaner code elsewhere. Also, we can use this controller
 * to define event-related pages: so, when we define a function called
 * "details", a user could go to blahblahblah.com/events/details/83.
 */
class EventsController extends AppController {
	// Define a name.
	var $name = 'Events';

	/**
	 * Details: A function to display the details of an event.
	 */
	function details($event_id) {
		//$this->Event->event_id = $event_id;
		$this->set('event', $this->Event->findByEventId($event_id));
	}
	
	/**
	 * List: List events with AJAX-ified filters.
	 */
	function list() {
		
	}
	
	/**
	 * Add: Display form for adding events.
	 */
	function add() {
	
	}
}


?>
