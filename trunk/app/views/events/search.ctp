<div style='padding-left:14px;padding-right:14px;'>
<h1>Search Events:</h1>
<p>Some filters will go here?</p>
<table class="event_table" cellpadding="0" cellspacing="0" align="center">
<?php
$row = 0;
foreach ($eventList as $event) {
	$row = (1 - $row);
?>
<tr class="event_table_row<?php echo ($row+1); ?>">
	<td class="event_table_icon_cell">
		Icons
	</td>
	<td class="event_table_title_cell">		
		<?php echo $event['Event']['event_title']; ?>	
	</td>
	<td class="event_table_location_cell">
		<?php echo $event['Event']['event_location']; ?>	
	</td>
	<td class="event_table_datetime_cell">
		<?php echo $event['Event']['event_datetime']; ?>	
	</td>
	<td class="event_table_actions_cell">
		<?php echo $html->link('More Info', 'events/details/' . $event['Event']['event_id']); 
		if (!empty($event['Event']['event_link'])) {
			echo "<br/>" . $html->link('Event Webpage', $event['Event']['event_link']);
		}
		?>
	</td>
</tr>

<? } ?>
</table>
</div>