<?php 
set_time_limit(0);
include("./canopycrawler.php");
include("./raweventprocessor.php");
//Call canopy crawler.
$crawler = new CanopyClubCrawler();
$crawler->run();

$crawler = new IllinoisPerformancesCrawler();
$crawler->run(597,ILLINI_PERFORMANCES,"performances");
$crawler->run(598,ILLINI_SPEAKERS,"speakers");
$crawler->run(976,TEC_EVENTS,"TEC,technology,entrepreneurship,center");
$crawler = new HighDiveCrawler();
$crawler->run(); 

//Data's been fed into raw table, now process it.
$processor = new RawEventProcessor();

//Canopy Club
$processor->run(2);

$processor->run(3);
$processor->run(4);
$processor->run(6);

//High Dive
$processor->run(5);


?>