<?php 

include("./canopycrawler.php");
include("./raweventprocessor.php");
//Call canopy crawler.
$crawler = new CanopyCrawler();
$crawler->run();


//Data's been fed into raw table, now process it.
$processor = new RawEventProcessor();
$processor->run();


?>