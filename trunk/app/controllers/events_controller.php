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
    var $components = array ('Pagination', 'RequestHandler'); 
    var $helpers = array('Pagination', 'Xml'); 

	
	
	/**
	 * Details: A function to display the details of an event.
	 */
	function details($event_id) {
		//$this->Event->event_id = $event_id;
		$this->set('event', $this->Event->findById($event_id));
	}
	
	
	/**
	 * XML version of feed.
	 */
	function xml($tag='') {	
		$this->layout = 'xml\default';
		$this->RequestHandler->respondAs('xml');
		$this->set('data', $this->Event->find('all'));
	}
	
	/**
	 * Search: List events with AJAX-ified filters.
	 */
	function search($tag='') {
		App::import('Sanitize'); 
		// Order by date, for now.
		$conditions = array('event_datetime >=' => date('Y-m-d'));
		$this->set('tagmsg', "");		
				
		// Add search conditions.
		if ( $tag != '') {
			$this->set('tagmsg', "Filtering by tag: <b>$tag</b>");
			$conditions[] = "event_tags LIKE '%$tag%'";
		}
		if ( array_key_exists('search', $_REQUEST) && $_REQUEST['search'] != '' ) {
			$search = Sanitize::escape($_REQUEST['search']);
			$terms = split('/[ ,;]/', $search);
		
			foreach ($terms as $term) {
				$conditions[] = "(event_title LIKE '%$term%' OR MATCH(event_description) AGAINST('$term') OR MATCH(event_location) AGAINST('$term'))";
			}
		
		}
		


		
		// Paginate.
		$this->Pagination->modelClass = "Event";
        list($order,$limit,$page) = $this->Pagination->init($conditions, array('show' => 15)); // Hard-coded...

		$list = $this->Event->find('all', array('conditions' => $conditions, 'order' => 'event_datetime ASC', 'limit' => $limit, 'page' => $page));

		$this->set('eventList',$list);
	}
	
	/**
	 * Add: Display form for adding events.
	 */
	function add() {
		App::import('Sanitize'); 
		
		if (array_key_exists('title', $_POST)) {
			$errors = array();
			
			/* Get data. */
			$submitter = $_POST['name'];
			$email = $_POST['email'];
			$title = Sanitize::escape($_POST['title']);
			$desc = Sanitize::escape($_POST['description']);
			$url = Sanitize::escape($_POST['url']);
			$tags = Sanitize::escape($_POST['tags']);
			$location = Sanitize::escape($_POST['location']);
			if (empty($title) || empty($location)) {
				$errors[] = "You must specificy a title and location.";
			}
			if (empty($desc)) {
				$errors[] = "You must specify a description.";
			}
			
			$month = (int)($_POST['month']);
			$day = (int)($_POST['day']);
			$year = (int)($_POST['year']);
			$hour = (int)($_POST['hour']);
			$min = (int)($_POST['min']);
			if (!$day || !$year || !$month || !$hour) {
				$errors[] = "Invalid date.";
			}
			
			// Convert hour to 24-hour format.
			if ($hour == 12) {
				$hour = 0;
			}
			
			$time = $_POST['time'];
			if ($time == "PM") {
				$hour += 12;
			}
			
			$url = Sanitize::escape($_POST['url']);
			$description = Sanitize::escape(strip_tags($_POST['description']));
			
			if (sizeof($errors) > 0) {
				$errorlist = 'The following errors occurred: <br/><ul><li>' . implode('<li>',$errors) . '</ul>';
				$this->set('errormsg', $errorlist);
			} else {
				// Insert.
				$datetime = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $min;
				
				$this->Event->create();
				$this->Event->save(array(
					'event_title' =>  $title,
					'event_description' => $desc,
					'event_location' => $location,
					'event_datetime' => $datetime,
					'event_link' => $url,
					'event_time_added_at' => date('Y-m-d g:i'),
					'event_tags' => $tags
					));
					
				$this->set('errormsg', 'Event added successfully -- thank you!');
			}
		}
	}
}


?>
