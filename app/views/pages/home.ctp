<!-- File: app/views/pages/home.ctp -->
<h1>Welcome!</h1>
This is the home template, home.ctp, loaded into the default layout. The default layout has 
a bunch of stuff to help build an application, like the parameters thing that would go below this, so we might 
keep it around for a bit. If we wanted the home page to do anything, we'd need to add HomeController.
<br/>
</br>
<?php echo $html->link('Test','/events/details/1'); ?>
