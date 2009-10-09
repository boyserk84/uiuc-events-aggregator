<!-- File: /app/views/events/details.ctp -->
<h1>Event Details</h1>
<p>Seems that the model is automatically queried, so we can try a lookup like so (though this
is the details page, so we shouldn't do this here... probably in the default controller for events in general):</p>
<p>
<?php
echo $event['Event']['event_title'] . "<hr/>";
?></p>
