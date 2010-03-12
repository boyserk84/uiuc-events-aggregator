<div style='padding-left:14px;padding-right:14px;'>
<h1><span class="headerhl">Search</span> Events:</h1>
<?php
if ($tagmsg != '') {
	echo "<div class='tagmsg'>$tagmsg <a href='.'>[Remove tag filter]</a></div>";
}
?>
<div class="search">
  <form id="search" name="search" method="post" action="">
	<span class="hint">Enter a few keywords to refine your search:</span> <input name="search_text" type="text" size="30" maxlength="150" />
		<input name="search" type="submit" value="Search!" />
  </form>
</div>

<? echo $this->renderElement('pagination'); // Render the pagination element ?> 

<table class="event_table" cellpadding="0" cellspacing="0" align="center">
<?php
$pagination->setPaging($paging); // Initialize the pagination variables

$row = 0;
foreach ($eventList as $event) {
	$row = (1 - $row);
?>
<tr class="event_table_row<?php echo ($row+1); ?>" onmouseover="this.setAttribute('class','event_table_row3');" onmouseout="this.setAttribute('class','event_table_row<?php echo ($row+1); ?>');">
	<td class="event_table_icon_cell" width="64">
		<?php echo Event::getIcons($event['Event']); ?>
	</td>
	<td class="event_table_title_cell" onclick="window.location='../details/<?php echo $event['Event']['id']; ?>';">		
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
				$tagLinks[] = "<a href='{$tag}'>$tag</a>";
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
