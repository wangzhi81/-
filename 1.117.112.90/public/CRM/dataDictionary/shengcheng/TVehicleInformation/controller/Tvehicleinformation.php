<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Tvehicleinformation extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "车辆信息";
        $Feature->DataUrl = "/admin/Tvehicleinformation/get";
        $Feature->TableHeader = array("设备号","状态说明","经度","纬度","速度","航向","定位类型","车牌号","车架号","更新时间","数据包","地址","ACC状态","百度经度","百度纬度","是否超速","轨迹时间","电子围栏ID","是否出界","总里程","当日里程","超速时间","长时超速","限速路段");
        $Feature->Fields = array("T_VEHICLE_INFORMATION_ID","equipment_number","status_description","longitude","latitude","speed","course","location_type","license_plate_number","frame_number","update_time","data_packet","address","acc_status","baidu_longitude","baidu_latitude","overspeed","track_time","electronic_fence_id","out_of_bounds","total_mileage","mileage_of_the_day","overspeed_time","long_term_overspeed","speed_limit_section");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Tvehicleinformation/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Tvehicleinformation/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Tvehicleinformation/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $TVehicleInformations = \app\admin\model\TVehicleInformation::where('T_VEHICLE_INFORMATION_ID','<>','')->order("display_order")->select();
        return json($TVehicleInformations);
    }
    
    public function add(){
        $SecondTitle = '>添加车辆信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tvehicleinformation');
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
        $TVehicleInformation = new \app\admin\model\TVehicleInformation($postdata['Tvehicleinformation']);
        $TVehicleInformation->save();
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
        $TVehicleInformation = \app\admin\model\TVehicleInformation::get($id);
        $SecondTitle = '>编辑车辆信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tvehicleinformation');
        $this->assign('TVehicleInformation',$TVehicleInformation);
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
        $data = $postdata['Tvehicleinformation'];
        $TVehicleInformation = \app\admin\model\TVehicleInformation::get($data['T_VEHICLE_INFORMATION_ID']);
        $TVehicleInformation->data($data);
        $TVehicleInformation->save();
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
        $TVehicleInformation = \app\admin\model\TVehicleInformation::get($id);
        $SecondTitle = '>删除车辆信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tvehicleinformation');
        $this->assign('TVehicleInformation',$TVehicleInformation);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $T_VEHICLE_INFORMATION_ID = $postdata['T_VEHICLE_INFORMATION_ID'];
        $TVehicleInformation = \app\admin\model\TVehicleInformation::get($T_VEHICLE_INFORMATION_ID);
        $TVehicleInformation->delete();
        return 'ok';
    }
}
