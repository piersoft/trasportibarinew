<?php
$url='https://avl.amtab.it/WSExportGTFS_RT/api/gtfs/VechiclePosition';
$file=file_get_contents($url);

$csv1 = json_decode($file, TRUE);

//var_dump($csv1[0]["Id"]);


$count1=0;
foreach($csv1 as $csv11=>$data1){
  $count1 = $count1+1;
//var_dump($data1['Vehicle']['Trip']['RouteId']);

  if ($count1 >1)
  $features[] = array(
          'type' => 'Feature',
          'geometry' => array('type' => 'Point', 'coordinates' => array((float)$data1['Vehicle']['Position']['Longitude'],(float)$data1['Vehicle']['Position']['Latitude'])),
          'properties' => array('route_idr' =>$data1['Vehicle']['Trip']['RouteId'], 'trip_ids' =>$data1['Vehicle']['Trip']['TripId'], 'stop_sequence' => $data1['Vehicle']['CurrentStopSequence'], 'vehicle_id' => $data1['Vehicle']['Vehicle']['Id'])
          );
}

$allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
$geostring=json_encode($allfeatures, JSON_PRETTY_PRINT);
//echo $stop_id." ".$stop_code." ".$stop_name." ".$stop_desc." ".$lat." ".$lon;
echo $geostring;





 ?>
