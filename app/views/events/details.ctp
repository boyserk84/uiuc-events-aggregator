<?php if ( '' != $event['Event'] ) : ?>

	    		<!-- Event Details -->
              <div class="sec_wrapper">
               	<!-- Need "detail area" for displaying purpose --> 
                
                <div id="detail_area">
                <img src="pub_img/w_event_detail.png" width="334" height="69" alt="event detail" />
                	<div class="detail_box">
                  	<!-- DETAIL OF EVENT GOES HERE -->
                     <h1><?php echo $event['Event']['event_title']; ?></h1>
                     For more info: <a href="<?php echo $event['Event']['event_link']; ?>" style='font-size:14px;'>Event Website</a><br/><br/>
                     Tagged as:
					 <?php
						$tags = explode(',', $event['Event']['event_tags']);
						$tagLinks = array();
						foreach ($tags as $tag) {
							$tag = trim($tag);
							$tagLinks[] = "<a href='../search/{$tag}'>$tag</a>";
						}
						echo implode(", ", $tagLinks);
					?>
                     <br/>
                     Location: <?php echo $event['Event']['event_location']; ?><br/>
                     Date: <?php echo date('F j, Y', strtotime($event['Event']['event_datetime'])); ?><br/>
                     Time: <?php echo date('gA', strtotime($event['Event']['event_datetime'])); ?><br/>
                     <br/>
                     <?php echo $event['Event']['event_description']; ?>
                     <!-- End of EVENT DETAIL -->
                  </div>
                </div>
                <!-- START OF SIDE IMAGE DISPLAY -->
                <table width="55px" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td height="200px">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><img src="pub_img/w_event_detail02.png" width="51" height="333"  /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
				<!-- END OF SIDE IMAGE DISPLAY -->
                </div>
                
                <!-- End of Event Details -->
<?php else : echo '404'; endif; ?>
