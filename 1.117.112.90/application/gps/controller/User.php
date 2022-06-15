<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Log;
use think\Session;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }
    
    public function bindings(){
        Session::delete('openid');
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        //Log::record("201822020905:".json_encode($openid));
        $Salesman = \app\index\model\Salesman::where('openid',$openid)->find();
        //Log::record("201822020905:".json_encode($Salesman));
        $this->assign('Salesman',$Salesman);
        $this->assign('openid',$openid);
        //$salesman = Db::table('salesman')->where('openid',$openid)->find();
        //Log::record("bindings:salesman:".json_encode($salesman));
        return $this->fetch();
    }
    
    public function getRandChar($length){
       $str = null;
       $strPol = "0123456789";
       $max = strlen($strPol)-1;
    
       for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
       }
       return $str;
    }
    
    //绑定操作
    public function bindingsaction(){
        //Log::record("bindingsaction:~");
        $posdata = input("post.");
        //Log::record("bindingsaction:posdata~".json_encode($posdata));
        $openid = getOpenid();
        //Log::record("bindingsaction:getOpenid~".json_encode($openid));
        $PHONE_NUMBER = $posdata['PHONE_NUMBER'];
        $verification_code = $posdata['verification_code'];
        
        $wxuser = & load_wechat('User');
        
        $UserInfo = $wxuser->getUserInfo($openid);
        $Salesman = \app\index\model\Salesman::where('PHONE_NUMBER',$PHONE_NUMBER)->find();
        //Log::record("bindingsaction:salesman:".json_encode($Salesman));
        if($Salesman->verification_code==$verification_code){
            /*$old_salesman = Db::table('salesman')->where('delete_time','=',null)->where('PHONE_NUMBER',$PHONE_NUMBER)->find();
            if($old_salesman!=null){
                $old_openid = $old_salesman['openid'];
                Db::table('broadband_orders')->where('author_openid', $old_openid)->update(['author_openid' => $openid]);
                Db::table('salesman')->where('PHONE_NUMBER',$PHONE_NUMBER)->update(['delete_time' => time()]);
            }*/
            $old_openid = $Salesman->openid;
            $Salesman->openid = $openid;
            $Salesman->binding_time = date('Y-m-d H:i:s');
            $Salesman->head_portrait = $UserInfo['headimgurl'];
            $Salesman->delete_time = null;
            $Salesman->save();
            //更新订单的老openID信息
            if($old_openid!=''){
                if($old_openid!=$openid){
                    //Log::record("bindingsaction:old_openid:".json_encode($old_openid));
                    //Log::record("bindingsaction:openid:".json_encode($openid));
                    Db::table('broadband_orders')->where('author_openid','=',$old_openid)->update(['author_openid' => $openid]);
                    //Db::table('user_list')->where('OPENID','=',$old_openid)->update(['OPENID' => $openid]);
                    Db::table('user_list')->where('superior_openid','=',$old_openid)->update(['superior_openid' => $openid]);
                }
            }
            //Log::record("bindingsaction:salesman:".json_encode($Salesman));
            if(\app\index\model\UserList::where("OPENID",'=',$openid)->count()==0){
                $UserList = new \app\index\model\UserList();
                $UserList->OPENID = $openid;
                $UserList->full_name = $Salesman->FULL_NAME;
                $UserList->phone_number = $Salesman->PHONE_NUMBER;
                $UserList->save();
            }else{
                $UserList = \app\index\model\UserList::where('OPENID',$openid)->find();
                $UserList->full_name = $Salesman->FULL_NAME;
                $UserList->phone_number = $Salesman->PHONE_NUMBER;
                $UserList->save();
            }
            
            return 'ok';
        }else{
            return '验证码错误';
        }
    }
    
    //发送短信验证码
    public function sendsms(){
        $posdata = input("post.");
        $phoneNumber = $posdata['phoneNumber'];
        $count = \app\index\model\Salesman::where('PHONE_NUMBER',$phoneNumber)->count();
        $verification_code = $this->getRandChar(4);
        if($count>0){
            $MessageContent = '【移宽合伙人】您的验证码是：'.$verification_code.'，感谢您的使用！';
            $ch = curl_init();
            $url = 'http://sms.kingtto.com:9999/sms.aspx?action=send&userid=5820&account=jingsheng&password=fhm123321&mobile='.$phoneNumber.'&content='.rawurlencode($MessageContent);
            // 添加apikey到header
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // 执行HTTP请求
            curl_setopt($ch , CURLOPT_URL , $url);
            $res = curl_exec($ch);
            \app\index\model\Salesman::where('PHONE_NUMBER', $phoneNumber)->update(['verification_code' => $verification_code]);
            return 'ok';
        }else{
            return '员工信息不存在。';
        }
    }
    
    //发送底商开发短信验证码
    public function senddssms(){
        $posdata = input("post.");
        $phoneNumber = $posdata['phoneNumber'];
        $openid = $posdata['openid'];
        //$count = \app\index\model\Salesman::where('PHONE_NUMBER',$phoneNumber)->count();
        $verification_code = $this->getRandChar(4);
        //if($count>0){
            $MessageContent = '【移宽合伙人】您的验证码是：'.$verification_code.'，感谢您的使用！';
            $ch = curl_init();
            $url = 'http://sms.kingtto.com:9999/sms.aspx?action=send&userid=5820&account=jingsheng&password=fhm123321&mobile='.$phoneNumber.'&content='.rawurlencode($MessageContent);
            // 添加apikey到header
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // 执行HTTP请求
            curl_setopt($ch , CURLOPT_URL , $url);
            $res = curl_exec($ch);
            //Log::record("senddssms:openid:".json_encode($openid));
            Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->update(['contact_number' => $phoneNumber,'verification_code'=>$verification_code]);
            return 'ok';
        //}else{
        //    return '员工信息不存在。';
        //}
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
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
}
