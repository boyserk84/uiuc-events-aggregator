<?php 
set_time_limit(0);
include("./canopycrawler.php");
include("./raweventprocessor.php");
//Call canopy crawler.
$crawler = new CanopyClubCrawler();
$crawler->run();

$crawler = new IllinoisPerformancesCrawler();
$crawler->run(597);
echo("***************************<hr>@@@<hr><hr><hr><hr>");
$crawler->run(598);
echo("***************************<hr><hr><hr><hr><hr>");
//Data's been fed into raw table, now process it.
$processor = new RawEventProcessor();
$processor->run(2);
$processor->run(3);
echo("***************************<hr><hr><hr><hr><hr>");
$processor->run(4);


?>