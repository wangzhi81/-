<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;

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
        $Feature->TableHeader = array("区域","街道","路巷村","小区","街路名","楼编号","接入方式");
        $Feature->Fields = array("BROADBAND_INSTALLATION_RESOURCES_ID","region","street","lane_village","residential_quarters","street_name","building_number","access_mode");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Broadbandinstallationresources/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Broadbandinstallationresources/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Broadbandinstallationresources/add'),
                array('name'=>'导出','url'=>'javascript:;','class'=>'export'),
                array('name'=>'导入','url'=>'javascript:;','class'=>'Import'),
                array('name'=>'全部删除','url'=>'javascript:;','class'=>'delall')
            );
        $Feature->PageInforUrl = "/admin/Broadbandinstallationresources/PageInformation";
        $Feature->ScriptFragment ='dict/Broadbandinstallationresources';
        return json($Feature);
    }
    
    public function getTaskNotCompleted(){
        $resource_upload_tasks = Db::table("resource_upload_task")->where('state_of_execution','未执行')->select();
        return json($resource_upload_tasks);
    }
    
    public function delall(){
        Db::table("broadband_installation_resources")->where('delete_time',null)->update(['delete_time'=>time()]);
        return 'ok';
    }
    
    protected $NumberRowsPerPage = 50;
    
    public function get(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandInstallationResourcess = \app\admin\model\BroadbandInstallationResources::where('BROADBAND_INSTALLATION_RESOURCES_ID','<>','')->order("region,street,lane_village,residential_quarters,street_name,building_number")->page($PageNumbers,$this->NumberRowsPerPage)->select();
        return json($BroadbandInstallationResourcess);
    }
    
    public function Export(){
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment;filename=地址资源.csv ");
        $csvstr = "区域,街道,路巷村,小区,街路名,楼编号\n";
        $dirs = Db::table('broadband_installation_resources')->where('delete_time',null)->order("region,street,lane_village,residential_quarters,street_name,building_number")->select();
        foreach ($dirs as $key => $value) {
            $csvstr.=(trim($value['region']).',');
            $csvstr.=(trim($value['street']).',');
            $csvstr.=(trim($value['lane_village']).',');
            $csvstr.=(trim($value['residential_quarters']).',');
            $csvstr.=(trim($value['street_name']).',');
            $csvstr.=(trim($value['building_number'])."\n");
        }
        $csvstr = chr(0xEF).chr(0xBB).chr(0xBF).$csvstr;
        
        return $csvstr;
    }
    
    public function test(){
        vendor('PHPExcel.PHPExcel.Reader.Excel5');
        $PHPReader = new \PHPExcel_Reader_Excel5();
        return 'ok';
    }
    
    public function getTsxx($id){
        $resource_upload_task = Db::table("resource_upload_task")->where("RESOURCE_UPLOAD_TASK_ID",$id)->find();
        return $resource_upload_task;
    }
    
    public function Import(){
        $resobj = new \stdClass();
        if ((strpos($_FILES["file"]["type"],"excel")!=0)&&($_FILES["file"]["size"] < 40000000)){
            if ($_FILES["file"]["error"] > 0){
                return "error";
            }
            $dateYmd = date("Ymd");
            $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
            if(!file_exists($DateFolder)){
                mkdir($DateFolder);
            }
            $serverId = md5($_FILES["file"]["tmp_name"].date('His'));
            move_uploaded_file($_FILES["file"]["tmp_name"],$DateFolder.$serverId);
            $uuid = Db::query("select uuid() as uuid_");
            Db::execute("insert into resource_upload_task(RESOURCE_UPLOAD_TASK_ID,upload_file_path,process_information,state_of_execution,setting_up_time) values('".$uuid[0]['uuid_']."',?,?,?,now())",[$DateFolder.$serverId,'准备执行...','未执行']);
            //return saveUploadFileW($_FILES["file"]["tmp_name"]);
            //return strpos($_FILES["file"]["type"],"excel");
            /*vendor('PHPExcel.PHPExcel.Reader.Excel5');
            $PHPReader = new \PHPExcel_Reader_Excel5();
            //return $_FILES["file"]["tmp_name"];
            $objPHPExcel = $PHPReader->load($_FILES["file"]["tmp_name"]);
            $sheet = $objPHPExcel->getSheet(0);
            $allRow = $sheet->getHighestRow();
            //return $allRow;
            for ($j=2; $j <= $allRow; $j++) {
                $region = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();
                $street = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();
                $lane_village = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();
                $residential_quarters = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();
                $street_name = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();
                $building_number = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();
                $access_mode = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();
                Db::table('broadband_installation_resources')->where('delete_time',null)->where('region',$region)->where('street',$street)->where('lane_village',$lane_village)->where('residential_quarters',$residential_quarters)->where('street_name',$street_name)->where('building_number',$building_number)->delete();
                $BroadbandInstallationResources = new \app\admin\model\BroadbandInstallationResources();
                $BroadbandInstallationResources->region = $region;
                $BroadbandInstallationResources->street = $street;
                $BroadbandInstallationResources->lane_village = $lane_village;
                $BroadbandInstallationResources->residential_quarters = $residential_quarters;
                $BroadbandInstallationResources->street_name = $street_name;
                $BroadbandInstallationResources->building_number = $building_number;
                $BroadbandInstallationResources->display_order = 0;
                $BroadbandInstallationResources->last_time = date('Y-m-d H:i:s');
                $BroadbandInstallationResources->access_mode = $access_mode;
                $BroadbandInstallationResources->save();
            }*/
            $resobj->msg='ok';
            $resobj->uuid=$uuid[0]['uuid_'];
            return json($resobj);
        }else{
            return $_FILES["file"]["size"];
        }
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $BroadbandInstallationResources = new \app\admin\model\BroadbandInstallationResources();
        $res = new \app\admin\model\Feature();
        $res->total = $BroadbandInstallationResources->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
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
        $BroadbandInstallationResources->last_time = date('Y-m-d H:i:s');
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
        $BroadbandInstallationResources->last_time = date('Y-m-d H:i:s');
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
