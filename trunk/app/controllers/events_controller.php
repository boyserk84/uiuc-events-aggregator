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
	function details() {
		// Set some static data for the Events view to use when displaying this page.
		$this->set('text', 'stuff goes here.');

		// We automatically have the Event variable set to the Event model,
		// so now we just call the find() method (which the model inherited
		// from AppModel) to get a listing of events.
		$this->set('events', $this->Event->find('all'));
	}
}


?>
