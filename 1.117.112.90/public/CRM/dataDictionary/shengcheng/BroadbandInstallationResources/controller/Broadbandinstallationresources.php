<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Broadbandinstallationresources extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带安装资源";
        $Feature->DataUrl = "/admin/Broadbandinstallationresources/get";
        $Feature->TableHeader = array("区域","街道","路巷村","小区","街路名","楼编号","显示顺序","最后时间");
        $Feature->Fields = array("BROADBAND_INSTALLATION_RESOURCES_ID","region","street","lane_village","residential_quarters","street_name","building_number","display_order","last_time");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Broadbandinstallationresources/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Broadbandinstallationresources/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Broadbandinstallationresources/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BroadbandInstallationResourcess = \app\admin\model\BroadbandInstallationResources::where('BROADBAND_INSTALLATION_RESOURCES_ID','<>','')->order("display_order")->select();
        return json($BroadbandInstallationResourcess);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带安装资源';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandinstallationresources');
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
        $BroadbandInstallationResources = new \app\admin\model\BroadbandInstallationResources($postdata['Broadbandinstallationresources']);
        $BroadbandInstallationResources->save();
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
        $BroadbandInstallationResources = \app\admin\model\BroadbandInstallationResources::get($id);
        $SecondTitle = '>编辑宽带安装资源';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandinstallationresources');
        $this->assign('BroadbandInstallationResources',$BroadbandInstallationResources);
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
        $data = $postdata['Broadbandinstallationresources'];
        $BroadbandInstallationResources = \app\admin\model\BroadbandInstallationResources::get($data['BROADBAND_INSTALLATION_RESOURCES_ID']);
        $BroadbandInstallationResources->data($data);
        $BroadbandInstallationResources->save();
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
        $BroadbandInstallationResources = \app\admin\model\BroadbandInstallationResources::get($id);
        $SecondTitle = '>删除宽带安装资源';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandinstallationresources');
        $this->assign('BroadbandInstallationResources',$BroadbandInstallationResources);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_INSTALLATION_RESOURCES_ID = $postdata['BROADBAND_INSTALLATION_RESOURCES_ID'];
        $BroadbandInstallationResources = \app\admin\model\BroadbandInstallationResources::get($BROADBAND_INSTALLATION_RESOURCES_ID);
        $BroadbandInstallationResources->delete();
        return 'ok';
    }
}
