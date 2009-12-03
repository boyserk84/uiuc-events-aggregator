<div style='padding-left:14px;padding-right:14px;'>
<h1>Search Events:</h1>
<p>Some filters will go here?</p>
<table class="event_table" cellpadding="0" cellspacing="0" align="center">
<?php
$pagination->setPaging($paging); // Initialize the pagination variables

$row = 0;
foreach ($eventList as $event) {
	$row = (1 - $row);
?>
<tr class="event_table_row<?php echo ($row+1); ?>">
	<td class="event_table_icon_cell">
		<?php echo Event::getIcons($event['Event']); ?>
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
	<td class="event_table_tags_cell">
		<?php
			$tags = explode(',', $event['Event']['event_tags']);
			$tagLinks = array();
			foreach ($tags as $tag) {
				$tag = trim($tag);
				$tagLinks[] = "<a href='/search/tag:{$tag}'>$tag</a>";
			}
			echo implode(", ", $tagLinks);
		?>
	</td>
	<td class="event_table_actions_cell">
		<?php echo $html->link('More Info', 'details/' . $event['Event']['id']); 
		if (!empty($event['Event']['event_link'])) {
			echo "<br/>" . $html->link('Event Webpage', $event['Event']['event_link']);
		}
		?>
	</td>
</tr>

<? }

 ?>
</table>

<? echo $this->renderElement('pagination'); // Render the pagination element ?> 

</div>