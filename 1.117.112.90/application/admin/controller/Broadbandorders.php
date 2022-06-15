<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Log;
use think\Db;

class Broadbandorders extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带订单";
        $Feature->DataUrl = "/admin/Broadbandorders/get";
        $Feature->TableHeader = array("提交时间","营业厅","开户人","主号姓名","手机号码","接入地址及其他","套餐名称","业务状态","底商","业务员");
        $Feature->Fields = array("BROADBAND_ORDERS_ID","submission_time","saffiliated_business_hall","sFULL_NAME","master_name","phone_number","access_address","package_name","business_state","name_of_the_merchant","saFULL_NAME");
        $Feature->Operations= array(
                array('name'=>'查看','url'=>'/admin/Broadbandorders/Audit/id/'),
                array('name'=>'录入完成','class'=>'InputComplete State','url'=>'javascript:;'),
                array('name'=>'安装完成','class'=>'InstallationComplete State','url'=>'javascript:;'),
                array('name'=>'票据派发','class'=>'BillsIssued State','url'=>'javascript:;'),
                array('name'=>'订单完成','class'=>'BillReturned State','url'=>'javascript:;'),
                array('name'=>'删除','url'=>'/admin/Broadbandorders/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'录入完成','url'=>'javascript:;','class'=>'BulkInputComplete'),
                array('name'=>'安装完成','url'=>'javascript:;','class'=>'BulkInstallationComplete'),
                array('name'=>'票据派发','url'=>'javascript:;','class'=>'BulkBillsIssued'),
                array('name'=>'订单完成','url'=>'javascript:;','class'=>'BulkBillReturned')
            );
        $Feature->QueryPanels = "/admin/Broadbandorders/QueryPanels";
        $Feature->PageInforUrl = "/admin/Broadbandorders/PageInformation";
        $Feature->ScriptFragment ='dict/broadbandorders';
        return json($Feature);
    }
    
    //线下支付
    public function xianxiazhifu(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        $FULL_NAME = $Salesman['FULL_NAME'];
        if($FULL_NAME==''){exit;}
        $OPENID = $UserInfor['OPENID'];
        $postdata = input('post.');
        $BROADBAND_ORDERS_ID = $postdata['BROADBAND_ORDERS_ID'];
        $amount_of_payment = $postdata['amount_of_payment'];
        $remarks = $postdata['remarks'];
        Db::table('broadband_orders')->where("BROADBAND_ORDERS_ID","=",$BROADBAND_ORDERS_ID)->update(['whether_to_pay' => '已支付','amount_of_payment'=>$amount_of_payment,'business_state'=>'订单已完成']);
        $OperationLog = new \app\index\model\OperationLog();
        $OperationLog->OPENID = $OPENID;
        $OperationLog->OPERATING_TIME = date('Y-m-d H:i:s');
        $OperationLog->OPERATION_CONTENT = '['.$FULL_NAME.']线下收款，收款金额￥'.($amount_of_payment).'元。';
        $OperationLog->correlation_id = $BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $broadband_orders = Db::table('broadband_orders')->where('BROADBAND_ORDERS_ID','=',$BROADBAND_ORDERS_ID)->find();
        Db::table('broadband_orders')->where("BROADBAND_ORDERS_ID","=",$BROADBAND_ORDERS_ID)->update(['remarks' => $broadband_orders['remarks'].$remarks]);
        //计算业绩
        if(\app\admin\model\BroadbandPerformance::where("order_id",'=',$BROADBAND_ORDERS_ID)->count()==0){
            $BroadbandPackage = \app\admin\model\BroadbandPackage::get(['package_name' => $broadband_orders['package_name']]);
            //本人绩效
            $Myself = \app\admin\model\UserList::get(['OPENID'=>$broadband_orders['author_openid']]);
            $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
            $BroadbandPerformance->openid = $broadband_orders['author_openid'];
            //获取销售人员信息，不同的人员按照不同的绩效金额
            $Salesman_ = \app\admin\model\Salesman::where('openid',$broadband_orders['author_openid'])->find();
            $achievement = $BroadbandPackage->personal_performance;
            if($Salesman_->serve_as_a_post=='渠道1'){
                $achievement = $BroadbandPackage->channel_1_performance;
            }else if($Salesman_->serve_as_a_post=='渠道2'){
                $achievement = $BroadbandPackage->channel_2_performance;
            }
            $BroadbandPerformance->achievement = $achievement;
            $BroadbandPerformance->performance_category = '个人绩效';
            $BroadbandPerformance->performance_time = date('Y-m-d H-i-s');
            $BroadbandPerformance->order_id = $BROADBAND_ORDERS_ID;
            $BroadbandPerformance->package_name = $broadband_orders['package_name'];
            $BroadbandPerformance->save();
        }
        //支付记账
        $uuid = Db::query("select uuid() as uuid_");
        $data = ['PAYMENT_OF_ACCOUNT_ID'=>$uuid[0]['uuid_'],'order_id' => $broadband_orders['BROADBAND_ORDERS_ID'], 'payer_openid' => $broadband_orders['author_openid'],'payment_time'=>date('Y-m-d H:i:s'),'amount_of_payment'=>$amount_of_payment,'payment_method'=>'线下支付','payee_openid'=>$OPENID];
        //Log::record(date('Y-m-d H:i:s')."：支付记账:".json_encode($data));
        Db::table('payment_of_account')->insert($data);
        return 'ok';
    }
    
    public function sendTemplateMessage($BROADBAND_ORDERS_ID,$touser,$master_name,$phone_number,$reasons_for_return){
        $data = array(
                "touser"=>$touser,
                'template_id'=>getParameter('OrdersReturnedNotice'),
                'url'=>url('index/index/Resubmit',['id'=>$BROADBAND_ORDERS_ID],'html',true),
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"你好，单据已退回：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$master_name,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$phone_number,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>$reasons_for_return,'color'=>'#743A3A'),
                    'remark'=>array('value'=>'请尽快补充资料再次提交','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $wechat->sendTemplateMessage($data);
    }
    
    public function sendAuditNotificationMessage($BROADBAND_ORDERS_ID,$touser,$master_name,$phone_number,$remarks){
        $data = array(
                "touser"=>$touser,
                'template_id'=>getParameter('AuditNotification'),
                'url'=>url('index/index/OrderDetails',['id'=>$BROADBAND_ORDERS_ID],'html',true),
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"你好，你提交的订单已审核通过：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$master_name,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$phone_number,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>$remarks,'color'=>'#743A3A'),
                    'remark'=>array('value'=>'查看详细信息请点击此消息。','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $wechat->sendTemplateMessage($data);
    }
    
    //票据录入完成通知
    public function EntryCompletionNotice($BROADBAND_ORDERS_ID,$touser,$master_name,$phone_number){
        $data = array(
                "touser"=>$touser,
                'template_id'=>getParameter('EntryCompletionNotice'),
                'url'=>url('index/index/OrderDetails',['id'=>$BROADBAND_ORDERS_ID],'html',true),
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"你好，你提交的订单已录入完成：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$master_name,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$phone_number,'color'=>"#743A3A"),
                    'remark'=>array('value'=>'查看详细信息请点击此消息。','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $wechat->sendTemplateMessage($data);
    }
    
    //订单完成通知
    public function TicketReturnNotification($BROADBAND_ORDERS_ID,$touser,$master_name,$phone_number,$package_name){
        $data = array(
                "touser"=>$touser,
                'template_id'=>getParameter('TicketReturnNotification'),
                'url'=>url('index/index/OrderDetails',['id'=>$BROADBAND_ORDERS_ID],'html',true),
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"你好，你提交的订单已完成：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$master_name,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$phone_number,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>$package_name,'color'=>"#743A3A"),
                    'keyword4'=>array('value'=>date('Y-m-d'),'color'=>"#743A3A"),
                    'remark'=>array('value'=>'查看详细信息请点击此消息。','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $wechat->sendTemplateMessage($data);
    }
    
    //票据派发通知
    public function NoteIssued($BROADBAND_ORDERS_ID,$touser,$master_name,$phone_number,$package_name){
        $data = array(
                "touser"=>$touser,
                'template_id'=>getParameter('NoteIssued'),
                'url'=>url('index/index/OrderDetails',['id'=>$BROADBAND_ORDERS_ID],'html',true),
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"你好，你提交的票据已派发：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$master_name,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$phone_number,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>$package_name,'color'=>"#743A3A"),
                    'keyword4'=>array('value'=>date('Y-m-d'),'color'=>"#743A3A"),
                    'remark'=>array('value'=>'查看详细信息请点击此消息。','color'=>'#743A3A'),
                )
            );
        $wechat = &load_wechat('Receive');
        $wechat->sendTemplateMessage($data);
    }
    
    //public $full_name = '1';
    
    public function test(){
        //return json_encode(\app\admin\model\BroadbandOrders::get('3912b4f4-bb23-11e7-b508-00163e0381f6'));
        //$Salesman = session('Salesman');
        $BroadbandOrderss = Db::table('broadband_orders')->alias('a')->where("a.delete_time",null)->join('Salesman s','a.author_openid = s.openid','LEFT')->join('deshang_information d','a.business_openid = d.openid','LEFT')->join('Salesman sa','a.author_openid = sa.openid','LEFT')->order('submission_time desc')->limit(50)->select();
        return json($BroadbandOrderss);
    }
    
    //退回
    public function Return(){
        $Salesman = session('Salesman');
        if($Salesman['FULL_NAME']==''){exit;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $reasons_for_return=$postdata['reasons_for_return'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->reasons_for_return=$reasons_for_return;
        $BroadbandOrders->audit_status = '退回';
        $BroadbandOrders->business_state = '退回';
        $BroadbandOrders->save();
        $UserInfor = session('UserInfor');
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$Salesman['FULL_NAME'].']退回订单，退回原因：'.$reasons_for_return;
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->sendTemplateMessage($BroadbandOrders->BROADBAND_ORDERS_ID,$BroadbandOrders->author_openid,$BroadbandOrders->master_name,$BroadbandOrders->phone_number,$BroadbandOrders->reasons_for_return);
        return 'ok';
    }
    
    //录入完成
    public function InputComplete(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        if($Salesman['FULL_NAME']==''){exit;}
        if($UserInfor['OPENID']==''){return;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->business_state = '录入完成';
        $BroadbandOrders->save();
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$Salesman['FULL_NAME'].']录入完成。';
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->EntryCompletionNotice($BroadbandOrders->BROADBAND_ORDERS_ID,$BroadbandOrders->author_openid,$BroadbandOrders->master_name,$BroadbandOrders->phone_number);
        return 'ok';
    }
    
    //安装完成
    public function InstallationComplete(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        if($Salesman['FULL_NAME']==''){exit;}
        if($UserInfor['OPENID']==''){return;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->business_state = '安装完成';
        $BroadbandOrders->save();
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$Salesman['FULL_NAME'].']安装完成。';
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        return 'ok';
    }
    
    public function getSalesman(){
        $Salesman = session('Salesman');
        return json($Salesman);
    }
    
    //票据已派发
    public function BillsIssued(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        if($Salesman['FULL_NAME']==''){exit;}
        if($UserInfor['OPENID']==''){return;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->business_state = '票据已派发';
        $BroadbandOrders->save();
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$Salesman['FULL_NAME'].']票据已派发。';
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->NoteIssued($BroadbandOrders->BROADBAND_ORDERS_ID,$BroadbandOrders->author_openid,$BroadbandOrders->master_name,$BroadbandOrders->phone_number,$BroadbandOrders->package_name);
        return 'ok';
    }
    
    //订单完成
    public function BillReturned(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        if($Salesman['FULL_NAME']==''){exit;}
        if($UserInfor['OPENID']==''){return;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->business_state = '订单已完成';
        $BroadbandOrders->save();
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$Salesman['FULL_NAME'].']订单已完成。';
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->TicketReturnNotification($BroadbandOrders->BROADBAND_ORDERS_ID,$BroadbandOrders->author_openid,$BroadbandOrders->master_name,$BroadbandOrders->phone_number,$BroadbandOrders->package_name);
        //计算业绩
        //是否存在该单的业绩，存在则不计算
        if(\app\admin\model\BroadbandPerformance::where("order_id",'=',$id)->count()==0){
            $BroadbandPackage = \app\admin\model\BroadbandPackage::get(['package_name' => $BroadbandOrders->package_name]);
            //本人绩效
            $Myself = \app\admin\model\UserList::get(['OPENID'=>$BroadbandOrders->author_openid]);
            $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
            $BroadbandPerformance->openid = $BroadbandOrders->author_openid;
            //获取销售人员信息，不同的人员按照不同的绩效金额
            $Salesman_ = \app\admin\model\Salesman::where('openid',$BroadbandOrders->author_openid)->find();
            $achievement = $BroadbandPackage->personal_performance;
            if($Salesman_->serve_as_a_post=='渠道1'){
                $achievement = $BroadbandPackage->channel_1_performance;
            }else if($Salesman_->serve_as_a_post=='渠道2'){
                $achievement = $BroadbandPackage->channel_2_performance;
            }
            $BroadbandPerformance->achievement = $achievement;
            $BroadbandPerformance->performance_category = '个人绩效';
            $BroadbandPerformance->performance_time = date('Y-m-d H-i-s');
            $BroadbandPerformance->order_id = $id;
            $BroadbandPerformance->package_name = $BroadbandOrders->package_name;
            $BroadbandPerformance->save();
        }
        $this->dshongbao($id);
        return 'ok';
    }
    
    //底商红包
    public function dshongbao($id){
        $UserInfor = session('UserInfor');
        if($UserInfor['OPENID']==''){return;}
        $broadband_orders = Db::table("broadband_orders")->where('delete_time',null)->where('BROADBAND_ORDERS_ID',$id)->find();
        if($broadband_orders['order_type']=='底商订单'){
            $business_openid = $broadband_orders['business_openid'];
            $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('openid',$business_openid)->find();
            $RedEnvelopes = getParameter('RedEnvelopes')*100;
            $pay = & load_dswechat('Pay');
            $result = $pay->sendRedPack($business_openid,$RedEnvelopes, date('YmdHis'), '合伙人', '恭喜', '奖励活动', '备注');
            if($result === FALSE){
                
            }else{
                $uuid = Db::query("select uuid() as uuid_");
                $data = ['OPERATION_LOG_ID' => $uuid[0]['uuid_'],'OPENID' => $UserInfor['OPENID'],'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'【system】订单完成，向底商【'.$deshang_information['name_of_the_merchant'].'】发送红包：'.getParameter('RedEnvelopes').'元。','correlation_id'=>$id];
                Db::table('operation_log')->insert($data);
            }
        }
    }
    
    //审核通过
    public function Approved(){
        $UserInfor = session('UserInfor');
        if($UserInfor['OPENID']==''){return;}
        $postdata = input('post.');
        $id=$postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $BroadbandOrders->audit_status = '审核通过';
        $BroadbandOrders->save();
        $OperationLog = new \app\admin\model\OperationLog();
        $OperationLog->OPENID = $UserInfor['OPENID'];
        $OperationLog->OPERATING_TIME = date('Y-m-d H-i-s');
        $OperationLog->OPERATION_CONTENT = '['.$UserInfor['full_name'].']审核通过。';
        $OperationLog->correlation_id = $BroadbandOrders->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->sendAuditNotificationMessage($BroadbandOrders->BROADBAND_ORDERS_ID,$BroadbandOrders->author_openid,$BroadbandOrders->master_name,$BroadbandOrders->phone_number,$BroadbandOrders->remarks);
        //计算业绩
        //是否存在该单的业绩，存在则不计算
        if(\app\admin\model\BroadbandPerformance::where("order_id",'=',$id)->count()==0){
            $BroadbandPackage = \app\admin\model\BroadbandPackage::get(['package_name' => $BroadbandOrders->package_name]);
            //本人绩效
            $Myself = \app\admin\model\UserList::get(['OPENID'=>$BroadbandOrders->author_openid]);
            $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
            $BroadbandPerformance->openid = $Myself->OPENID;
            $BroadbandPerformance->achievement = $BroadbandPackage->personal_performance;
            $BroadbandPerformance->performance_category = '个人绩效';
            $BroadbandPerformance->performance_time = date('Y-m-d H-i-s');
            $BroadbandPerformance->order_id = $id;
            $BroadbandPerformance->package_name = $BroadbandOrders->package_name;
            $BroadbandPerformance->save();
            //一级员工奖励
            $First = \app\admin\model\UserList::get(['OPENID'=>$Myself->superior_openid]);
            $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
            $BroadbandPerformance->openid = $First->OPENID;
            $BroadbandPerformance->achievement = $BroadbandPackage->first_class_employee_reward;
            $BroadbandPerformance->performance_category = '一级员工奖励';
            $BroadbandPerformance->performance_time = date('Y-m-d H-i-s');
            $BroadbandPerformance->order_id = $id;
            $BroadbandPerformance->package_name = $BroadbandOrders->package_name;
            $BroadbandPerformance->save();
            //二级员工奖励
            $LevelTwo = \app\admin\model\UserList::get(['OPENID'=>$First->superior_openid]);
            $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
            $BroadbandPerformance->openid = $LevelTwo->OPENID;
            $BroadbandPerformance->achievement = $BroadbandPackage->two_level_employee_reward;
            $BroadbandPerformance->performance_category = '二级员工奖励';
            $BroadbandPerformance->performance_time = date('Y-m-d H-i-s');
            $BroadbandPerformance->order_id = $id;
            $BroadbandPerformance->package_name = $BroadbandOrders->package_name;
            $BroadbandPerformance->save();
        }
        return 'ok';
    }
    
    //审核
    public function Audit($id){
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id,'userList');
        //Log::record('BroadbandOrders:'.json_encode($BroadbandOrders));
        //$BroadbandOrders['phone_number'] = str_replace('?','',$BroadbandOrders['phone_number']);
        //$BroadbandOrders = $BroadbandOrders->with('userList');
        $SecondTitle = '>审核宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        $this->assign('BroadbandOrders',$BroadbandOrders);
        return $this->fetch();
    }
    
    public function QueryPanels(){
        return $this->fetch();
    }
    
    protected $NumberRowsPerPage = 50;
    
    public function get(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandOrderss = Db::table('broadband_orders')->alias('a')->where("a.delete_time",null)->join('Salesman s','a.author_openid = s.openid','LEFT')->join('deshang_information d','a.business_openid = d.openid','LEFT')->join('Salesman sa','a.salesman_openid = sa.openid','LEFT')->where('sa.delete_time',null)->order('submission_time desc')->page($PageNumbers,$this->NumberRowsPerPage);
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandOrderss = $BroadbandOrderss->where('s.affiliated_business_hall',$affiliated_business_hall);
        }
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            if(trim($QueryCriteria['phone_number'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('a.PHONE_NUMBER','like','%'.$QueryCriteria['phone_number'].'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('master_name','like','%'.$QueryCriteria['master_name'].'%');
            }
            if(trim($QueryCriteria['dishang'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('name_of_the_merchant','like','%'.$QueryCriteria['dishang'].'%');
            }
            if(trim($QueryCriteria['yewuyuan'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('sa.FULL_NAME','like','%'.$QueryCriteria['yewuyuan'].'%');
            }
            if(trim($QueryCriteria['submission_time1'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('submission_time','>=',$QueryCriteria['submission_time1']);
            }
            if(trim($QueryCriteria['submission_time2'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('submission_time','<=',$QueryCriteria['submission_time2'].' 23:59:59');
            }
            if(trim($QueryCriteria['affiliated_business_hall'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('s.affiliated_business_hall','=',$QueryCriteria['affiliated_business_hall']);
            }
            if(trim($QueryCriteria['business_state'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('a.business_state','=',$QueryCriteria['business_state']);
            }
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandOrderss = $BroadbandOrderss->where('s.FULL_NAME', 'like','%'.$full_name.'%');
            }
        }
        return json($BroadbandOrderss->field(['*','s.FULL_NAME'=>'sFULL_NAME','sa.FULL_NAME'=>'saFULL_NAME','s.affiliated_business_hall'=>'saffiliated_business_hall'])->select());
    }
    
    public function get_(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandOrderss = new \app\admin\model\BroadbandOrders();
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandOrderss = $BroadbandOrderss->hasWhere('Salesman',function($query)use($affiliated_business_hall){$query->where('affiliated_business_hall',$affiliated_business_hall);});
        }
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            
            if(trim($QueryCriteria['phone_number'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('phone_number','like','%'.$QueryCriteria['phone_number'].'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('master_name','like','%'.$QueryCriteria['master_name'].'%');
            }
            if(trim($QueryCriteria['submission_time'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('submission_time','>=',$QueryCriteria['submission_time'])->where('submission_time','<=',$QueryCriteria['submission_time'].' 23:59:59');
            }
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandOrderss = $BroadbandOrderss->hasWhere('Salesman',function($query)use($full_name){$query->where('full_name', 'like','%'.$full_name.'%');});
            }
        }
        $BroadbandOrderss = $BroadbandOrderss->with('userList');
        $BroadbandOrderss = $BroadbandOrderss->order('submission_time desc')->page($PageNumbers,$this->NumberRowsPerPage)->select();
        return json($BroadbandOrderss);
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandOrderss = Db::table('broadband_orders')->alias('a')->where("a.delete_time",null)->join('Salesman s','a.author_openid = s.openid','LEFT')->order('submission_time desc')->page($PageNumbers,$this->NumberRowsPerPage);
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandOrderss = $BroadbandOrderss->where('s.affiliated_business_hall',$affiliated_business_hall);
        }
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            if(trim($QueryCriteria['phone_number'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('a.PHONE_NUMBER','like','%'.$QueryCriteria['phone_number'].'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('master_name','like','%'.$QueryCriteria['master_name'].'%');
            }
            if(trim($QueryCriteria['dishang'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('name_of_the_merchant','like','%'.$QueryCriteria['dishang'].'%');
            }
            if(trim($QueryCriteria['yewuyuan'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('sa.FULL_NAME','like','%'.$QueryCriteria['yewuyuan'].'%');
            }
            if(trim($QueryCriteria['submission_time1'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('submission_time','>=',$QueryCriteria['submission_time1']);
            }
            if(trim($QueryCriteria['submission_time2'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('submission_time','<=',$QueryCriteria['submission_time2'].' 23:59:59');
            }
            if(trim($QueryCriteria['affiliated_business_hall'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('s.affiliated_business_hall','=',$QueryCriteria['affiliated_business_hall']);
            }
            if(trim($QueryCriteria['business_state'])!=''){
                $BroadbandOrderss = $BroadbandOrderss->where('a.business_state','=',$QueryCriteria['business_state']);
            }
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandOrderss = $BroadbandOrderss->where('FULL_NAME', 'like','%'.$full_name.'%');
            }
        }
        $res = new \app\admin\model\Feature();
        $res->total = $BroadbandOrderss->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $postdata = input('post.');
        $BroadbandOrders = new \app\admin\model\BroadbandOrders($postdata['Broadbandorders']);
        $BroadbandOrders->save();
        return 'ok';
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $SecondTitle = '>编辑宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        $this->assign('BroadbandOrders',$BroadbandOrders);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $postdata = input('post.');
        $data = $postdata['Broadbandorders'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($data['BROADBAND_ORDERS_ID']);
        $BroadbandOrders->data($data);
        $BroadbandOrders->save();
        return 'ok';
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $SecondTitle = '>删除宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        $this->assign('BroadbandOrders',$BroadbandOrders);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_ORDERS_ID = $postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($BROADBAND_ORDERS_ID);
        $BroadbandOrders->delete();
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::where('order_id',$BROADBAND_ORDERS_ID);
        $BroadbandPerformance->delete();
        return 'ok';
    }
}
