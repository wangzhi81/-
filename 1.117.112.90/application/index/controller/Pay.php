<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Log;
use think\Db;

class Pay extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return 'WinPay1';
    }

    /**
     * 支付通知.
     *
     * @return \think\Response
     */
    public function notify()
    {
        // 实例支付接口
        $pay = & load_wechat('Pay');
        // 获取支付通知
        $notifyInfo = $pay->getNotify();
        Log::record("createMchPay:notifyInfo:".json_encode($notifyInfo));
        // 支付通知数据获取失败
        if($notifyInfo===FALSE){
        	// 接口失败的处理
            echo $pay->errMsg;
        }else{
        	//支付通知数据获取成功
             if ($notifyInfo['result_code'] == 'SUCCESS' && $notifyInfo['return_code'] == 'SUCCESS') {
                // 支付状态完全成功，可以更新订单的支付状态了
                // @todo 
                // 返回XML状态，至于XML数据可以自己生成，成功状态是必需要返回的。
                // <xml>
                //    return_code><![CDATA[SUCCESS]]></return_code>
                //    return_msg><![CDATA[OK]]></return_msg>
                // </xml>
                $out_trade_no = $notifyInfo['out_trade_no'];
                $total_fee = $notifyInfo['total_fee']/100;
                $openid = $notifyInfo['openid'];
                $salesman = Db::table('salesman')->where('openid','=',$openid)->find();
                $broadband_orders = Db::table('broadband_orders')->where("order_number","=",$out_trade_no)->find();
                Db::table('broadband_orders')->where("order_number","=",$out_trade_no)->update(['whether_to_pay' => '已支付','amount_of_payment'=>$total_fee,'business_state'=>'订单已完成']);
                $OperationLog = new \app\index\model\OperationLog();
                $OperationLog->OPENID = $notifyInfo['openid'];
                $OperationLog->OPERATING_TIME = date('Y-m-d H:i:s');
                $OperationLog->OPERATION_CONTENT = '['.$salesman['FULL_NAME'].']支付完成，支付金额￥'.($total_fee).'元。';
                $OperationLog->correlation_id = $broadband_orders['BROADBAND_ORDERS_ID'];
                $OperationLog->save();
                //计算业绩
                if(\app\admin\model\BroadbandPerformance::where("order_id",'=',$broadband_orders['BROADBAND_ORDERS_ID'])->count()==0){
                    $BroadbandPackage = \app\admin\model\BroadbandPackage::get(['package_name' => $broadband_orders['package_name']]);
                    //本人绩效
                    $Myself = \app\admin\model\UserList::get(['OPENID'=>$broadband_orders['author_openid']]);
                    $BroadbandPerformance = new \app\admin\model\BroadbandPerformance();
                    $BroadbandPerformance->openid = $openid;
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
                    $BroadbandPerformance->performance_time = date('Y-m-d H:i:s');
                    $BroadbandPerformance->order_id = $broadband_orders['BROADBAND_ORDERS_ID'];
                    $BroadbandPerformance->package_name = $broadband_orders['package_name'];
                    $BroadbandPerformance->save();
                }
                //支付记账
                $uuid = Db::query("select uuid() as uuid_");
                $data = ['PAYMENT_OF_ACCOUNT_ID'=>$uuid[0]['uuid_'],'order_id' => $broadband_orders['BROADBAND_ORDERS_ID'], 'payer_openid' => $openid,'payment_time'=>date('Y-m-d H:i:s'),'amount_of_payment'=>$total_fee,'payment_method'=>'微信支付','payee_openid'=>'商户平台'];
                //Log::record(date('Y-m-d H:i:s')."：支付记账:".json_encode($data));
                Db::table('payment_of_account')->insert($data);
                return xml(['return_code' => 'SUCCESS', 'return_msg' => 'DEAL WITH SUCCESS']);
             }
        }
    }

    /**
     * 创建qrcPrepayid
     */
    public function createMchPay()
    { 
        $openid = getOpenid();
        $postdata = input('post.');
        $body = $postdata['body'];
        $BROADBAND_ORDERS_ID=$postdata['BROADBAND_ORDERS_ID'];
        
        $order_number = substr($BROADBAND_ORDERS_ID,0,13).date('YmdHis');
        //$order_number = date('YmdHis');
        Db::table('broadband_orders')->where("BROADBAND_ORDERS_ID","=",$BROADBAND_ORDERS_ID)->update(['order_number' => $order_number]);
        $broadband_orders = Db::table('broadband_orders')->where("BROADBAND_ORDERS_ID","=",$BROADBAND_ORDERS_ID)->find();
        //Log::record("createMchPay:broadband_orders:".json_encode($broadband_orders));
        $package_name = $broadband_orders['package_name'];
        $access_mode = $broadband_orders['access_mode'];
        $broadband_package = Db::table('broadband_package')->where('package_name','=',$package_name)->find();
        //Log::record("createMchPay:broadband_package:".json_encode($broadband_package));
        //计算支付金额
        $total_fee = $broadband_package['amount_of_payment']*1.0;
        Log::record("createMchPay:access_mode:".json_encode($access_mode));
        if($access_mode=='FTTB'){
            $ParameterSetting =\app\index\model\ParameterSetting::get(['parameter_name' => 'FTTBDeposit']);
            Log::record("createMchPay:ParameterSetting:".json_encode($ParameterSetting));
            $total_fee += $ParameterSetting['parameter_values']*1.0;
        }else if($access_mode=='FTTH'){
            $ParameterSetting =\app\index\model\ParameterSetting::get(['parameter_name' => 'FTTHDeposit']);
            Log::record("createMchPay:ParameterSetting:".json_encode($ParameterSetting));
            $total_fee += $ParameterSetting['parameter_values']*1.0;
        }
        $total_fee = ceil($total_fee*100);
        //Log::record("createMchPay:total_fee:".json_encode($total_fee));
        if($openid=='oRGkj1tJrIjRyF1MYxufY4pKqVME'){
            $total_fee = 1;
        }
        //$total_fee = 1;
        //$broadband_orders['order_number'] = substr($BROADBAND_ORDERS_ID,0,13);
        //$broadband_orders->save();
        $pay = & load_wechat('Pay');
        $notify_url = 'http://kod.syjs.net.cn/index/pay/notify';
        //$ParameterSetting = \app\index\model\ParameterSetting::get(['parameter_name' => 'AmountPaid']);
        
        $result = $pay->getPrepayId($openid, $body, $order_number, $total_fee, $notify_url,$trade_type = "JSAPI");
        $options = $pay->createMchPay($result);
        Log::record(date('H:i:s').":createMchopenids:".json_encode($openid));
        Log::record(date('H:i:s').":createMchbroadband_orders:".json_encode($broadband_orders));
        Log::record(date('H:i:s').":createMchPayresult:".json_encode($result));
        Log::record(date('H:i:s').":createMchPayoptions:".json_encode($options));
        return json($options);
    }
    
    //支付确认
    public function PaymentConfirmation(){
        
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
