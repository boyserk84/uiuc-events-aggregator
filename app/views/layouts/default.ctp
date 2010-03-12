<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->css('default'); ?>
<?php echo $scripts_for_layout ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MEvent - ACM Webmonkeys @ UIUC</title>
</head>


<body>
	<!-- START OF WRAPPER -->
	<div id="wrapper">
    	<div id="logo_head">
        	<!-- TOP OF THE PAGE LOGO HERE -->
			<?php echo $html->link('<img src="pub_img/logo_mevent.png" alt="mEvent brought to you by ACM UIUC Webmonkeys (Fall 2009)" />', '/', array('escape' => false)); ?>
        </div>
   	    <div id="header"></div>
        	<div class="main">
            	<!------------- DISPLAY SECTION ------------>
   			<?php echo $content_for_layout ?>         
            	<!--------- END OF DISPLAY SECTION ------------>
				
				<!------------------- MENU AND FOOTER -------------------------->
				<!-- Subscribe
                    <div class="sec_wrapper">
                    		<div class="subscribe_area">
                            	
                           	    <img src="pub_img/w_subscribe.png" width="401" height="43" align="left" />
                                <div class="search_box">
                                  <form id="form1" name="form1" method="post" action="">
                                  	<input name="email" type="text" size="25" maxlength="100" />
                                    <input type="submit" name="subscribe" value="Subscribe" />
                                  </form>
                                </div>
                      		</div>
                    </div>
                    End of Subscribe -->
                    
                    <!-- MENU -->
                    <div class="sec_wrapper">
                    	<div id="menu">
				<?php echo $html->link('<img src="pub_img/w_add_button.png" width="210" height="62" />', '/events/add', array('escape'=>false)); ?>
				<?php echo $html->link('<img src="pub_img/w_seeall_button.png" width="193" height="61" />', '/events/search/', array('escape'=>false)); ?>
				<?php echo $html->link('<img src="pub_img/w_about_us_button.png" width="169" height="62" />', '/pages/aboutus', array('escape'=>false)); ?>
				<?php echo $html->link('<img src="pub_img/w_feedback_button.png" width="190" height="62" />', '/pages/feedback', array('escape'=>false)); ?>
                        </div>
                    </div>
                    <!-- END OF MENU -->
                    
                    <!--FOOT NOTE -->
                    <div class="sec_wrapper">
                    	<div id="footnote">
                    		<?php echo $html->link('Disclaimer', '/pages/disclaimer', array('escape'=>false)); ?> | 
							<?php echo $html->link('Privacy Policy', '/pages/privacy', array('escape'=>false)); ?> | 
							<?php echo $html->link('Terms of Service', '/pages/tos', array('escape'=>false)); ?> | <a href="mailto:webmonkeys@acm.uiuc.edu "> Technical Support </a> <br/>
                            Copyright &copy; 2010 ACM: UIUC WebMonkeys. All rights reserved. 
                    	</div>
                    </div>
                    <!-- END OF FOOT NOTE-->
            </div>
			
			<!---------------------- END OF MENU AND FOOTER ---------------------------------->
        <div id="footer"></div>
    </div>
    <!-- END OF WRAPPER -->
</body>
</html>
