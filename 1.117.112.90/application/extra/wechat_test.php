<?php
    return [
        'token'             =>  'pamtest', // 填写你设定的key
        'appid'             =>  'wx814d06f73ded04f3', // 填写高级调用功能的app id, 请在微信开发模式后台查询
        'appsecret'         =>  '1626926b3b92141acc016eede4bb6e38', // 填写高级调用功能的密钥
        'encodingaeskey'    =>  '', // 填写加密用的EncodingAESKey（可选，接口传输选择加密时必需）
        'mch_id'            =>  '', // 微信支付，商户ID（可选）
        'partnerkey'        =>  '', // 微信支付，密钥（可选）
        'ssl_cer'           =>  '', // 微信支付，证书cert的路径（可选，操作退款或打款时必需）
        'ssl_key'           =>  '', // 微信支付，证书key的路径（可选，操作退款或打款时必需）
        'cachepath'         =>  '', // 设置SDK缓存目录（可选，默认位置在./src/Cache下，请保证写权限）
    ];