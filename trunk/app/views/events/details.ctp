<!-- File: /app/views/events/details.ctp -->
<?php
echo $event['Event']['event_title'] . "<br />";
echo $event['Event']['event_description'] . "<br />";
$datetime =new DateTime($event['Event']['event_datetime']); 
echo date_format($datetime,"n/j/y") . "<br />";
echo date_format($datetime,"g:i a") . "<br />";
echo $event['Event']['event_location'] . "<br />";
echo "<a href='".$event['Event']['event_link']."'>".$event['Event']['event_link'] . "</a><br />";
echo $event['Event']['event_tags'];
?></p>
