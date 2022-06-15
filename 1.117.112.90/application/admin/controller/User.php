<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if(session('UserInfor')!=null){
            $Feature = new \app\admin\model\Feature();
            $Feature->Title = "用户管理";
            $Feature->DataUrl = "/admin/User/getList";
            $Feature->TableHeader = array("头像","姓名","昵称","性别","身份证号","手机号","省份","城市","权限");
            $Feature->Fields = array("USER_LIST_ID","HEAD_PORTRAIT","full_name","NICKNAME","GENDER","id_number","phone_number","PROVINCE","CITY","ROLE");
            $Feature->Operations= array(
                    array('name'=>'分配权限','url'=>'/admin/user/AssigningPermissions/id/')
                );
            $Feature->Buttons = array(
                    //array('name'=>'添加','url'=>'/admin/Index/addRight')
                );
            $Feature->PageInforUrl = "/admin/user/PageInformation";
            return json($Feature);
        }else{
            return;
        }
    }
    
    protected $NumberRowsPerPage = 50;
    
    public function getList(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $list = \app\admin\model\UserList::where('USER_LIST_ID','<>','')->order('ATTENTION_TIME','desc')->page($PageNumbers,$this->NumberRowsPerPage)->select();
        return json($list);
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $UserList = new \app\admin\model\UserList();
        $res = new \app\admin\model\Feature();
        $res->total = $UserList->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
    }
    
    //分配权限
    public function AssigningPermissions($id){
        $SecondTitle = '>分配权限';
        $UserList = \app\admin\model\UserList::get($id);
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','assigningpermissions');
        $this->assign('UserList',$UserList);
        return $this->fetch();
        //return json($SecondTitle);
    }
    
    //保存权限
    public function SavePermissions(){
        $USER_LIST_ID = input('USER_LIST_ID');
        $ROLE = input('ROLE');
        $UserList = \app\admin\model\UserList::get($USER_LIST_ID);
        $UserList->ROLE = $ROLE;
        $UserList->save();
        return "ok";
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $UserList = \app\admin\model\UserList::get('9c3b19d6-af4c-11e7-b508-00163e0381f6');
        $test = $UserList->getUrat()->select();
        $vs = array();
        foreach ($test as $key => $value) {
            array_push($vs,$value->menu_id);
        }
        return json(\app\admin\model\MenuList::all($vs));
        //return "123";
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
        //$user = \app\comm\model\UserList::get($id);
        //return json($user);
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
