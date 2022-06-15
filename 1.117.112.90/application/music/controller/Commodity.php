<?php
namespace app\index\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Commodity extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    public function getCommoditys(){
        $login_information = Session::get('login_information');
        $commodity_managements = Db::table('commodity_management')->where('owned_users',$login_information)->order('modification_time desc')->limit(50)->select();
        $this->assign('commodity_managements', $commodity_managements);
        return $this->fetch();
    }
    
    public function saveImg(){
        $postdata = input("post.");
        $serverId = $postdata['serverId'];
        $media = & load_wechat('Media');
        $result = $media->getMedia($serverId);
        $HttpPath = saveUploadFile($result,$serverId);
        return $HttpPath;
    }
    
    public function save(){
        $robj = new \stdClass();
        $postdata = input("post.");
        $trade_name = $postdata['trade_name'];
        $commodity_pictures = $postdata['commodity_pictures'];
        $unit_price = $postdata['unit_price'];
        $login_information = Session::get('login_information');
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table('commodity_management')->insert(['COMMODITY_MANAGEMENT_ID'=>$uuid,'trade_name'=>$trade_name,'commodity_pictures'=>$commodity_pictures,'creation_time'=>date('Y-m-d H:i:s'),'modification_time'=>date('Y-m-d H:i:s'),'owned_users'=>$login_information,'unit_price'=>$unit_price]);
        $robj->info = 'ok';
        return json($robj);
    }
    
    public function add(){
        if(Session::has('login_information')){
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //更新商品信息
    public function update(){
        if(Session::has('login_information')){
            $robj = new \stdClass();
            $postdata = input("post.");
            $trade_name = $postdata['trade_name'];
            $commodity_pictures = $postdata['commodity_pictures'];
            $COMMODITY_MANAGEMENT_ID = $postdata['COMMODITY_MANAGEMENT_ID'];
            $unit_price = $postdata['unit_price'];
            $login_information = Session::get('login_information');
            Db::table('commodity_management')->where('COMMODITY_MANAGEMENT_ID',$COMMODITY_MANAGEMENT_ID)->update(['trade_name'=>$trade_name,'commodity_pictures'=>$commodity_pictures,'modification_time'=>date('Y-m-d H:i:s'),'owned_users'=>$login_information,'unit_price'=>$unit_price]);
            $robj->info = 'ok';
            return json($robj);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //修改商品
    public function edit($id){
        if(Session::has('login_information')){
            $commodity_management = Db::table('commodity_management')->where("COMMODITY_MANAGEMENT_ID",$id)->find();
            $this->assign('commodity_management', $commodity_management);
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
}