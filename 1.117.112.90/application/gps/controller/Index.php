<?php

namespace app\gps\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Index extends Controller
{
    public function uniapp(){
        $openid = getOpenid();
        //Log::record("getOpenid:".json_encode($openid));
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
        if($employee_information){
            if($employee_information['approve_or_not']=='已审核'){
                //$this->assign('openid', $openid);
                $this->redirect('/uniapp/index.html');
            }else{
                $this->redirect('Index/zzsh');
            }
        }else{
            $this->redirect('/uniapp/index.html');
            //$this->redirect('Index/wrzts');
        }
        
    }
    
    //用车任务审核通过
    public function ycsqshtg(){
        $postdata = input("post.");
        //$obj = json_decode($postdata);
        $touser = $postdata['OPENID'];
        $reviewer_name = $postdata['reviewer_name'];
        $license_plate_number = $postdata['license_plate_number'];
        $planned_departure_time = $postdata['planned_departure_time'];
        $scheduled_arrival_time = $postdata['scheduled_arrival_time'];
        //return json($postdata);
        $data = array(
                "touser"=>$touser,
                'template_id'=>'qu3-1qE-aEau-fWaUNwS6pYXwPuez4IftvY9faq1ec0',
                'url'=>"http://gps.sydecheng.com/gps/index/ycsqlist",
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"您的用车申请审核通过，车牌：【".$license_plate_number."】",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>'身份认证审核','color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$planned_departure_time,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>$scheduled_arrival_time,'color'=>'#743A3A'),
                    'keyword4'=>array('value'=>$reviewer_name,'color'=>'#743A3A'),
                    'keyword5'=>array('value'=>date("Y-m-d H:i"),'color'=>'#743A3A'),
                    'remark'=>array('value'=>'点击查看详细','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $res = $wechat->sendTemplateMessage($data);
        return json($res);
    }
    
    //发送审核通过模板消息
    public function fsshtg(){
        $postdata = input("post.");
        //$obj = json_decode($postdata);
        $touser = $postdata['OPENID'];
        $reviewer_name = $postdata['reviewer_name'];
        //return json($postdata);
        $data = array(
                "touser"=>$touser,
                'template_id'=>'qu3-1qE-aEau-fWaUNwS6pYXwPuez4IftvY9faq1ec0',
                'url'=>"http://gps.sydecheng.com/gps/index/yshts.html",
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"您的认证信息已审核通过：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>'身份认证审核','color'=>'#743A3A'),
                    'keyword2'=>array('value'=>date("Y-m-d H:i"),'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>date("Y-m-d H:i"),'color'=>'#743A3A'),
                    'keyword4'=>array('value'=>$reviewer_name,'color'=>'#743A3A'),
                    'keyword5'=>array('value'=>date("Y-m-d H:i"),'color'=>'#743A3A'),
                    'remark'=>array('value'=>'点击查看详细','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $res = $wechat->sendTemplateMessage($data);
        return json($res);
    }
    
    public function index()
    {
        $openid = getOpenid();
        //Log::record("getOpenid:".json_encode($openid));
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        //return json_encode($openid);
        //$course_informations = Db::table("course_information")->order("creation_time desc")->limit(10)->select();
        $this->assign('openid', $openid);
        $ymtb = Db::table("operation_parameters")->where("parameter_name","ymtb")->find();
        $this->assign('ymtb', $ymtb);
        $rotate_pictures_on_home_pages = Db::table("rotate_pictures_on_home_page")->order("collation")->select();
        foreach ($rotate_pictures_on_home_pages as $key => &$value) {
            $value['picture_address'] = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$value['picture_address']);
        }
        $this->assign('rotate_pictures_on_home_page0', $rotate_pictures_on_home_pages[0]);
        $this->assign('rotate_pictures_on_home_page1', $rotate_pictures_on_home_pages[1]);
        $this->assign('rotate_pictures_on_home_page2', $rotate_pictures_on_home_pages[2]);
        //$this->assign('course_informations', $course_informations);
        return $this->fetch();
    }
    
    public function test(){
        $res = $this->uploadcos('/uploads/2022/04/26/80B2Oud8bmkgrmO2zUZX6tGSScIeQ7lQRp_YGgp3zTdjC01OvDPB663TqMzpjoBn_150.png','2022/04/26/80B2Oud8bmkgrmO2zUZX6tGSScIeQ7lQRp_YGgp3zTdjC01OvDPB663TqMzpjoBn_150.png');
        
        return $res;
    }
    
    //获取该人员所管理车辆
    public function getglcl(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            $t_vehicle_administrator_correspondence = Db::table("t_vehicle_administrator_correspondence")->alias('a')->join('t_vehicle_information v','a.vehicle_id = v.T_VEHICLE_INFORMATION_ID')->where("administrator_id",$employee_information['EMPLOYEE_INFORMATION_ID'])->select();
            return json($t_vehicle_administrator_correspondence);
        }
    }
    
    //获取该人员所管理车辆(司机)
    public function getsjcl(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            $t_vehicle_driver_association = Db::table("t_vehicle_driver_association")->alias('a')->join('t_vehicle_information v','a.vehicle_id = v.T_VEHICLE_INFORMATION_ID')->where("driver_id",$employee_information['EMPLOYEE_INFORMATION_ID'])->select();
            return json($t_vehicle_driver_association);
        }
    }
    
    //用车申请列表
    public function ycsqlist(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
        if($employee_information){
            if($employee_information['approve_or_not']=='已审核'){
                $this->assign('openid', $openid);
                return $this->fetch();
            }else{
                $this->redirect('Index/zzsh');
            }
        }else{
            $this->redirect('Index/wrzts');
        }
        return $this->fetch();
    }
    
    //新增用车申请
    public function ycsq(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        return $this->fetch();
    }
    
    //地址解析 百度经纬度
    public function dzjxbd09ll(){
        $postdata = input("post.");
        $x = $postdata['lat']; $y = $postdata['lng'];
        //$url = 'https://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=SFt82KRFVhERf5YVBrCvAcFX';
        $url = "https://api.map.baidu.com/reverse_geocoding/v3/?ak=SFt82KRFVhERf5YVBrCvAcFX&output=json&coordtype=bd09ll&location=".$x.",".$y;
        $html = json_decode(file_get_contents($url));
        return $html;
    }
    
    //地址解析
    public function dzjx(){
        $postdata = input("post.");
        $x = $postdata['lat']; $y = $postdata['lng'];
        //$url = 'https://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=SFt82KRFVhERf5YVBrCvAcFX';
        $url = "https://api.map.baidu.com/reverse_geocoding/v3/?ak=SFt82KRFVhERf5YVBrCvAcFX&output=json&coordtype=wgs84ll&location=".$x.",".$y;
        $html = json_decode(file_get_contents($url));
        return $html;
    }
    
    public function dzjxp(){
        $postdata = input("post.");
        $x = $postdata['lat']; $y = $postdata['lng'];
        //$url = 'https://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=SFt82KRFVhERf5YVBrCvAcFX';
        $url = "https://api.map.baidu.com/reverse_geocoding/v3/?ak=SFt82KRFVhERf5YVBrCvAcFX&output=json&coordtype=wgs84ll&location=".$x.",".$y;
        $html = json_decode(file_get_contents($url));
        return json($html);
    }
    
    public function uploadcos($local_path,$key){
        $post_data = array(

          'local_path' => $_SERVER['DOCUMENT_ROOT'].$local_path,
        
          'key' => $key
        
        );
        $res = $this->send_post('http://'.$_SERVER['HTTP_HOST'].'/cos/upload.php', $post_data);
        return $res;
    }
    
    public function send_post($url, $post_data) {
    
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
    
    //提交注册信息成功
    public function tjzccg(){
        return $this->fetch();
    }
    
    //保存注册
    public function bczc(){
        $openid = getOpenid();
        $postdata = input("post.");
        
        $verification_code = $postdata['verification_code'];
        $employee_name = $postdata['employee_name'];
        $citizenship_card = $postdata['citizenship_card'];
        $phone_number = $postdata['phone_number'];
        $id_photo = $postdata['id_photo'];
        $driving_license_photo = $postdata['driving_license_photo'];
        $reverse_side_of_id_card = $postdata['reverse_side_of_id_card'];
        $reverse_side_of_driving_certificate = $postdata['reverse_side_of_driving_certificate'];
        $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
        $birthday = $postdata['birthday'];
        if($employee_information['verification_code']!=$verification_code){
            return array(
                'code' => 1,
                'text' => '验证码错误'
            );
        }else{
            $media = & load_wechat('Media');
            $result = $media->getMedia($id_photo);
            $id_photo = saveUploadFile($result,$id_photo);
            $id_photo_ = 'https://'.$this->uploadcos($id_photo,$id_photo);
            unlink($_SERVER['DOCUMENT_ROOT'].$id_photo);
            $result = $media->getMedia($driving_license_photo);
            $driving_license_photo = saveUploadFile($result,$driving_license_photo);
            $driving_license_photo_ = 'https://'.$this->uploadcos($driving_license_photo,$driving_license_photo);
            unlink($_SERVER['DOCUMENT_ROOT'].$driving_license_photo);
            $result = $media->getMedia($reverse_side_of_id_card);
            $reverse_side_of_id_card = saveUploadFile($result,$reverse_side_of_id_card);
            $reverse_side_of_id_card_ = 'https://'.$this->uploadcos($reverse_side_of_id_card,$reverse_side_of_id_card);
            unlink($_SERVER['DOCUMENT_ROOT'].$reverse_side_of_id_card);
            $result = $media->getMedia($reverse_side_of_driving_certificate);
            $reverse_side_of_driving_certificate = saveUploadFile($result,$reverse_side_of_driving_certificate);
            $reverse_side_of_driving_certificate_ = 'https://'.$this->uploadcos($reverse_side_of_driving_certificate,$reverse_side_of_driving_certificate);
            unlink($_SERVER['DOCUMENT_ROOT'].$reverse_side_of_driving_certificate);
            //Log::record('$id_photo：'.$id_photo);
            $res = Db::table("employee_information")->where('openid',$openid)->update(['employee_name'=>$employee_name,'phone_number'=>$phone_number,'citizenship_card'=>$citizenship_card,'id_photo'=>$id_photo_,'driving_license_photo'=>$driving_license_photo_,'reverse_side_of_id_card'=>$reverse_side_of_id_card_,'reverse_side_of_driving_certificate'=>$reverse_side_of_driving_certificate_,'approve_or_not'=>'未审核','birthday'=>$birthday]);
            $uuid = Db::query("select uuid() as uuid_");
            $data = ['OPERATION_LOG_ID' => $uuid[0]['uuid_'],'OPENID' => $openid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'【'.$employee_name.'】提交注册信息'];
            //Log::record('201808181521:'.json_encode($data));
            Db::table('operation_log')->insert($data);
            return array(
                'code' => 0,
                'res' => $res
            );
        }
    }
    
    //注册认证
    public function zcrz(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $this->assign('openid', $openid);
        $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
        if($employee_information){
            if($employee_information['approve_or_not']=='已审核'){
                $this->redirect('Index/yshts');
            }else if($employee_information['approve_or_not']=='未审核'){
                $this->redirect('Index/zzsh');
            }
        }
        return $this->fetch();
    }
    
    //发送验证码
    public function fsyzm(){
        $postdata = input("post.");
        $phone_number = $postdata['phone_number'];
        $openid = getOpenid();
        if(Db::table("employee_information")->where('openid',$openid)->count()==0){
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table("employee_information")->insert(['EMPLOYEE_INFORMATION_ID'=>$uuid,'openid'=>$openid]);
        }
        $yzm = $this->getRandChar(4);
        Db::table("employee_information")->where('openid',$openid)->update(['verification_code'=>$yzm]);
        $postObj = $this->fsdx($phone_number,"【车队管家】感谢您的注册，您的验证码是：".$yzm."，10分钟内有效。");
        $postObj->yzm = $yzm;
        //$postObj->openid = $openid;
        return json($postObj);
    }
    
    //生成验证码
    public function getRandChar($length){
       $str = null;
       $strPol = "0123456789";
       $max = strlen($strPol)-1;
       for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
       }
       return $str;
    }
    
    //发送短信
    public function fsdx($phoneNumber,$MessageContent){
        $ch = curl_init();
        $url = 'http://sms.kingtto.com:9999/sms.aspx?action=send&userid=39313&account=huatingkeji&password=Qu@dengyue&mobile='.$phoneNumber.'&content='.rawurlencode($MessageContent);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        $postObj = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }
    
    //取出该用户申请的所有出车任务
    public function getccrwbysqr(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            if($employee_information){
                $t_departure_tasks = Db::table('t_departure_task')->alias('a')->join('t_vehicle_information v','a.vehicle_id = v.T_VEHICLE_INFORMATION_ID')->join('t_fan_information f','a.destination_id = f.T_FAN_INFORMATION_ID','LEFT')->where('a.applicant_id',$employee_information['EMPLOYEE_INFORMATION_ID'])->order("application_time desc")->limit(50)->select();
                foreach ($t_departure_tasks as $key => &$value) {
                    if($value['complete']=='0'){
                        $value['complete']='未完成';
                    }else{
                        $value['complete']='完成';
                    }
                    if($value['task_type']=='风机维护'){
                        $value['destination'] = $value['fan_name'].'('.$value['fan_no'].')';
                    }
                    if($value['actual_arrival_time']==null){
                        $value['actual_arrival_time'] = '';
                    }
                    if($value['approval_status']==0){
                        $value['approval_status'] = '未审批';
                    }else{
                        $value['approval_status'] = '已审批';
                    }
                }
                return json($t_departure_tasks);
            }
        }
    }
    
    //保存出车任务
    public function saveccrw(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            if($employee_information){
                $postdata = input("post.");
                $postdata['applicant_id'] = $employee_information['EMPLOYEE_INFORMATION_ID'];
                $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
                $postdata['T_DEPARTURE_TASK_ID'] = $uuid;
                $postdata['application_time'] = date('Y-m-d H:i:s');
                Db::table('t_departure_task')->insert($postdata);
                return 'ok';
            }
        }
    }
    
    //用车任务保存成功提示
    public function ycsqtjcg(){
        return $this->fetch();
    }
    
    //获取单个风机
    public function getfj(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            if($employee_information){
                $t_fan_information = Db::table("t_fan_information")->where("delete_time",null);
                $postdata = input("post.");
                $T_FAN_INFORMATION_ID = $postdata['T_FAN_INFORMATION_ID'];
                $t_fan_information = $t_fan_information->where("T_FAN_INFORMATION_ID",$T_FAN_INFORMATION_ID);
                $t_fan_information = $t_fan_information->find();
                return json($t_fan_information);
            }
        }
    }
    
    //获取风机列表
    public function getfjs(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            if($employee_information){
                $t_fan_informations = Db::table("t_fan_information")->where("delete_time",null);
                $postdata = input("post.");
                $fan_name = $postdata['fan_name'];
                if($fan_name!=''){
                    $t_fan_informations = $t_fan_informations->where("fan_name like '%".$fan_name."%'");
                }
                $t_fan_informations = $t_fan_informations->order("fan_no")->select();
                return json($t_fan_informations);
            }
        }
    }
    
    //风机信息提交成功
    public function fjtjcg(){
        return $this->fetch();
    }
    
    //保存风机位置
    public function bcfjwz(){
        $openid = getOpenid();
        if($openid!=''){
            $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
            if($employee_information){
                $postdata = input("post.");
                $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
                $postdata['T_FAN_INFORMATION_ID'] = $uuid;
                $postdata['update_time'] = date('Y-m-d H:i:s');
                $postdata['openid'] = $openid;
                $dbhwd = $this->jwdzh($postdata['longitude'],$postdata['latitude']);
                $postdata['baidu_longitude'] = $dbhwd->x;
                $postdata['baidu_latitude'] = $dbhwd->y;
                Db::table("t_fan_information")->insert($postdata);
                return 'ok';
            }
        }
    }
    
    //经度转换
    public function jwdzh($x,$y){
        $url = 'https://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=SFt82KRFVhERf5YVBrCvAcFX';
        $html = json_decode(file_get_contents($url));
        return $html->result[0];
    }
    
    //经度转换
    public function jwdzhp(){
        $postdata = input("post.");
        //return json($postdata);
        $x = $postdata['x'];
        $y = $postdata['y'];
        $url = 'https://api.map.baidu.com/geoconv/v1/?coords='.$x.','.$y.'&from=1&to=5&ak=SFt82KRFVhERf5YVBrCvAcFX';
        $html = json_decode(file_get_contents($url));
        return json($html);
    }
    
    //未认证提示
    public function wrzts(){
        return $this->fetch();
    }
    
    //已审核提示
    public function yshts(){
        return $this->fetch();
    }
    
    //正在审核提示
    public function zzsh(){
        return $this->fetch();
    }
    
    //风机经纬度定位
    public function gpsfj(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $employee_information = Db::table("employee_information")->where('openid',$openid)->find();
        if($employee_information){
            if($employee_information['approve_or_not']=='已审核'){
                $this->assign('openid', $openid);
                return $this->fetch();
            }else{
                $this->redirect('Index/zzsh');
            }
        }else{
            $this->redirect('Index/wrzts');
        }
        //$wxuser = & load_wechat('User');
        //$UserInfo = $wxuser->getUserInfo($openid);
        //Log::record("UserInfo:".json_encode($UserInfo),'notice');
        
    }
    
    
}
