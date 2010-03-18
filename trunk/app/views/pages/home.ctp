				<!-- Most Recent Events and Highlight -->
				<div class="sec_wrapper">
                    	<div class="recent_section">
                       	  <img src="pub_img/w_most_recent.png" width="369" height="58" />
                        	<div class="recent_box">
                               <!-- RECENT CONTENT GOES HERE -->


                        <table class="recent_event_table" cellpadding="0" cellspacing="0" align="center">
                        <?php
                        foreach ($recentList as $key => $event) {
                           $row = ( $key == (sizeof($recentList)-1) ) ? 2 : 1;
                        ?>
                        <tr class="recent_event_table_row<?php echo $row; ?>">
                           <td class="recent_event_table_icon_cell">
                              <?php echo Event::getIcons($event['Event'],1); ?>
                           </td>
                           <td class="recent_event_table_title_cell">		
                              <?php echo substr($event['Event']['event_title'],0,50); ?>	
                           </td>
                           <td class="recent_event_table_location_cell">
                              <?php echo substr($event['Event']['event_location'],-51,51); ?>	
                           </td>
                           <td class="recent_event_table_datetime_cell">
                              <?php echo $event['Event']['event_datetime']; ?>	
                           </td>
                           <td class="recent_event_table_actions_cell">
                              <?php echo $html->link('More Info', '/events/details/' . $event['Event']['id']); 
                              if (!empty($event['Event']['event_link'])) {
                                 echo "<br/>" . $html->link('Event Webpage', $event['Event']['event_link']);
                              }
                              ?>
                           </td>
                        </tr>

                        <? }

                         ?>
                        </table>


							   
                        	</div>
                        </div>
          			<div class="hl_section">
           				<div class="hl_box">
                            	<!-- HIGHLIGHT CONTENT GOES HERE -->
						<a href='events/details/100'><img src="pub_img/il_ads.png" /></a>
                           	</div>
					
                        	<img src="pub_img/w_highlight_side.png" width="61" height="391" />
                        </div>
                   </div>
                   <!-- End of Most Recent Events-->
                   
                   <!-- Search Section -->
                     <div class="sec_wrapper">
                    	<div class="search_section">
                        	<img src="pub_img/w_search.png" width="393" height="54" align="left" />
                        	<div class="search_box">
                        	  <form id="search" name="search" method="get" action="events/search">
                              		<input name="search" type="text" size="30" maxlength="150" />
                                    <input name="searchs" type="submit" value="Search Event" />
                      	      </form>
                   	        </div>
             		 </div></div>
                    <!-- End of Search Section-->
                    
                    <!-- Upcoming events -->
                    <div class="sec_wrapper">
                    	<div class="upcoming_area"><img src="pub_img/w_upcoming_side.png" width="64" height="307" align="left"/>
							 <div class="upcoming_box">

                        <table class="event_table" cellpadding="0" cellspacing="0" align="center">
                        <?php
                        $row = 0;
                        foreach ($upcomingList as $event) {
                           $row = (1 - $row);
                        ?>
				<tr class="event_table_row<?php echo ($row+1); ?>" onmouseover="this.setAttribute('class','event_table_row3');" onmouseout="this.setAttribute('class','event_table_row<?php echo ($row+1); ?>');">
                           <td class="event_table_icon_cell" width="64">
                              <?php echo Event::getIcons($event['Event']); ?>
                           </td>
                           <td class="event_table_title_cell" onclick="window.location='events/details/<?php echo $event['Event']['id']; ?>';">		
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
                                    $tagLinks[] = "<a href='events/search/{$tag}'>$tag</a>";
                                 }
                                 echo implode(", ", $tagLinks);
                              ?>
                           </td>
                           <td class="event_table_actions_cell">
                              <?php echo $html->link('More Info', '/events/details/' . $event['Event']['id']); 
                              if (!empty($event['Event']['event_link'])) {
                                 echo "<br/>" . $html->link('Event Webpage', $event['Event']['event_link']);
                              }
                              ?>
                           </td>
                        </tr>

                        <? }

                         ?>
                        </table>

					<div class='moreevents'>
						<a href='events/search/'>See more events &gt;&gt;</a>
					</div>
                      	
                             	
                             </div>
                        </div>
              		</div>
                    <!-- End of upcoming events -->
