<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->css('default'); ?>
<?php echo $scripts_for_layout ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>


<body>
	<!-- START OF WRAPPER -->
	<div id="wrapper">
    	<div id="logo_head">
        	<!-- TOP OF THE PAGE LOGO HERE -->
        </div>
   	    <div id="header"></div>
        	<div class="main">
            	<!------------- DISPLAY SECTION ------------>
   			<?php echo $content_for_layout ?>         
            	<!--------- END OF DISPLAY SECTION ------------>
				
				<!------------------- MENU AND FOOTER -------------------------->
				<!-- Subscribe -->
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
                    <!-- End of Subscribe -->
                    
                    <!-- MENU -->
                    <div class="sec_wrapper">
                    	<div id="menu">
                   	    <a href="pages/add"> <img src="pub_img/w_add_button.png" width="210" height="62" /> </a>
                        <a href="pages/seeall"> <img src="pub_img/w_seeall_button.png" width="193" height="61" /> </a>
                        <a href="pages/aboutus"> <img src="pub_img/w_about_us_button.png" width="169" height="62" /> </a>
                        <a href="pages/feedback"> <img src="pub_img/w_feedback_button.png" width="190" height="62" /></div> </a>
                    </div>
                    <!-- END OF MENU -->
                    
                    <!--FOOT NOTE -->
                    <div class="sec_wrapper">
                    	<div id="footnote">
                    		Disclaimer | Privacy Policy | Terms of Service | Technical Support <br/>
                            Copyright &copy; 2009 ACM: UIUC WebMonkeys. All rights reserved. 
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
