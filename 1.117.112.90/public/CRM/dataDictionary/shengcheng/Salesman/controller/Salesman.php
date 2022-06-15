<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Salesman extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "销售人员";
        $Feature->DataUrl = "/admin/Salesman/get";
        $Feature->TableHeader = array("姓名","手机号码","openid","登记时间","绑定时间","头像","验证码","所属营业厅","担任职务");
        $Feature->Fields = array("SALESMAN_ID","FULL_NAME","PHONE_NUMBER","openid","registration_time","binding_time","head_portrait","verification_code","affiliated_business_hall","serve_as_a_post");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Salesman/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Salesman/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Salesman/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $Salesmans = \app\admin\model\Salesman::where('SALESMAN_ID','<>','')->order("display_order")->select();
        return json($Salesmans);
    }
    
    public function add(){
        $SecondTitle = '>添加销售人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/salesman');
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
        $Salesman = new \app\admin\model\Salesman($postdata['Salesman']);
        $Salesman->save();
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
        $Salesman = \app\admin\model\Salesman::get($id);
        $SecondTitle = '>编辑销售人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/salesman');
        $this->assign('Salesman',$Salesman);
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
        $data = $postdata['Salesman'];
        $Salesman = \app\admin\model\Salesman::get($data['SALESMAN_ID']);
        $Salesman->data($data);
        $Salesman->save();
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
        $Salesman = \app\admin\model\Salesman::get($id);
        $SecondTitle = '>删除销售人员';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/salesman');
        $this->assign('Salesman',$Salesman);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $SALESMAN_ID = $postdata['SALESMAN_ID'];
        $Salesman = \app\admin\model\Salesman::get($SALESMAN_ID);
        $Salesman->delete();
        return 'ok';
    }
}
