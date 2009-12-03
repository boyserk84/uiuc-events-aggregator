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
   
}

?>
