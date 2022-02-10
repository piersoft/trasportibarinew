<?php

$lineid = htmlspecialchars($_GET['lineid']);
$veicid = htmlspecialchars($_GET['veicid']);

$url='https://avl.amtab.it/WSExportGTFS_RT/api/gtfs/TripUpdates?lineid='.$lineid.'&vehicleId='.$veicid;
$file=file_get_contents($url);

$csv1 = json_decode($file, TRUE);

//var_dump($csv1['Entities'][0]['TripUpdate']['StopTimeUpdates'][0]['StopSequence']);
//var_dump($csv1['Entities'][0]['TripUpdate']['StopTimeUpdates'][0]['Arrival']['Delay']);
//var_dump($csv1['Entities'][0]['TripUpdate']['Trip']['TripId']);

echo "Arrivo reale: ".$csv1['Entities'][0]['TripUpdate']['StopTimeUpdates'][0]['Arrival']['Delay']." minuti\n</br>";
//echo "Fermata in sequenza: ".$csv1['Entities'][0]['TripUpdate']['StopTimeUpdates'][0]['StopSequence']."\n</br>";
//echo "TripID: ".$csv1['Entities'][0]['TripUpdate']['Trip']['TripId']."\n</br>";

$tripid=$csv1['Entities'][0]['TripUpdate']['Trip']['TripId'];

$sequid=$csv1['Entities'][0]['TripUpdate']['StopTimeUpdates'][0]['StopSequence'];

$url="gtfs/stop_times.txt";
$inizio=0;
$fermata ="";
$orarioprevisto="";
//  echo $url;
$csv = array_map('str_getcsv', file($url));
//var_dump($csv[1][5]);
$count = 0;
$count1 = 0;
//  $trip_id="0";
//  $service_id="0";
//  $route_id="0";
foreach($csv as $data=>$csv1){
//  if ($csv[0][$count]=="trip_id") $trip_id=$count;
//  if ($csv[0][$count]=="service_id") $service_id=$count;
//  if ($csv[0][$count]=="route_id") $route_id=$count;

if ($csv[$count][0]==$tripid) {
  $count1++;
  //  var_dump($csv[$count][4]);
    if ($csv[$count][4]==$sequid){
        echo "Fermata: " .$csv[$count][5]."\n</br>";
        echo "Arrivo Pianificato: " .$csv[$count][1]."\n</br>";
    }



  }

  $count++;

}






?>
