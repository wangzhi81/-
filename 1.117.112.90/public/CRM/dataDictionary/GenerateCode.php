<?php
    session_start();
    error_reporting(E_ALL^E_NOTICE^E_WARNING);
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $ENTITY_CODE = getOne("SELECT ENTITY_CODE FROM `entity` where ENTITY_UUID='".Q($_GET['id'])."'");
    $ENTITY_NAME = getOne("SELECT ENTITY_NAME FROM `entity` where ENTITY_UUID='".Q($_GET['id'])."'");
    $file = new SplFileObject("ModelExample.php", 'r+');  
    $ModelExample = "";
    while (!$file->eof()) {  
        $ModelExample .= $file->current();  
        $file->next();  
    }
    //关闭文件对象  
    $file = null;  
    //驼峰标识
    $ENTITY_CODE_CU = convertUnderline($ENTITY_CODE);
    //首字母大写标识
    $ENTITY_CODE_UC = ucfirst(strtolower($ENTITY_CODE_CU));
    //小写标识
    $ENTITY_CODE_LO = strtolower($ENTITY_CODE_CU);
    //ID标识
    $IDBISOSHI = $ENTITY_CODE."_ID";
    $ModelExample = str_replace("{ModelName}",convertUnderline($ENTITY_CODE),$ModelExample);
    $ModelExample = str_replace("{ModelId}",$ENTITY_CODE."_ID",$ModelExample);
    $ModelExample = str_replace("{TableName}",strtolower($ENTITY_CODE),$ModelExample);
    function convertUnderline( $str , $ucfirst = true)
    {
        $str = strtolower($str);
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$str);
        return $ucfirst ? ucfirst($str) : $str;
    }
    mkdir("shengcheng/".$ENTITY_CODE_CU,0777);
    mkdir("shengcheng/".$ENTITY_CODE_CU."/model");
    mkdir("shengcheng/".$ENTITY_CODE_CU."/controller");
    mkdir("shengcheng/".$ENTITY_CODE_CU."/js");
    $model_path = "shengcheng/".$ENTITY_CODE_CU."/model";
    $controller_path = "shengcheng/".$ENTITY_CODE_CU."/controller";
    $view_path = "shengcheng/".$ENTITY_CODE_CU."/view";
    mkdir($view_path);
    $js_path = "shengcheng/".$ENTITY_CODE_CU."/js";
    file_put_contents($model_path."/".$ENTITY_CODE_CU.".php",$ModelExample);
    //控制器
    $file = new SplFileObject("ControllerEx.php", 'r+');  
    $ControllerEx = "";
    while (!$file->eof()) {  
        $ControllerEx .= $file->current();  
        $file->next();  
    }
    $ControllerEx = str_replace("Broadbandpackage",$ENTITY_CODE_UC,$ControllerEx);
    $ControllerEx = str_replace("BroadbandPackage",$ENTITY_CODE_CU,$ControllerEx);
    $ControllerEx = str_replace("BROADBAND_PACKAGE_ID",$IDBISOSHI,$ControllerEx);
    $ControllerEx = str_replace("broadbandpackage",$ENTITY_CODE_LO,$ControllerEx);
    $ControllerEx = str_replace("宽带套餐",$ENTITY_NAME,$ControllerEx);
    //表头
    $attributes = pdoquery("select * from attribute where ENTITY_UUID='".Q($_GET['id'])."' order by SerialNumber");
    $biaotou = "";
    foreach ($attributes as $key => $value) {
        $biaotou .= '"'.$value['FIELD_NAME'].'",';
    }
    $biaotou .= ")";
    $ControllerEx = str_replace("{TableHeader}",$biaotou,$ControllerEx);
    //字段
    $ziduan = '"'.$IDBISOSHI.'",';
    foreach ($attributes as $key => $value) {
        $ziduan .= '"'.$value['FIELD_CODE'].'",';
    }
    $ziduan .= ')';
    $ControllerEx = str_replace("{Fields}",$ziduan,$ControllerEx);
    $ControllerEx = str_replace(",)","",$ControllerEx);
    file_put_contents($controller_path."/".$ENTITY_CODE_UC.".php",$ControllerEx);
    
    //添加视图
    $addhtmlEx = '';
    $file = new SplFileObject("addhtmlEx.php", 'r+');  
    while (!$file->eof()) {  
        $addhtmlEx .= $file->current();  
        $file->next();  
    }
    $addhtmlEx = str_replace("Broadbandpackage",$ENTITY_CODE_UC,$addhtmlEx);
    $addhtmlEx = str_replace("BroadbandPackage",$ENTITY_CODE_CU,$addhtmlEx);
    $addhtmlEx = str_replace("BROADBAND_PACKAGE_ID",$IDBISOSHI,$addhtmlEx);
    $addhtmlEx = str_replace("broadbandpackage",$ENTITY_CODE_LO,$addhtmlEx);
    $addhtmlEx = str_replace("宽带套餐",$ENTITY_NAME,$addhtmlEx);
    $addtable = '';
    foreach ($attributes as $key => $value) {
        $addtable .= '<tr>
            <td>'.$value['FIELD_NAME'].'：</td>
            <td><input type="text" id="'.$value['FIELD_CODE'].'" value=""></td>
        </tr>';
    }
    $addhtmlEx = str_replace("{table}",$addtable,$addhtmlEx);
    file_put_contents($view_path."/add.html",$addhtmlEx);
    
    //修改视图
    $edithtmlEx = '';
    $file = new SplFileObject("edithtmlEx.php", 'r+');  
    while (!$file->eof()) {  
        $edithtmlEx .= $file->current();  
        $file->next();  
    }
    $edithtmlEx = str_replace("Broadbandpackage",$ENTITY_CODE_UC,$edithtmlEx);
    $edithtmlEx = str_replace("BroadbandPackage",$ENTITY_CODE_CU,$edithtmlEx);
    $edithtmlEx = str_replace("BROADBAND_PACKAGE_ID",$IDBISOSHI,$edithtmlEx);
    $edithtmlEx = str_replace("broadbandpackage",$ENTITY_CODE_LO,$edithtmlEx);
    $edithtmlEx = str_replace("宽带套餐",$ENTITY_NAME,$edithtmlEx);
    $edittable = '';
    foreach ($attributes as $key => $value) {
        $edittable .= '<tr>
            <td>'.$value['FIELD_NAME'].'：</td>
            <td><input type="text" id="'.$value['FIELD_CODE'].'" value="{$'.$ENTITY_CODE_CU.'.'.$value['FIELD_CODE'].'}"></td>
        </tr>';
    }
    $edithtmlEx = str_replace("{table}",$edittable,$edithtmlEx);
    file_put_contents($view_path."/edit.html",$edithtmlEx);
    
    //删除视图
    $deletehtmlEx = '';
    $file = new SplFileObject("deletehtmlEx.php", 'r+');  
    while (!$file->eof()) {  
        $deletehtmlEx .= $file->current();  
        $file->next();  
    }
    $deletehtmlEx = str_replace("Broadbandpackage",$ENTITY_CODE_UC,$deletehtmlEx);
    $deletehtmlEx = str_replace("BroadbandPackage",$ENTITY_CODE_CU,$deletehtmlEx);
    $deletehtmlEx = str_replace("BROADBAND_PACKAGE_ID",$IDBISOSHI,$deletehtmlEx);
    $deletehtmlEx = str_replace("broadbandpackage",$ENTITY_CODE_LO,$deletehtmlEx);
    $deletehtmlEx = str_replace("宽带套餐",$ENTITY_NAME,$deletehtmlEx);
    $deletetable = '';
    foreach ($attributes as $key => $value) {
        $deletetable .= '<tr>
            <td>'.$value['FIELD_NAME'].'：</td>
            <td>{$'.$ENTITY_CODE_CU.'.'.$value['FIELD_CODE'].'}</td>
        </tr>';
    }
    $deletehtmlEx = str_replace("{table}",$deletetable,$deletehtmlEx);
    file_put_contents($view_path."/delete.html",$deletehtmlEx);
    
    $jsEx = '';
    $file = new SplFileObject("jsEx.php", 'r+');  
    while (!$file->eof()) {  
        $jsEx .= $file->current();  
        $file->next();  
    }
    $jsEx = str_replace("Broadbandpackage",$ENTITY_CODE_UC,$jsEx);
    $jsEx = str_replace("BroadbandPackage",$ENTITY_CODE_CU,$jsEx);
    $jsEx = str_replace("BROADBAND_PACKAGE_ID",$IDBISOSHI,$jsEx);
    $jsEx = str_replace("broadbandpackage",$ENTITY_CODE_LO,$jsEx);
    $jsEx = str_replace("宽带套餐",$ENTITY_NAME,$jsEx);
    file_put_contents($js_path."/".$ENTITY_CODE_LO.".js",$jsEx);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="xjst.css?v=0.3" rel="stylesheet">
    <link href="editEntitie.css?v=0.3" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
      <input id="ENTITY_UUID" type="hidden" value="<?php echo $_GET['id'];?>">
      <div class="div1">
          <div>
              <table><tr>
                  <td><span class="span1">生成代码</span></td>
                  <td><button class="btn2" id="fanhui"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<span>返回实体列表</span></button></td>
              </tr></table>
          </div>
          <table>
              <tr>
                  <td>实体名称：</td>
                  <td><span id="stmc"></span></td>
              </tr>
              <tr>
                  <td>实体代码：</td>
                  <td><span id="stdm"></span></td>
              </tr>
              <tr>
                  <td>模型代码：</td>
                  <td>
                    <textarea style="width:400px;height:400px"><?php echo $ModelExample;?></textarea>
                  </td>
              </tr>
          </table>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.json.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="GenerateCode.js?v=0.4"></script>
  </body>
</html>