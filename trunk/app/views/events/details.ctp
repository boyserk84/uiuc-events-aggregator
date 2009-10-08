<!-- File: /app/views/events/details.ctp -->
<h1>Event Details</h1>
<p><?php echo $text; ?></p>
<p>Seems that the model is automatically queried, so we can try a lookup like so (though this
is the details page, so we shouldn't do this here... probably in the default controller for events in general):</p>
<p><?php foreach ($events as $event) {
echo $event['Event']['test'] . "<hr/>";
}
?></p>
