<?php
    include_once('/www/wwwroot/kod.wangzhi81.com/tests/PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');
    include_once('/www/wwwroot/kod.wangzhi81.com/public/CRM/control/pdo.php');
    $PHPReader = new \PHPExcel_Reader_Excel5();
    $objPHPExcel = $PHPReader->load("/www/wwwroot/kod.wangzhi81.com/tests/test.xls");
    $sheet = $objPHPExcel->getSheet(0);
    $allRow = $sheet->getHighestRow();
    for ($j=2; $j <= $allRow; $j++) {
        $display_order =sprintf("%05d", $j-1);
        $region = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();
        $street = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();
        $lane_village = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();
        $residential_quarters = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();
        $street_name = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();
        $building_number = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();
        $access_mode = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();
        $sql = "delete from broadband_installation_resources where region='$region' and street='$street' and lane_village='$lane_village' and residential_quarters='$residential_quarters' and street_name='$street_name' and building_number='$building_number' ";
        pdoexec($sql);
        $sql = "insert into broadband_installation_resources(BROADBAND_INSTALLATION_RESOURCES_ID,region,street,lane_village,residential_quarters,street_name,building_number,access_mode,display_order,last_time) values(uuid(),'$region','$street','$lane_village','$residential_quarters','$street_name','$building_number','$access_mode','$display_order',now())";
        pdoexec($sql);
        //echo $sql;
        echo sprintf("%d",$j/$allRow*100)."%\n";
    }