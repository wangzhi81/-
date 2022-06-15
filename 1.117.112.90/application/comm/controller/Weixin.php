<?php

namespace app\comm\controller;

use think\Controller;
use think\Request;
use think\Log;
use think\helper\Time;
use think\Session;
use think\Db;

class Weixin extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $wechat = load_wechat('Receive');
        if ($wechat->valid() === FALSE) {
            exit($wechat->errMsg);
        }
        $openid = $wechat->getRev()->getRevFrom();
        switch ($wechat->getRev()->getRevType()) {
            // 文本类型处理
            case \Wechat\WechatReceive::MSGTYPE_TEXT: 
                $keys = $wechat->getRevContent();
                Log::record('$keys：'.$keys);
                $wechat->text("您好，欢迎关注！")->reply();
                //$wechat->transfer_customer_service()->reply();
                //return _keys($keys);
            // 事件类型处理
            case \Wechat\WechatReceive::MSGTYPE_EVENT:
                $event = $wechat->getRevEvent();
                Log::record('$event：'.json_encode($event));
                //Log::record('$event：event:'.$event['event']);
                if($event['event']=="subscribe"){
                    $wechat->text("您好，欢迎关注！")->reply();
                    //Log::record('$event[key]'.strpos($event['key'],"qrscene"));
                    if(json_encode($event['key'])=="{}"){
                        Log::record('直接关注');
                        $this->updateUser_($openid);
                    }else if(strpos($event['key'],"qrscene")==0){
                        $superior_openid = str_replace("qrscene_","",$event['key']);
                        //Log::record('$superior_openid：'.$superior_openid);
                        $this->updateUser($openid,$superior_openid);
                    }
                }
                //return _event(strtolower($event['event']));
             // 图片类型处理
            case \Wechat\WechatReceive::MSGTYPE_IMAGE:
                //return _image();
             // 发送位置类的处理
            case \Wechat\WechatReceive::MSGTYPE_LOCATION:
                //return _location();
            // 其它类型的处理，比如卡卷领取、卡卷转赠
            default:
                //return _default();
        }
        return input('echostr');
    }
    
    public function dishang()
    {
        $wechat = load_dswechat('Receive');
        if ($wechat->valid() === FALSE) {
            exit($wechat->errMsg);
        }
        $openid = $wechat->getRev()->getRevFrom();
        //Log::record('$openid：'.$openid);
        switch ($wechat->getRev()->getRevType()) {
            // 文本类型处理
            case \Wechat\WechatReceive::MSGTYPE_TEXT: 
                $keys = $wechat->getRevContent();
                $wechat->text("您好，欢迎关注！")->reply();
                //$wechat->transfer_customer_service()->reply();
                //return _keys($keys);
            // 事件类型处理
            case \Wechat\WechatReceive::MSGTYPE_EVENT:
                $event = $wechat->getRevEvent();
                if($event['event']=="subscribe"){
                    //$wechat->text("您好，欢迎关注！")->reply();
                    //Log::record('201808251439：'.json_encode($event));
                    if(Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->count()==0){
                        $uuid = Db::query("select uuid() as uuid_");
                        $data = ['DESHANG_INFORMATION_ID' => $uuid[0]['uuid_'], 'openid' => $openid];
                        //Log::record('201808251507：'.json_encode($event));
                        Db::table('deshang_information')->insert($data);
                    }
                    if($event['key']!=''){
                        $salesperson_openid = str_replace("qrscene_","",$event['key']);
                        Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->update(['salesperson_openid'=>$salesperson_openid]);
                        $newsData = array(
                        array('Title'=>'欢迎关注','Description'=>'点击此链接可注册商户','PicUrl'=>'http://kod.syjs.net.cn/static/img/guanggao601.png','Url'=>'http://kod.syjs.net.cn/index/Bottom/zhuce/ygid/'.$salesperson_openid),
                        );
                        //Log::record('201808251528：'.json_encode($newsData));
                        $wechat->news($newsData)->reply();
                    }
                    $wechat->text("您好，欢迎关注！")->reply();
                    //$wechat->text($openid)->reply();
                }
                //return _event(strtolower($event['event']));
             // 图片类型处理
            case \Wechat\WechatReceive::MSGTYPE_IMAGE:
                //return _image();
             // 发送位置类的处理
            case \Wechat\WechatReceive::MSGTYPE_LOCATION:
                //return _location();
            // 其它类型的处理，比如卡卷领取、卡卷转赠
            default:
                //return _default();
        }
        return input('echostr');
    }
    
    //对直接关注者的处理
    public function updateUser_($openid){
        $wxuser = & load_wechat('User');
        $user = \app\comm\model\UserList::get(['OPENID' => $openid]);
        if($user！=null){
            return;
        }else{
            $user = new \app\comm\model\UserList;
            $result = $wxuser->getUserInfo($openid);
            //return json($result);
            if($result===FALSE){
                return;
            }else{
                $user->NICKNAME = json_encode($result['nickname']);
                $user->GENDER = $result['sex'];
                $user->PROVINCE = $result['province'];
                $user->CITY = $result['city'];
                $user->HEAD_PORTRAIT = $result['headimgurl'];
                $user->ATTENTION_TIME = date('Y-m-d H:i:s', $result['subscribe_time']);
            }
        }
        $user->OPENID = $openid;
        $user->superior_openid = "olz_I0qapApA3Y-qzpHMKqO9sVhE";
        //Log::record('$user->superior_openid3'.$user->superior_openid,'notice');
        $user->save();
        return;
    }
    
    //补充更新用户名列表
    public function updateUser($openid,$superior_openid){
        //$openid = 'olz_I0qapApA3Y-qzpHMKqO9sVhE';
        //Log::record('updateUser：'.$openid);
        $wxuser = & load_wechat('User');
        $user = \app\comm\model\UserList::get(['OPENID' => $openid]);
        if($user==null){
            $user = new \app\comm\model\UserList;
            $result = $wxuser->getUserInfo($openid);
            //return json($result);
            if($result===FALSE){
                return;
            }else{
                $user->NICKNAME = json_encode($result['nickname']);
                $user->GENDER = $result['sex'];
                $user->PROVINCE = $result['province'];
                $user->CITY = $result['city'];
                $user->HEAD_PORTRAIT = $result['headimgurl'];
                $user->ATTENTION_TIME = date('Y-m-d H:i:s', $result['subscribe_time']);
            }
        }
        $user->OPENID = $openid;
        $user->superior_openid = $superior_openid;
        //Log::record('$user->superior_openid3'.$user->superior_openid,'notice');
        $user->save();
        return;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function createMenu()
    {
        //$menu = & load_wechat('menu');
        return json(url('index/blog/read','','',true));
    }
    
    public function getJsSign(){
        $script = & load_wechat('Script');
        $options = $script->getJsSign(input('url'));
        //$options['debug'] = true;
        //Log::record($options,'notice');
        return json($options);
    }
    
    
    public function createCard(){
        $card = & load_wechat('Card');
        $data = (object)array();
        $data->card = (object)array();
        $data->card->card_type = "GROUPON";
        $data->card->groupon = (object)array();
        $data->card->groupon->base_info = (object)array();
        $data->card->groupon->base_info->logo_url = "http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFNjakmxibMLGWpXrEXB33367o7zHN0CwngnQY7zb7g/0";
        $data->card->groupon->base_info->brand_name = "微信餐厅";
        $data->card->groupon->base_info->code_type = "CODE_TYPE_TEXT";
        $data->card->groupon->base_info->title = "132元双人火锅套餐";
        $data->card->groupon->base_info->color = "Color010";
        $data->card->groupon->base_info->notice='使用时向服务员出示此券';
        $data->card->groupon->base_info->service_phone = '020-88888888';
        $data->card->groupon->base_info->description = '不可与其他优惠同享\n如需团购券发票，请在消费时向商户提出\n店内均可使用，仅限堂食';
        $data->card->groupon->base_info->date_info = (object)array();
        $data->card->groupon->base_info->date_info->type = 'DATE_TYPE_FIX_TIME_RANGE';
        list($start, $end) = Time::today();
        $data->card->groupon->base_info->date_info->begin_timestamp = $start;
        $data->card->groupon->base_info->date_info->end_timestamp = $end;
        $data->card->groupon->base_info->sku = (object)array();
        $data->card->groupon->base_info->sku->quantity = 500000;
        $data->card->groupon->base_info->use_limit = 100;
        $data->card->groupon->base_info->get_limit = 3;
        $data->card->groupon->base_info->use_custom_code = false;
        $data->card->groupon->base_info->bind_openid = false;
        $data->card->groupon->base_info->can_share = true;
        $data->card->groupon->base_info->can_give_friend  = true;
        $data->card->groupon->base_info->location_id_list  = array(123,12331,345345);
        $data->card->groupon->base_info->center_title = "顶部居中按钮";
        $data->card->groupon->base_info->center_sub_title = "按钮下方的wording";
        $data->card->groupon->base_info->center_url = "www.qq.com";
        $data->card->groupon->base_info->custom_url_name = "立即使用";
        $data->card->groupon->base_info->custom_url = "http://www.qq.com";
        $data->card->groupon->base_info->custom_url_sub_title = "6个汉字tips";
        $data->card->groupon->base_info->promotion_url_name = "更多优惠";
        $data->card->groupon->base_info->promotion_url = "http://www.qq.com";
        $data->card->groupon->base_info->source = "大众点评";
        $data->card->groupon->advanced_info = (object)array();
        $data->card->groupon->advanced_info->use_condition = (object)array();
        $data->card->groupon->advanced_info->use_condition->accept_category = "鞋类";
        $data->card->groupon->advanced_info->use_condition->reject_category = "阿迪达斯";
        $data->card->groupon->advanced_info->use_condition->can_use_with_other_discount = true;
        $data->card->groupon->advanced_info->abstract = (object)array();
        $data->card->groupon->advanced_info->abstract->abstract = '微信餐厅推出多种新季菜品，期待您的光临';
        $data->card->groupon->advanced_info->abstract->icon_url_list = 'http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0';
        $data->card->groupon->advanced_info->text_image_list = array();
        $text_image_list1 = (object)array();
        $text_image_list1->image_url = 'http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0';
        $text_image_list1->text = '此菜品精选食材，以独特的烹饪方法，最大程度地刺激食 客的味蕾';
        $text_image_list2 = (object)array();
        $text_image_list2->image_url = 'http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0';
        $text_image_list2->text = '此菜品迎合大众口味，老少皆宜，营养均衡';
        array_push($data->card->groupon->advanced_info->text_image_list,$text_image_list1,$text_image_list2);
        $data->card->groupon->advanced_info->time_limit = array();
        $time_limit1 = (object)array();
        $time_limit1->type = 'MONDAY';
        $time_limit1->begin_hour = 0;
        $time_limit1->end_hour = 10;
        $time_limit1->begin_minute = 10;
        $time_limit1->end_minute = 59;
        $time_limit2 = (object)array();
        $time_limit2->type = 'HOLIDAY';
        array_push($data->card->groupon->advanced_info->time_limit,$time_limit1,$time_limit2);
        $data->card->groupon->advanced_info->business_service = array("BIZ_SERVICE_FREE_WIFI","BIZ_SERVICE_WITH_PET","BIZ_SERVICE_FREE_PARK","BIZ_SERVICE_DELIVER");
        $data->card->groupon->deal_detail = "以下锅底2选1（有菌王锅、麻辣锅、大骨锅、番茄锅、清补 凉锅、酸菜鱼锅可选）：\n大锅1份 12元\n小锅2份 16元";
        $result = $card->createCard($data);
        if($result===FALSE){
            return json($card->errMsg);
        }else{
            return json($result);
        }
    }
    
    public function getCardMpHtml(){
        $card = &  load_wechat('Card');
        $cardid = "pe5o_0lt_tofVZkVRgzkjyoTdZ38";
        // 获取卡卷用于图文的HTML代码
        //$result = $card->createCardQrcode($cardid);
        $result = $card->getCardInfo($cardid);
        // 处理执行结果
        if($result===FALSE){
        	// 接口失败的处理
            return json($card->errMsg);
        }else{
        	// 接口成功的处理
        	return json($result);
        }
    }
    
    public function test(){
        //$Extend = & load_wechat('Extends');
        //$res = $Extend->getQRCode("abc",1);
        //$ticket = $res['ticket'];
        //$QRUrl = $Extend->getQRUrl($ticket);
        //$ShortUrl = $Extend->getShortUrl($QRUrl);
        header("Content-Type: application/vnd.ms-excel; charset=GBK");
        header("Content-Disposition: attachment;filename=派单数据.csv ");
        //$Custom = & load_wechat('Custom');
        //$CustomServiceKFlist = $Custom->getCustomServiceOnlineKFlist();
        //return json($CustomServiceKFlist);
        return "A,B\n";
    }
    
    public function getOpenid_(){
        return getOpenid();
    }
    

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
    
    public function RemoteControl(){
        return $this->fetch();
    }
}
