<?php
    require dirname(__FILE__).'/../../vendor/cos/vendor/autoload.php';
    //echo dirname(__FILE__);
    // SECRETID和SECRETKEY请登录访问管理控制台进行查看和管理
    session_start(); 
    //echo json_encode($_SESSION['think']['openid']);
    if($_SESSION['think']['openid']==''){
        //exit;
    }
    $local_path = $_POST["local_path"];
    $key_ = $_POST["key"];
    
    $secretId = "AKID3vYuymJZYHjupTqwlJbcMp2yc07yYrtf"; //替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
    $secretKey = "WEfqkNimZ5KIzPYQ2NREkzyf5G9l6AyV"; //替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
    $region = "ap-beijing"; //替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
    $cosClient = new Qcloud\Cos\Client(
    array(
        'region' => $region,
        'schema' => 'https', //协议头部，默认为http
        'credentials'=> array(
            'secretId'  => $secretId ,
            'secretKey' => $secretKey)));
    //$local_path = "/dc/www/1.117.112.90/public/uploads/2022/04/26/80B2Oud8bmkgrmO2zUZX6tGSScIeQ7lQRp_YGgp3zTdjC01OvDPB663TqMzpjoBn_150.png";
    
    $printbar = function($totalSize, $uploadedSize) {
        printf("uploaded [%d/%d]\n", $uploadedSize, $totalSize);
    };
    
    try {
        $result = $cosClient->upload(
            $bucket = 'dcgps-1311368110', //存储桶名称，由BucketName-Appid 组成，可以在COS控制台查看 https://console.cloud.tencent.com/cos5/bucket
            //$key = '2022/04/26/80B2Oud8bmkgrmO2zUZX6tGSScIeQ7lQRp_YGgp3zTdjC01OvDPB663TqMzpjoBn_150.png',
            $key = $key_,
            $body = fopen($local_path, 'rb')
            /*
            $options = array(
                'ACL' => 'string',
                'CacheControl' => 'string',
                'ContentDisposition' => 'string',
                'ContentEncoding' => 'string',
                'ContentLanguage' => 'string',
                'ContentLength' => integer,
                'ContentType' => 'string',
                'Expires' => 'string',
                'GrantFullControl' => 'string',
                'GrantRead' => 'string',
                'GrantWrite' => 'string',
                'Metadata' => array(
                    'string' => 'string',
                ),
                'ContentMD5' => 'string',
                'ServerSideEncryption' => 'string',
                'StorageClass' => 'string', //存储类型
                'Progress' => $printbar, //指定进度条
                'PartSize' => 10 * 1024 * 1024, //分块大小
                'Concurrency' => 5 //并发数
            )
            */
        );
        // 请求成功
        //print_r($result);
        echo $result['Location'];
    } catch (\Exception $e) {
        // 请求失败
        echo($e);
    }