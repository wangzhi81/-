<?php
$myfile = fopen("/www/wwwroot/thinkphp/public/zy.csv", "r") or die("Unable to open file!");
// 输出单行直到 end-of-file
while(!feof($myfile)) {
  $str =  fgets($myfile);
  $ex = explode(',',$str);
  $region = getval($ex,0);
  $street = getval($ex,1); 
  $lane_village = getval($ex,2); 
  $residential_quarters = getval($ex,3); 
  $street_name = getval($ex,4); 
  //echo getval($ex,3); 
  foreach ($ex as $key => $value) {
      if($key>4){
          $building_number = mb_convert_encoding($value, "UTF-8", "GBK"); 
          if($building_number!=''){
              echo $building_number.'<br>';
          }
          break;
      }
      //echo $key;
      //echo mb_convert_encoding($value, "UTF-8", "GBK"); 
      
  }
}
fclose($myfile);

function getval($ex,$i){
    return mb_convert_encoding($ex[$i], "UTF-8", "GBK"); 
}
?>