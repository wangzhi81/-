<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Housekeepingstaff extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "家政服务人员";
        $Feature->DataUrl = "/admin/Housekeepingstaff/get";
        $Feature->TableHeader = array("姓名","服务类别","年龄","星等","服务次数","注册时间","头像");
        $Feature->Fields = array("HOUSEKEEPING_STAFF_ID","full_name","service_category","age","the_magnitude","service_times","registration_time","head_portrait");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Housekeepingstaff/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Housekeepingstaff/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Housekeepingstaff/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $HousekeepingStaffs = \app\admin\model\HousekeepingStaff::where('HOUSEKEEPING_STAFF_ID','<>','')->order("display_order")->select();
        return json($HousekeepingStaffs);
    }
    
    public function add(){
        $SecondTitle = '>添加家政服务人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingstaff');
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
        $HousekeepingStaff = new \app\admin\model\HousekeepingStaff($postdata['Housekeepingstaff']);
        $HousekeepingStaff->save();
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
        $HousekeepingStaff = \app\admin\model\HousekeepingStaff::get($id);
        $SecondTitle = '>编辑家政服务人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingstaff');
        $this->assign('HousekeepingStaff',$HousekeepingStaff);
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
        $data = $postdata['Housekeepingstaff'];
        $HousekeepingStaff = \app\admin\model\HousekeepingStaff::get($data['HOUSEKEEPING_STAFF_ID']);
        $HousekeepingStaff->data($data);
        $HousekeepingStaff->save();
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
        $HousekeepingStaff = \app\admin\model\HousekeepingStaff::get($id);
        $SecondTitle = '>删除家政服务人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingstaff');
        $this->assign('HousekeepingStaff',$HousekeepingStaff);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $HOUSEKEEPING_STAFF_ID = $postdata['HOUSEKEEPING_STAFF_ID'];
        $HousekeepingStaff = \app\admin\model\HousekeepingStaff::get($HOUSEKEEPING_STAFF_ID);
        $HousekeepingStaff->delete();
        return 'ok';
    }
}
