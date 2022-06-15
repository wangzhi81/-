<?php
//出货记账
namespace app\index\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Shippingaccount extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    //删除出货记录
    public function delShippingAccount(){
        if(Session::has('login_information')){
            $robj = new \stdClass();
            $postdata = input("post.");
            $SHIPPING_ACCOUNT_ID = $postdata['SHIPPING_ACCOUNT_ID'];
            Db::table('shipping_account')->where('SHIPPING_ACCOUNT_ID',$SHIPPING_ACCOUNT_ID)->update(['delete_time'=>time()]);
            $robj->info = 'ok';
            return json($robj);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //出货详情
    public function detail($id){
        if(Session::has('login_information')){
            $ShippingAccount = Db::table('shipping_account')->alias('a')->join('customer_management c','a.customer_id = c.CUSTOMER_MANAGEMENT_ID','LEFT')->join('commodity_management m','a.commodity_id = m.COMMODITY_MANAGEMENT_ID','LEFT')->where('SHIPPING_ACCOUNT_ID',$id)->field('*,a.unit_price as unit_price_')->find();
            $ShippingAccount['shipping_time'] = substr($ShippingAccount['shipping_time'],0,10);
            $this->assign('ShippingAccount', $ShippingAccount);
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //出货记录
    public function getShippingAccount(){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $postdata = input("post.");
            $commodity = $postdata['commodity'];
            $customer = $postdata['customer'];
            $ShippingAccounts = Db::table('shipping_account')->alias('a')->where('a.owned_users',$login_information)->where('a.delete_time',null)->join('customer_management c','a.customer_id = c.CUSTOMER_MANAGEMENT_ID','LEFT')->join('commodity_management m','a.commodity_id = m.COMMODITY_MANAGEMENT_ID','LEFT');
            if($customer!=''){
                $ShippingAccounts = $ShippingAccounts->where('full_name','like','%'.$customer.'%');
            }
            if($commodity!=''){
                $ShippingAccounts = $ShippingAccounts->where('trade_name','like','%'.$commodity.'%');
            }
            $ShippingAccounts = $ShippingAccounts->order('shipping_time desc,entry_time desc')->field('*,a.unit_price as unit_price_')->limit(10000)->select();
            $zongkuan = 0;
            foreach($ShippingAccounts as $key => &$value) {
                foreach ($value as $key2 => &$value2) {
                    if($value2==null){$value2='--';}
                }
                $value['shipping_time'] = substr($value['shipping_time'],0,10);
                if($value['unit_price_']!='--'&&$value['quantity_shipped']!='--'){
                    $zongkuan+=($value['unit_price_']*$value['quantity_shipped']);
                }
            }
            $robj = new \stdClass();
            $robj->ShippingAccounts = $ShippingAccounts;
            $robj->zongkuan = $zongkuan;
            return json($robj);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //保存出货信息
    public function save(){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $robj = new \stdClass();
            $postdata = input("post.");
            $commodity_id;
            $commodity = $postdata['commodity'];
            $unit_price = $postdata['unit_price'];
            if(Db::table('commodity_management')->where("owned_users",$login_information)->where('trade_name',$commodity)->count()==0){
                $commodity_id = Db::query("select uuid() as uuid_")[0]['uuid_'];
                Db::table('commodity_management')->insert(['COMMODITY_MANAGEMENT_ID'=>$commodity_id,'trade_name'=>$commodity,'unit_price'=>$unit_price,'owned_users'=>$login_information]);
            }else{
                $commodity_management = Db::table('commodity_management')->where("owned_users",$login_information)->where('trade_name',$commodity)->find();
                $commodity_id = $commodity_management['COMMODITY_MANAGEMENT_ID'];
            }
            $customer_id;
            $customer = $postdata['customer'];
            if(Db::table('customer_management')->where("owned_users",$login_information)->where('full_name',$customer)->count()==0){
                $customer_id = Db::query("select uuid() as uuid_")[0]['uuid_'];
                Db::table('customer_management')->insert(['CUSTOMER_MANAGEMENT_ID'=>$customer_id,'full_name'=>$customer,'owned_users'=>$login_information]);
            }else{
                $customer_management = Db::table('customer_management')->where("owned_users",$login_information)->where('full_name',$customer)->find();
                $customer_id = $customer_management['CUSTOMER_MANAGEMENT_ID'];
            }
            $quantity_shipped = $postdata['quantity_shipped'];
            $ms = $postdata['ms'];
            if($ms=="返货"){$quantity_shipped=$quantity_shipped*(-1);}
            $shipping_time = $postdata['shipping_time'];
            $total_price = $postdata['total_price'];
            $login_information = Session::get('login_information');
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table('shipping_account')->insert(['SHIPPING_ACCOUNT_ID'=>$uuid,'commodity_id'=>$commodity_id,'customer_id'=>$customer_id,'quantity_shipped'=>$quantity_shipped,'owned_users'=>$login_information,'unit_price'=>$unit_price,'total_price'=>$total_price,'shipping_time'=>$shipping_time,'entry_time'=>date('Y-m-d H:i:s'),'shipment_return'=>$ms]);
            $robj->info = 'ok';
            return json($robj);
            //return 'q';
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //获取单个商品信息
    public function getShangpin(){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $postdata = input("post.");
            $trade_name = $postdata['id'];
            $CommodityManagement = Db::table('commodity_management')->where("owned_users",$login_information)->where("trade_name",$trade_name)->find();
            return json($CommodityManagement);
            //return $trade_name;
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //商品信息列表
    public function getCommodityManagement(){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $CommodityManagement = Db::table('commodity_management')->where("owned_users",$login_information)->order("trade_name")->limit(50)->select();
            return json($CommodityManagement);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //客户信息列表
    public function getCustomerManagement(){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $CustomerManagements = Db::table('customer_management')->where("owned_users",$login_information)->order("full_name")->limit(50)->select();
            return json($CustomerManagements);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //出货
    public function shipment($ms){
        if(Session::has('login_information')){
            $login_information = Session::get('login_information');
            $ShippingAccount = Db::table('shipping_account')->alias('a')->join('customer_management c','a.customer_id = c.CUSTOMER_MANAGEMENT_ID','LEFT')->join('commodity_management m','a.commodity_id = m.COMMODITY_MANAGEMENT_ID','LEFT')->where('a.owned_users',$login_information)->field('*,a.unit_price as unit_price_')->order("entry_time desc")->find();
            $this->assign('ShippingAccount', $ShippingAccount);
            if($ms=='ch'){
                $ms='出货';
            }else if($ms=='fh'){
                $ms='返货';
            }
            $this->assign('ms', $ms);
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
    
}