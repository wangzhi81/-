<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Log;
use think\Db;

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
        $Feature->TableHeader = array("头像","姓名","所示营业厅","职务","手机号码","登记时间","绑定时间");
        $Feature->Fields = array("SALESMAN_ID","head_portrait","FULL_NAME","affiliated_business_hall","serve_as_a_post","PHONE_NUMBER","registration_time","binding_time");
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
        $Feature->PageInforUrl = "/admin/Salesman/PageInformation";
        return json($Feature);
    }
    
    //提醒
    public function Remind(){
        $UserInfor = session('UserInfor');
        $OPENID = $UserInfor['OPENID'];
        $notice_reminding = Db::table('notice_reminding')->where('delete_time',null)->where('notification_status','=','未提醒')->where('notified_openid','=',$OPENID)->order('notification_time desc')->limit(1)->find();
        //$notice_reminding = Db::table('notice_reminding')->where('delete_time',null)->where('notification_status','=','未提醒')->order('notification_time desc')->limit(1)->find();
        Db::table('notice_reminding')->where('notified_openid','=',$OPENID)->update(['notification_status'=>'已提醒']);
        return json($notice_reminding);
    }
    
    //最终业绩计算
    public function FinalPerformanceCalculation(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "最终业绩计算";
        $Feature->DataUrl = "/admin/Salesman/FinalPerformanceCalculationData";
        $Feature->TableHeader = array("年月标识","姓名","户数","计算说明","最终业绩");
        $Feature->Fields = array("FINAL_PERFORMANCE_ID","sign_of_year_and_month","FULL_NAME","households","calculation_explanation","final_performance");
        $Feature->Operations= array(
                //array('name'=>'编辑','url'=>'/admin/Salesman/edit/id/'),
                //array('name'=>'删除','url'=>'/admin/Salesman/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                //array('name'=>'添加','url'=>'/admin/Salesman/add')
            );
        //$Feature->PageInforUrl = "/admin/Salesman/PageInformation";
        $Feature->QueryPanels = "/admin/Salesman/FinalPerformanceCalculationQueryPanels";
        $Feature->ScriptFragment ='dict/FinalPerformanceCalculation';
        return json($Feature);
    }
    
    public function FinalPerformanceCalculationData(){
        session("QueryCriteria",null);
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $sign_of_year_and_month = date('Y-m');
        if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
            $QueryCriteria = $postdata['QueryCriteria'];
            if(trim($QueryCriteria['sign_of_year_and_month'])!=''){
                $sign_of_year_and_month = trim($QueryCriteria['sign_of_year_and_month']);
            }
        }
        $this->FinalPerformanceCalculationFun($sign_of_year_and_month);
        $FinalPerformances = \app\admin\model\FinalPerformance::with('Salesman')->where('sign_of_year_and_month','=',$sign_of_year_and_month)->select();
        //Log::record('201802221811：'.\app\admin\model\FinalPerformance::getLastSql());
        //$FinalPerformances = \app\admin\model\FinalPerformance::where('sign_of_year_and_month','=',$sign_of_year_and_month)->with('Salesman')->relation(true)->order('FULL_NAME')->select();
        return json($FinalPerformances);
    }
    
    //抽取计算最终业绩的公共部分
    public function FinalPerformanceCalculationFun($sign_of_year_and_month){
        $sign_of_year_and_month_min = $sign_of_year_and_month.'-01';
        $startdate=strtotime($sign_of_year_and_month_min); 
        $sign_of_year_and_month_max = date('Y-m-d',strtotime("+1 months",$startdate));
        $Salesmans = \app\admin\model\Salesman::where('openid','<>','')->select();
        foreach ($Salesmans as $key => $value) {
            if(\app\admin\model\FinalPerformance::where("sign_of_year_and_month",$sign_of_year_and_month)->where("openid",$value['openid'])->count()==0){
                $FinalPerformance = new \app\admin\model\FinalPerformance();
                $FinalPerformance->sign_of_year_and_month = $sign_of_year_and_month;
                $FinalPerformance->openid = $value['openid'];
                $FinalPerformance->save();
            }
            $FinalPerformance = \app\admin\model\FinalPerformance::where("sign_of_year_and_month",$sign_of_year_and_month)->where("openid",$value['openid'])->find();
            //计算户数
            $BroadbandPerformances = new \app\admin\model\BroadbandPerformance();
            $FinalPerformance->households = $BroadbandPerformances->where("openid",$value['openid'])->where("performance_time",">=",$sign_of_year_and_month_min)->where("performance_time","<",$sign_of_year_and_month_max)->count();
            $FinalPerformance->final_performance = $BroadbandPerformances->where("openid",$value['openid'])->where("performance_time",">=",$sign_of_year_and_month_min)->where("performance_time","<",$sign_of_year_and_month_max)->sum('achievement');
            $FinalPerformance->original_performance = $FinalPerformance->final_performance;//保存原始业绩
            $arrv = $this->CalculationbyCoefficient($FinalPerformance->households,$FinalPerformance->final_performance);
            if($value->serve_as_a_post=='渠道1'){
                $FinalPerformance->final_performance = $FinalPerformance->final_performance;
                $FinalPerformance->calculation_explanation = '渠道1，没有系数。';
            }else if($value->serve_as_a_post=='渠道2'){
                $FinalPerformance->final_performance = $FinalPerformance->final_performance;
                $FinalPerformance->calculation_explanation = '渠道2，没有系数。';
            }else{
                $FinalPerformance->final_performance = $arrv[0];
                $FinalPerformance->calculation_explanation = $arrv[1];
            }
            $FinalPerformance->save();
        }
    }
    
    //按照系数计算最终业绩
    //$households：户数
    //$final_performance：原始业绩
    public function CalculationbyCoefficient($households,$final_performance){
        //读入参数
        $FinalPerformanceCoefficients = \app\admin\model\FinalPerformanceCoefficient::where("FINAL_PERFORMANCE_COEFFICIENT_ID","<>","")->order("display_order")->select();
        foreach ($FinalPerformanceCoefficients as $key => $value) {
            $interval_minimum = $value['interval_minimum'];
            $interval_maximum = $value['interval_maximum'];
            $performance_coefficient = $value['performance_coefficient'];
            if($households>=$interval_minimum&&$households<=$interval_maximum){
                $final_performance_ = $final_performance*$performance_coefficient;
                $calculation_explanation = "户数：".$interval_minimum."≤".$households."≤".$interval_maximum."，业绩：".$final_performance."×".$performance_coefficient."=".$final_performance_;
                return array($final_performance_,$calculation_explanation);
            }
        }
    }
    
    public function FinalPerformanceCalculationQueryPanels(){
        $this->assign('sign_of_year_and_month',date('Y-m'));
        return $this->fetch();
    }
    
    //定时计算昨天的业绩
    public function TimedCalculation(){
        $sign_of_year_and_month = date('Y-m-d');
        $startdate=strtotime($sign_of_year_and_month); 
        $sign_of_year_and_month = date('Y-m',strtotime("-1 days",$startdate));
        $this->FinalPerformanceCalculationFun($sign_of_year_and_month);
        return 'ok';
    }
    
    public function test(){
        $sign_of_year_and_month = date('Y-m-d');
        $startdate=strtotime($sign_of_year_and_month); 
        $sign_of_year_and_month = date('Y-m',strtotime("-1 days",$startdate));
        echo $sign_of_year_and_month;
    }
    
    //业绩排名
    public function PerformanceRankings(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "业绩排名";
        $Feature->DataUrl = "/admin/Salesman/PerformanceRankingsData";
        $Feature->TableHeader = array("头像","姓名","职务","手机号码","户数");
        $Feature->Fields = array("SALESMAN_ID","head_portrait","FULL_NAME","serve_as_a_post","PHONE_NUMBER","NumberHouseholds");
        $Feature->Operations= array(
                //array('name'=>'编辑','url'=>'/admin/Salesman/edit/id/'),
                //array('name'=>'删除','url'=>'/admin/Salesman/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                //array('name'=>'添加','url'=>'/admin/Salesman/add')
            );
        //$Feature->PageInforUrl = "/admin/Salesman/PageInformation";
        $Feature->QueryPanels = "/admin/Salesman/PerformanceRankingsQueryPanels";
        $Feature->ScriptFragment ='dict/PerformanceRankings';
        return json($Feature);
    }
    
    public function PerformanceRankingsData(){
        session("QueryCriteria",null);
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $Salesmans = \app\admin\model\Salesman::where('SALESMAN_ID','<>','')->select();
        foreach ($Salesmans as $key => $value) {
            $BroadbandPerformances = \app\admin\model\BroadbandPerformance::where('openid',$value['openid']);
            if(isset($postdata['QueryCriteria'])&&($postdata['QueryCriteria']!=null)){
                $QueryCriteria = $postdata['QueryCriteria'];
                if(trim($QueryCriteria['performance_time_min'])!=''){
                    $BroadbandPerformances = $BroadbandPerformances->where('performance_time','>=',$QueryCriteria['performance_time_min']);
                }
                if(trim($QueryCriteria['performance_time_max'])!=''){
                    $BroadbandPerformances = $BroadbandPerformances->where('performance_time','<=',$QueryCriteria['performance_time_max'].' 23:59:59');
                }
            }
            $value->NumberHouseholds = $BroadbandPerformances->count();
        }
        usort($Salesmans,array('\app\admin\controller\Salesman','DataSorting'));
        return json($Salesmans);
    }
    
    //按户数排序
    protected function DataSorting($a,$b)
    {
        if ($a->NumberHouseholds==$b->NumberHouseholds) return 0;
        return ($a->NumberHouseholds>$b->NumberHouseholds)?-1:1;
    }
    
    public function PerformanceRankingsQueryPanels(){
        return $this->fetch();
    }
    
    protected $NumberRowsPerPage = 50;
    
    //查询改手机号是否存在
    public function IsExistsPh(){
        $postdata = input("post.");
        $PHONE_NUMBER = $postdata['PHONE_NUMBER'];
        if(\app\admin\model\Salesman::where('PHONE_NUMBER',$PHONE_NUMBER)->count()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function get(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $Salesmans = \app\admin\model\Salesman::where('SALESMAN_ID','<>','')->order("registration_time","DESC")->page($PageNumbers,$this->NumberRowsPerPage)->select();
        return json($Salesmans);
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $Salesmans = new \app\admin\model\Salesman();
        $res = new \app\admin\model\Feature();
        $res->total = $Salesmans->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
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
        $Salesman->registration_time = date('Y-m-d H:i:s');
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
