<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Log;
use think\Db;

class Broadbandperformance extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带业绩";
        $Feature->DataUrl = "/admin/Broadbandperformance/get";
        $Feature->TableHeader = array("姓名","营业厅","职务","业绩","业绩类别","绩效时间","主号姓名","手机号码","套餐名称");
        $Feature->Fields = array("BROADBAND_PERFORMANCE_ID","FULL_NAME","affiliated_business_hall","serve_as_a_post","achievement","performance_category","performance_time","master_name","phone_number","package_name");
        $Feature->Operations= array(
                //array('name'=>'编辑','url'=>'/admin/Broadbandperformance/edit/id/'),
                //array('name'=>'删除','url'=>'/admin/Broadbandperformance/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                //array('name'=>'添加','url'=>'/admin/Broadbandperformance/add')
            );
        $Feature->QueryPanels = "/admin/BroadbandPerformance/QueryPanels";
        $Feature->PageInforUrl = "/admin/BroadbandPerformance/PageInformation";
        $Feature->ScriptFragment ='dict/BroadbandPerformance';
        return json($Feature);
    }
    
    //获取营业厅
    public function getBusinessHall(){
        $BusinessHalls = \app\admin\model\BusinessHall::where('BUSINESS_HALL_ID','<>','')->order('display_order')->select();
        return json($BusinessHalls);
    }
    
    //获取职务
    public function getJobInformation(){
        $JobInformation = Db::table('job_information')->where('delete_time',null)->select();
        return json($JobInformation);
    }
    
    public function Export(){
        header("Content-Type: application/vnd.ms-excel; charset=GBK");
        header("Content-Disposition: attachment;filename=业绩数据.csv ");
        $csvstr = "姓名,营业厅,职务,业绩,业绩类别,绩效时间,主号姓名,手机号码,套餐名称,行政区,社区,备注\n";
        $BroadbandPerformances_ = Db::table('broadband_performance')->alias('a')->join('Salesman s','a.openid = s.openid','LEFT')->join('broadband_orders b','a.order_id = b.BROADBAND_ORDERS_ID','LEFT')->where('a.delete_time',null);
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
        }
        if(null !== session('QueryCriteria')){
            $QueryCriteria = session('QueryCriteria');
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.FULL_NAME', 'like','%'.$full_name.'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $master_name = $QueryCriteria['master_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.master_name', 'like','%'.$master_name.'%');
            }
            if(trim($QueryCriteria['phone_number'])!=''){
                $phone_number = $QueryCriteria['phone_number'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.phone_number', 'like','%'.$phone_number.'%');
            }
            if(isset($QueryCriteria['affiliated_business_hall'])&&trim($QueryCriteria['affiliated_business_hall'])!=''){
                $affiliated_business_hall = $QueryCriteria['affiliated_business_hall'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
            }
            if(trim($QueryCriteria['performance_time_min'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','>=',$QueryCriteria['performance_time_min']);
            }
            if(trim($QueryCriteria['performance_time_max'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','<=',$QueryCriteria['performance_time_max'].' 23:59:59');
            }
            if(trim($QueryCriteria['JobInformation'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.serve_as_a_post','=',$QueryCriteria['JobInformation']);
            }
        }
        $BroadbandPerformances_ = $BroadbandPerformances_->order('performance_time desc')->select();
        foreach ($BroadbandPerformances_ as $key => $value) {
            //$csvstr.=json_encode($value);
            $csvstr.=($this->CommaHandling($value['FULL_NAME']).',');
            $csvstr.=($this->CommaHandling($value['affiliated_business_hall']).',');
            $csvstr.=($this->CommaHandling($value['serve_as_a_post']).',');
            $csvstr.=($this->CommaHandling($value['achievement']).',');
            $csvstr.=($this->CommaHandling($value['performance_category']).',');
            $csvstr.=($this->CommaHandling($value['performance_time']).',');
            $csvstr.=($this->CommaHandling($value['master_name']).',');
            $csvstr.=($this->CommaHandling($value['phone_number']).',');
            $csvstr.=($this->CommaHandling($value['package_name']).",");
            $csvstr.=($this->CommaHandling($value['administrative_area']).",");
            $csvstr.=($this->CommaHandling($value['community']).",");
            $csvstr.=($this->CommaHandling($value['remarks'])."\n");
        }
        $csvstr = chr(0xEF).chr(0xBB).chr(0xBF).$csvstr;
        //$csvstr =iconv('UTF-8','GBK',$csvstr);
        return $csvstr;
    }
    
    public function CommaHandling($str){
        return str_replace(',','，',$str);
    }
    
    public function QueryPanels(){
        $Salesman = session('Salesman');
        $this->assign('serve_as_a_post', $Salesman['serve_as_a_post']);
        return $this->fetch();
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandPerformances_ = Db::table('broadband_performance')->alias('a')->join('Salesman s','a.openid = s.openid','LEFT')->join('broadband_orders b','a.order_id = b.BROADBAND_ORDERS_ID','LEFT')->where('a.delete_time',null);
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
        }
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            session("QueryCriteria",$QueryCriteria);
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.FULL_NAME', 'like','%'.$full_name.'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $master_name = $QueryCriteria['master_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.master_name', 'like','%'.$master_name.'%');
            }
            if(trim($QueryCriteria['phone_number'])!=''){
                $phone_number = $QueryCriteria['phone_number'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.phone_number', 'like','%'.$phone_number.'%');
            }
            if(isset($QueryCriteria['affiliated_business_hall'])&&trim($QueryCriteria['affiliated_business_hall'])!=''){
                $affiliated_business_hall = $QueryCriteria['affiliated_business_hall'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
            }
            if(trim($QueryCriteria['performance_time_min'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','>=',$QueryCriteria['performance_time_min']);
            }
            if(trim($QueryCriteria['performance_time_max'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','<=',$QueryCriteria['performance_time_max'].' 23:59:59');
            }
            if(trim($QueryCriteria['JobInformation'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.serve_as_a_post','=',$QueryCriteria['JobInformation']);
            }
        }
        $res = new \app\admin\model\Feature();
        $res->total = $BroadbandPerformances_->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
    }
    
    protected $NumberRowsPerPage = 50;
    
    public function get(){
        session("QueryCriteria",null);
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $Salesman = session('Salesman');
        $BroadbandPerformances_ = Db::table('broadband_performance')->alias('a')->join('Salesman s','a.openid = s.openid','LEFT')->join('broadband_orders b','a.order_id = b.BROADBAND_ORDERS_ID','LEFT')->where('a.delete_time',null);
        $Salesman = session('Salesman');
        if($Salesman['serve_as_a_post']=='营业厅经理'||$Salesman['serve_as_a_post']=='营业厅文员'){
            $affiliated_business_hall = $Salesman['affiliated_business_hall'];
            $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
        }
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            session("QueryCriteria",$QueryCriteria);
            if(trim($QueryCriteria['full_name'])!=''){
                $full_name = $QueryCriteria['full_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.FULL_NAME', 'like','%'.$full_name.'%');
            }
            if(trim($QueryCriteria['master_name'])!=''){
                $master_name = $QueryCriteria['master_name'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.master_name', 'like','%'.$master_name.'%');
            }
            if(trim($QueryCriteria['phone_number'])!=''){
                $phone_number = $QueryCriteria['phone_number'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('b.phone_number', 'like','%'.$phone_number.'%');
            }
            if(isset($QueryCriteria['affiliated_business_hall'])&&trim($QueryCriteria['affiliated_business_hall'])!=''){
                $affiliated_business_hall = $QueryCriteria['affiliated_business_hall'];
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.affiliated_business_hall',$affiliated_business_hall);
            }
            if(trim($QueryCriteria['performance_time_min'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','>=',$QueryCriteria['performance_time_min']);
            }
            if(trim($QueryCriteria['performance_time_max'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('a.performance_time','<=',$QueryCriteria['performance_time_max'].' 23:59:59');
            }
            if(trim($QueryCriteria['JobInformation'])!=''){
                $BroadbandPerformances_ = $BroadbandPerformances_->where('s.serve_as_a_post','=',$QueryCriteria['JobInformation']);
            }
        }
        $BroadbandPerformances_ = $BroadbandPerformances_->page($PageNumbers,$this->NumberRowsPerPage)->order('performance_time desc')->select();
        return json($BroadbandPerformances_);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
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
        $BroadbandPerformance = new \app\admin\model\BroadbandPerformance($postdata['Broadbandperformance']);
        $BroadbandPerformance->save();
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
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($id);
        $SecondTitle = '>编辑宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
        $this->assign('BroadbandPerformance',$BroadbandPerformance);
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
        $data = $postdata['Broadbandperformance'];
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($data['BROADBAND_PERFORMANCE_ID']);
        $BroadbandPerformance->data($data);
        $BroadbandPerformance->save();
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
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($id);
        $SecondTitle = '>删除宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
        $this->assign('BroadbandPerformance',$BroadbandPerformance);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_PERFORMANCE_ID = $postdata['BROADBAND_PERFORMANCE_ID'];
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($BROADBAND_PERFORMANCE_ID);
        $BroadbandPerformance->delete();
        return 'ok';
    }
}
