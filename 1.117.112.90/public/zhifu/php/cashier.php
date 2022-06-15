<?php
    # 收银台接口

    $price = "0.01"; # 从 URL 获取充值金额 price
    $name = 'vip year fee';  # 订单商品名称
    $pay_type = 'jsapi';     # 付款方式
    $order_id = 'demo-31';    # 自己创建的本地订单号
    $notify_url = 'http://wx.dzyywx.com/music/index';   # 回调通知地址

    $secret = '40a658ab0bfd4db6b257443379aba84f';     # app secret, 在个人中心配置页面查看
    $api_url = 'https://xorpay.com/api/cashier/15627';   # 付款请求接口，在个人中心配置页面查看

    function sign($data_arr) {
        return md5(join('',$data_arr));
    };

    $sign = sign(array($name, $pay_type, $price, $order_id, $notify_url, $secret));


echo '<html>
      <head><title>redirect...</title></head>
      <body>
          <form id="post_data" action="'.$api_url.'" method="post">
              <input type="hidden" name="name" value="'.$name.'"/>
              <input type="hidden" name="pay_type" value="'.$pay_type.'"/>
              <input type="hidden" name="price" value="'.$price.'"/>
              <input type="hidden" name="order_id" value="'.$order_id.'"/>
              <input type="hidden" name="notify_url" value="'.$notify_url.'"/>
              <input type="hidden" name="sign" value="'.$sign.'"/>
          </form>
          <script>document.getElementById("post_data").submit();</script>
      </body>
      </html>';

?>
