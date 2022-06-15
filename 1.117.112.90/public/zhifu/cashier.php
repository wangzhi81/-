<?php
    # 收银台接口

    $price = "0.01"; # 从 URL 获取充值金额 price
    $name = 'vip year fee';  # 订单商品名称
    $pay_type = 'jsapi';     # 付款方式
    $order_id = time();    # 自己创建的本地订单号
    $notify_url = 'http://wx.dzyywx.com/zhifu/notify_url.php';   # 回调通知地址

    $secret = '40a658ab0bfd4db6b257443379aba84f';     # app secret, 在个人中心配置页面查看
    $api_url = 'https://xorpay.com/api/pay/15627';   # 付款请求接口，在个人中心配置页面查看

    function sign($data_arr) {
        return md5(join('',$data_arr));
    };

    $sign = sign(array($name, $pay_type, $price, $order_id, $notify_url, $secret));
    
    //使用方法
$post_data = array(
  'name' => $name,
  'pay_type' => 'jsapi',
  'price'=>'0.01',
  'order_id'=>$order_id,
  'notify_url'=>$notify_url,
  'sign'=>$sign,
  'openid'=>'asd',
  'return_url'=>'http://wx.dzyywx.com/music/index'
);
$res = send_post($api_url, $post_data);
$obj = json_decode($res);
echo $obj->info->qr;
    /**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function send_post($url, $post_data) {
 
  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
 
  return $result;
}
