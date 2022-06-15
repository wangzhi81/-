<?php

namespace app\comm\controller;

use think\Db;
use think\Controller;
use think\Request;

class Read extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return "Read";
    }
    
    //读取日志
    public function ReadOperationLogs($correlation_id){
        $OperationLogs = \app\comm\model\OperationLog::where("correlation_id","=",$correlation_id)->order("OPERATING_TIME")->select();
        return json($OperationLogs);
    }
    
    protected function DataSorting($a,$b)
    {
        if ($a->DISPLAY_ORDER==$b->DISPLAY_ORDER) return 0;
        return ($a->DISPLAY_ORDER<$b->DISPLAY_ORDER)?-1:1;
    }
    
    public function getMenuList()
    {
        $UserInfor = session('UserInfor');
        $UserList = \app\comm\model\UserList::get($UserInfor['USER_LIST_ID']);
        $Urats = $UserList->getUrat;
        $menu_ids = array();
        foreach ($Urats as $key => $value) {
            array_push($menu_ids,$value->menu_id);
        }
        $MenuLists = array();
        if(count($menu_ids)>0){
            $MenuLists = \app\comm\model\MenuList::all($menu_ids);
        }
        //return json($Urats);
        usort($MenuLists,array('\app\comm\controller\Read','DataSorting'));
        $MenuLists_ = \app\comm\model\MenuList::where('designated_personnel','=',$UserInfor['OPENID'])->order("DISPLAY_ORDER")->select();
        //return json($MenuLists_);
        return json(array_merge($MenuLists, $MenuLists_));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $UserInfor = session('UserInfor');
        return json($UserInfor);
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
