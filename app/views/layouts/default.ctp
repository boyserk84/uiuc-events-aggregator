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
            </div>
        <div id="footer"></div>
    </div>
    <!-- END OF WRAPPER -->
</body>
</html>
