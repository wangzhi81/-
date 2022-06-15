<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Deshanginformation extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "底商信息";
        $Feature->DataUrl = "/admin/Deshanginformation/get";
        $Feature->TableHeader = array("商户名称","联系电话","商户地址","审核状态");
        $Feature->Fields = array("DESHANG_INFORMATION_ID","name_of_the_merchant","contact_number","business_address","audit_status");
        $Feature->Operations= array(
                array('name'=>'审核','url'=>'/admin/Deshanginformation/shenhe/id/'),
                array('name'=>'二维码','url'=>'/admin/Deshanginformation/erwima/id/'),
                array('name'=>'删除','url'=>'/admin/Deshanginformation/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Deshanginformation/add')
            );
        return json($Feature);
    }
    
    //二维码
    public function erwima($id){
        $DeshangInformation = Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$id)->find();
        $qrcodeurl = urldecode("http://kod.syjs.net.cn/index/Bottom/xiadan/id/".$id);
        $this->assign('DeshangInformation',$DeshangInformation);
        $this->assign('SecondTitle', "底商二维码");
        $this->assign('qrcodeurl',$qrcodeurl);
        $this->assign('ScriptFragment','dict/deshanginformation');
        return $this->fetch();
    }
    
    //审核
    public function shenhe($id){
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$id)->find();
        $this->assign('DeshangInformation', $deshang_information);
        $this->assign('SecondTitle', "审核底商信息");
        $this->assign('ScriptFragment','dict/deshanginformation');
        return $this->fetch();
    }
    
    //审核通过
    public function tongguo(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        $posdata = input("post.");
        $DESHANG_INFORMATION_ID = $posdata['DESHANG_INFORMATION_ID'];
        Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$DESHANG_INFORMATION_ID)->update(['audit_status'=>'审核通过','audit_time'=>date('Y-m-d H:i:s')]);
        $uuid = Db::query("select uuid() as uuid_");
        $data = ['OPERATION_LOG_ID' => $uuid[0]['uuid_'],'OPENID' => $UserInfor['OPENID'],'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'【'.$Salesman['FULL_NAME'].'】审核通过。','correlation_id'=>$DESHANG_INFORMATION_ID];
        Db::table('operation_log')->insert($data);
        return 'ok';
    }
    
    //审核不通过
    public function butongguo(){
        $UserInfor = session('UserInfor');
        $Salesman = session('Salesman');
        $posdata = input("post.");
        $DESHANG_INFORMATION_ID = $posdata['DESHANG_INFORMATION_ID'];
        $reasons_for_not_passing = $posdata['reasons_for_not_passing'];
        Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$DESHANG_INFORMATION_ID)->update(['reasons_for_not_passing'=>$reasons_for_not_passing,'audit_status'=>'审核不通过']);
        $uuid = Db::query("select uuid() as uuid_");
        $data = ['OPERATION_LOG_ID' => $uuid[0]['uuid_'],'OPENID' => $UserInfor['OPENID'],'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'【'.$Salesman['FULL_NAME'].'】审核不通过，不通过原因：'.$reasons_for_not_passing.'。','correlation_id'=>$DESHANG_INFORMATION_ID];
        Db::table('operation_log')->insert($data);
        return 'ok';
    }
    
    //上传底商照片
    public function UploadMerchantPhotos(){
        if ((strpos($_FILES["file"]["type"],"image")==0)&&($_FILES["file"]["size"] < 4000000)){
            if ($_FILES["file"]["error"] > 0){
                return "error";
            }
            return saveUploadFileW($_FILES["file"]["tmp_name"]);
        }else{
            return "error";
        }
    }
    
    public function get(){
        $DeshangInformations = \app\admin\model\DeshangInformation::where('DESHANG_INFORMATION_ID','<>','')->order("display_order")->select();
        return json($DeshangInformations);
    }
    
    public function add(){
        $SecondTitle = '>添加底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
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
        $DeshangInformation = new \app\admin\model\DeshangInformation($postdata['Deshanginformation']);
        $DeshangInformation->save();
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
        $DeshangInformation = \app\admin\model\DeshangInformation::get($id);
        $SecondTitle = '>编辑底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
        $this->assign('DeshangInformation',$DeshangInformation);
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
        $data = $postdata['Deshanginformation'];
        $DeshangInformation = \app\admin\model\DeshangInformation::get($data['DESHANG_INFORMATION_ID']);
        $DeshangInformation->data($data);
        $DeshangInformation->save();
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
        $DeshangInformation = \app\admin\model\DeshangInformation::get($id);
        $SecondTitle = '>删除底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
        $this->assign('DeshangInformation',$DeshangInformation);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $DESHANG_INFORMATION_ID = $postdata['DESHANG_INFORMATION_ID'];
        $DeshangInformation = \app\admin\model\DeshangInformation::get($DESHANG_INFORMATION_ID);
        $DeshangInformation->delete();
        return 'ok';
    }
}
