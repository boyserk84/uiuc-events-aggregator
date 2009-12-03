<?php

class PagesController extends AppController {

   var $uses = array();

   public function home() {
      $this->eventModel = ClassRegistry::init('Event');

  		$conditions = array('event_datetime >=' => date('Y-m-d G:i a'));
		$list = $this->eventModel->find('all', array('conditions' => $conditions, 'limit' => 10));
		$this->set('upcomingList',$list);

		$list = $this->eventModel->find('all', array('order' => 'event_time_added_at DESC', 'limit' => 6));
		$this->set('recentList',$list);

   }
   
   
 /**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title'));
		$this->render(join('/', $path));
	}
 
   
}

?>
