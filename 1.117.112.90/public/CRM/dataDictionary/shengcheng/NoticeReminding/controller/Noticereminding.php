<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Noticereminding extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "通知提醒";
        $Feature->DataUrl = "/admin/Noticereminding/get";
        $Feature->TableHeader = array("被通知人openid","通知时间","通知类型","通知内容","通知状态","读取时间","提醒时间");
        $Feature->Fields = array("NOTICE_REMINDING_ID","notified_openid","notification_time","notification_type","notification_content","notification_status","read_time","reminding_time");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Noticereminding/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Noticereminding/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Noticereminding/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $NoticeRemindings = \app\admin\model\NoticeReminding::where('NOTICE_REMINDING_ID','<>','')->order("display_order")->select();
        return json($NoticeRemindings);
    }
    
    public function add(){
        $SecondTitle = '>添加通知提醒';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/noticereminding');
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
        $NoticeReminding = new \app\admin\model\NoticeReminding($postdata['Noticereminding']);
        $NoticeReminding->save();
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
        $NoticeReminding = \app\admin\model\NoticeReminding::get($id);
        $SecondTitle = '>编辑通知提醒';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/noticereminding');
        $this->assign('NoticeReminding',$NoticeReminding);
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
        $data = $postdata['Noticereminding'];
        $NoticeReminding = \app\admin\model\NoticeReminding::get($data['NOTICE_REMINDING_ID']);
        $NoticeReminding->data($data);
        $NoticeReminding->save();
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
        $NoticeReminding = \app\admin\model\NoticeReminding::get($id);
        $SecondTitle = '>删除通知提醒';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/noticereminding');
        $this->assign('NoticeReminding',$NoticeReminding);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $NOTICE_REMINDING_ID = $postdata['NOTICE_REMINDING_ID'];
        $NoticeReminding = \app\admin\model\NoticeReminding::get($NOTICE_REMINDING_ID);
        $NoticeReminding->delete();
        return 'ok';
    }
}
