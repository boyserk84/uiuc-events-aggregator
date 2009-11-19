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
	// Components and helpers needed.
    var $components = array ('Pagination'); 
    var $helpers = array('Pagination'); 

	/**
	 * Details: A function to display the details of an event.
	 */
	function details($event_id) {
		//$this->Event->event_id = $event_id;
		$this->set('event', $this->Event->findById($event_id));
	}
	
	/**
	 * Search: List events with AJAX-ified filters.
	 */
	function search() {
		//  Paginate the list.
		$conditions = array('event_datetime >=' => date('Y-m-d G:i a'));
		
		$this->Pagination->modelClass = "Event";
        list($order,$limit,$page) = $this->Pagination->init($conditions, array('show' => 15)); // Added

		$list = $this->Event->find('all', array('conditions' => $conditions, 'order' => array($order), 'limit' => $limit, 'page' => $page));

		$this->set('eventList',$list);
	}
	
	/**
	 * Add: Display form for adding events.
	 */
	function add() {
	
	}
}


?>
