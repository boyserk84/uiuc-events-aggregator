<?php 

include("./canopycrawler.php");
include("./raweventprocessor.php");
//Call canopy crawler.
$crawler = new CanopyClubCrawler();
$crawler->run();

$crawler = new IllinoisPerformancesCrawler();
$crawler->run();

//Data's been fed into raw table, now process it.
$processor = new RawEventProcessor();
$processor->run(2);
$processor->run(3);


?>