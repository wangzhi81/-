<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/39.99.164.250/public/../application/index/view/database/daochu.html";i:1622437432;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <style>
            table {
                border-collapse: collapse;margin-top: 5px;
            }
            table, td, th {
                border: 1px solid black;padding: 5px;
            }
            h{margin:5px;}
        </style>
    </head>
    
    <body>
        <?php if(is_array($entity) || $entity instanceof \think\Collection || $entity instanceof \think\Paginator): $i = 0; $__LIST__ = $entity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <h>&nbsp;<?php echo $vo['ENTITY_CODE']; ?>&nbsp;<?php echo $vo['ENTITY_NAME']; ?>数据</h><br>
            <table>
                <tr>
                    <th>编号</th><th>数据项名</th><th>中文简介</th><th>类型</th><th>长度</th><th>约束</th><th>备注</th>
                </tr>
                <tr>
                    <td>01</td><td>id</td><td><?php echo $vo['ENTITY_NAME']; ?>ID</td><td>varchar</td><td>50</td><td>M</td><td></td>
                </tr>
            <?php if(is_array($vo['attribute']) || $vo['attribute'] instanceof \think\Collection || $vo['attribute'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attribute'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $vo2['SerialNumber']; ?></td><td><?php echo $vo2['FIELD_CODE']; ?></td><td><?php echo $vo2['FIELD_NAME']; ?></td><td><?php echo $vo2['DATA_TYPE']; ?></td><td><?php echo $vo2['DATA_LENGTH']; ?></td><td></td><td><?php echo $vo2['NOTES']; ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </table><br>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </body>
</html>
