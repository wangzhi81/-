<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $attributes = pdoquery("select * from attribute where ENTITY_UUID='".Q($_GET['id'])."' order by SerialNumber");
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统-字典表维护属性</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/loading.css" rel="stylesheet">
    <link href="xjst.css?v=0.3" rel="stylesheet">
    <link href="MaintainProperty.css?v=0.3" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
      body{
        font-family:'微软雅黑' !important;
      }

    </style>
  </head>
  <?php
require_once dirname(__FILE__) .'/../control/pdo.php';
$entity = pdoquery("select * from entity where ENTITY_UUID='".Q($_GET['id'])."'");
function convertUnderline( $str , $ucfirst = true)
    {
        $str = strtolower($str);
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$str);
        return $ucfirst ? ucfirst($str) : $str;
    }
  ?>
  <body>
    <input id="ENTITY_UUID" type="hidden" value="<?php echo $_GET['id'];?>">
    <div class="div1">
      <div>
        <table><tr>
          <td><span class="span1">维护属性</span></td>
          <td><button class="btn2" id="fanhui"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<span>返回实体列表</span></button></td>
          </tr></table>
      </div>
      <table>
        <tr>
          <td>实体名称：</td>
          <td><?php echo $entity[0]['ENTITY_NAME'];?></td>
          <td>实体代码：</td>
          <td><span id="ENTITY_CODE" class="span2" title="点击复制" data-clipboard-target="ENTITY_CODE"><?php echo strtolower($entity[0]['ENTITY_CODE']);?></span></td>
          <td>实体ID：</td>
          <td><span id="ENTITY_ID" class="span2" title="点击复制" data-clipboard-target="ENTITY_ID"><?php echo $entity[0]['ENTITY_CODE']."_ID";?></span></td>
          <td>对象代码：</td>
          <td><span id="ObjectCode" class="span2" title="点击复制" data-clipboard-target="ObjectCode"><?php echo convertUnderline($entity[0]['ENTITY_CODE']);?></span></td>
          <td>实体说明：</td>
          <td>
            <?php echo $entity[0]['ENTITY_DESCRIPTION'];?>
          </td>
        </tr>
      </table>      
      <table class="table table-bordered">
        <tr>
          <th>序号</th>
          <th>字段名称</th>
          <th>字段代码</th>
          <th>数据类型</th>
          <th>默认值</th>
          <th>注释</th>
          <th>操作</th>
        </tr>
        <tbody id="ProTBody">
            <?php
                $xuhao = 1;
                foreach ($attributes as $key => $value) {
                    echo '<tr class="Property" ATTRIBUTE_UUID="'.$value['ATTRIBUTE_UUID'].'" FIELD_CODE="'.$value['FIELD_CODE'].'"><td style="vertical-align:middle" class="SerialNumber">'.$xuhao.'</td><td><input class="form-control FIELD_NAME" type="text" onblur="fanyi(this)" value="'.$value['FIELD_NAME'].'"></td><td style="vertical-align:middle;cursor:pointer;" class="FIELD_CODE" id="FC_'.$value['FIELD_CODE'].'" data-clipboard-target="FC_'.$value['FIELD_CODE'].'" title="点击复制">'.$value['FIELD_CODE'].'</td><td><select class="form-control DATA_TYPE"><option value="'.$value['DATA_TYPE'].'">'.$value['DATA_TYPE'].'</option><option value="varchar(50)">varchar(50)</option><option value="varchar(500)">varchar(500)</option><option value="decimal(10,2)">decimal(10,2)</option><option value="int(11)">int(11)</option><option value="datetime">datetime</option></option><option value="text">text</option></select></td><td><input class="form-control DEFAULT_VALUE_" type="text" value="'.$value['DEFAULT_VALUE_'].'"></td><td><input class="form-control NOTES" type="text" value="'.$value['NOTES'].'"></td><td style="vertical-align:middle"><span class="glyphicon glyphicon-arrow-up" onclick="xiangshang(this)"></span><span class="glyphicon glyphicon-arrow-down" onclick="xiangxia(this)"></span><span class="glyphicon glyphicon-remove" onclick="shanchu(this)"></span></td></tr>';
                    $xuhao++;
                }
            ?>
        </tbody>
      </table>
      <table width="100%">
        <tr>
          <td align="right">
            <button type="button" class="btn btn-primary" id="addProperty">添加</button>
            <button type="button" class="btn btn-primary" id="savePro">保存</button>
          </td>
        </tr>
      </table>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.json.min.js"></script>
    <script src="../js/ZeroClipboard/ZeroClipboard.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/loading.js"></script>
    <script src="../js/table.js"></script>
    <script src="MaintainProperty.js?v=3"></script>
  </body>
</html>