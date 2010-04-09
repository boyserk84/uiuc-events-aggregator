<?php 
set_time_limit(0);
include("./canopycrawler.php");
include("./raweventprocessor.php");
//Call canopy crawler.
$crawler = new CanopyClubCrawler();
$crawler->run();

$crawler = new IllinoisPerformancesCrawler();
$crawler->run(597);
$crawler->run(598);

$crawler = new HighDiveCrawler();
$crawler->run(); 

//Data's been fed into raw table, now process it.
$processor = new RawEventProcessor();

//Canopy Club
$processor->run(2);

$processor->run(3,ILLINI_PERFORMANCES,"performances");
$processor->run(4,ILLINI_SPEAKERS,"speakers");
$processor->run(4,ILLINI_SPEAKERS,"TEC,technology,entrepreneurship,center");

//High Dive
$processor->run(5);


?>