<?php
namespace app\admin\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Model;
use think\Controller;
use think\Request;
use think\Session;
use Endroid\QrCode\QrCode;
use \app\admin\model\MenuList;
use \app\admin\model\UserRightsAllocationTable;

class Index extends Controller
{
    public function index()
    {
        //return json(session('UserInfor'));
        if(session('UserInfor')!=null){
            return $this->fetch();
        }else{
            return redirect("/admin/index/login");
        }
    }
    
    public function RightsManagement(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "菜单管理";
        $Feature->DataUrl = "/admin/index/getMenuList";
        $Feature->TableHeader = array("菜单名称","菜单图标","对应URL","显示顺序");
        $Feature->Fields = array("MENU_LIST_ID","MENU_NAME","MENU_ICON","CORRESPONDING_URL","DISPLAY_ORDER");
        $Feature->Operations= array(
                array('name'=>'修改','url'=>'/admin/index/editRight/MENU_LIST_ID/'),
                array('name'=>'分配角色','url'=>'/admin/index/AssigningRoles/MENU_LIST_ID/'),
                array('name'=>'删除','url'=>'/admin/index/delRight/MENU_LIST_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Index/addRight')
            );
        return json($Feature);
    }
    
    public function WeixinMenu(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "微信菜单管理";
        $Feature->DataUrl = "/admin/index/getWechatMenus";
        $Feature->TableHeader = array("创建时间","修改时间","生效状态");
        $Feature->Fields = array("WECHAT_MENU_ID","creation_time","modification_time","effective_state");
        $Feature->Operations= array(
                array('name'=>'修改','url'=>'/admin/index/editWechatMenus/WECHAT_MENU_ID/'),
                //array('name'=>'分配角色','url'=>'/admin/index/AssigningRoles/MENU_LIST_ID/'),
                //array('name'=>'删除','url'=>'/admin/index/delRight/MENU_LIST_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/index/addWechatMenus')
            );
        return json($Feature);
    }
    
    public function DictionaryTable(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "字典表管理";
        $Feature->DataUrl = "/admin/index/getDictionaryTables";
        $Feature->TableHeader = array("字典表名称","说明");
        $Feature->Fields = array("DICTIONARY_TABLE_ID","dictionary_table_name","dictionary_table_specification");
        $Feature->Operations= array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Jumps=array(
                array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                //array('name'=>'添加','url'=>'/admin/index/addWechatMenus')
            );
        return json($Feature);
    }
    
    public function editDictionaryTable($DICTIONARY_TABLE_ID){
        $DictionaryTables = \app\admin\model\DictionaryTable::get($DICTIONARY_TABLE_ID);
        return $this->redirect($DictionaryTables['corresponding_url']);;
    }
    
    public function BroadbandPackageClassification(){
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带套餐分类";
        $Feature->DataUrl = "/admin/index/getBroadbandPackageClassification";
        $Feature->TableHeader = array("套餐分类名称","显示顺序");
        $Feature->Fields = array("BROADBAND_PACKAGE_CLASSIFICATION_ID","classification_name","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/index/editBroadbandPackageClassification/BROADBAND_PACKAGE_CLASSIFICATION_ID/'),
                array('name'=>'删除','url'=>'/admin/index/delBroadbandPackageClassification/BROADBAND_PACKAGE_CLASSIFICATION_ID/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/index/addBroadbandPackageClassification')
            );
        return json($Feature);
    }
    
    public function killBroadbandPackageClassification(){
        $postdata = input('post.');
        $BROADBAND_PACKAGE_CLASSIFICATION_ID = $postdata['BROADBAND_PACKAGE_CLASSIFICATION_ID'];
        $BroadbandPackageClassification = \app\admin\model\BroadbandPackageClassification::get($BROADBAND_PACKAGE_CLASSIFICATION_ID);
        $BroadbandPackageClassification->delete();
        return 'ok';
    }
    
    public function delBroadbandPackageClassification($BROADBAND_PACKAGE_CLASSIFICATION_ID){
        $SecondTitle = '>删除套餐分类';
        $BroadbandPackageClassification = \app\admin\model\BroadbandPackageClassification::get($BROADBAND_PACKAGE_CLASSIFICATION_ID);
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/addbroadbandpackageclassification');
        $this->assign('BroadbandPackageClassification',$BroadbandPackageClassification);
        return $this->fetch();
    }
    
    public function saveBroadbandPackageClassification(){
        $postdata = input('post.');
        $BroadbandPackageClassification = new \app\admin\model\BroadbandPackageClassification($postdata['BroadbandPackageClassification']);
        $BroadbandPackageClassification->save();
        return 'ok';
    }
    
    public function editBroadbandPackageClassification($BROADBAND_PACKAGE_CLASSIFICATION_ID){
        $SecondTitle = '>修改套餐分类';
        $BroadbandPackageClassification = \app\admin\model\BroadbandPackageClassification::get($BROADBAND_PACKAGE_CLASSIFICATION_ID);
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/addbroadbandpackageclassification');
        $this->assign('BroadbandPackageClassification',$BroadbandPackageClassification);
        return $this->fetch();
    }
    
    public function updateBroadbandPackageClassification(){
        $postdata = input('post.');
        $data = $postdata['BroadbandPackageClassification'];
        $BroadbandPackageClassification = \app\admin\model\BroadbandPackageClassification::get($data['BROADBAND_PACKAGE_CLASSIFICATION_ID']);
        $BroadbandPackageClassification->data($data);
        $BroadbandPackageClassification->save();
        return 'ok';
    }
    
    public function addBroadbandPackageClassification(){
        $SecondTitle = '>添加套餐分类';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/addbroadbandpackageclassification');
        return $this->fetch();
    }
    
    //宽带套餐分类
    public function getBroadbandPackageClassification(){
        $BroadbandPackageClassification = \app\admin\model\BroadbandPackageClassification::where('BROADBAND_PACKAGE_CLASSIFICATION_ID','<>','')->order("display_order")->select();
        return json($BroadbandPackageClassification);
    }
    
    public function getDictionaryTables(){
        $DictionaryTables = \app\admin\model\DictionaryTable::where('DICTIONARY_TABLE_ID','<>','')->order("display_order")->select();
        return json($DictionaryTables);
    }
    
    public function addWechatMenus(){
        $WechatMenu = new \app\admin\model\WechatMenu;
        $SecondTitle = '>添加菜单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','addwechatmenus');
        $this->assign('WechatMenu',$WechatMenu);
        return $this->fetch();
    }
    
    public function editWechatMenus($WECHAT_MENU_ID){
        $WechatMenu = \app\admin\model\WechatMenu::get($WECHAT_MENU_ID);
        $SecondTitle = '>修改菜单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('WechatMenu', $WechatMenu);
        $this->assign('ScriptFragment','addwechatmenus');
        return $this->fetch('addwechatmenus');
    }
    
    public function getWechatMenu(){
        $postdata = input('post.');
        $WECHAT_MENU_ID = $postdata['WECHAT_MENU_ID'];
        $wechat_menu = \app\admin\model\WechatMenu::get($WECHAT_MENU_ID);
        return json($wechat_menu);
    }
    
    public function saveWechatMenus(){
        $postdata = input('post.');
        $WxMenuJson = $postdata['WxMenu'];
        $WechatMenu = new \app\admin\model\WechatMenu;
        $WechatMenu->menu_content = json_encode($WxMenuJson);
        $WechatMenu->modification_time = date('Y-m-d H:i:s');
        $menu = & load_wechat('menu');
        $result = $menu->createMenu($WechatMenu->menu_content);
        if($result===FALSE){
            
        }else{
            $WechatMenu->effective_state = '已生效';
        }
        $WechatMenu->save();
        //return json_encode($WechatMenu->menu_content);
        return 'ok';
    }
    
    public function getWechatMenus(){
        $WechatMenus = \app\admin\model\WechatMenu::where('WECHAT_MENU_ID','<>','')->order('modification_time','desc')->select();
        return json($WechatMenus);
    }
    
    public function AssigningRoles($MENU_LIST_ID){
        $MenuList = MenuList::get($MENU_LIST_ID);
        $SecondTitle = '>分配角色';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','assigningroles');
        $this->assign('MenuList',$MenuList);
        return $this->fetch();
    }
    
    //保存分配角色
    public function AssignRolesSave(){
        $postdata = input("post.");
        $MENU_LIST_ID = $postdata['MENU_LIST_ID'];
        UserRightsAllocationTable::destroy(['menu_id'=>$MENU_LIST_ID]);
        if(!isset($postdata['roles'])){
            return 'ok';
        }
        $roles = $postdata['roles'];
        foreach ($roles as $key => $value) {
            $urat = new UserRightsAllocationTable();
            $urat->role = $value;
            $urat->menu_id = $MENU_LIST_ID;
            $urat->save();
        }
        return 'ok';
    }
    
    //获取菜单角色
    public function GetsMenuRole(){
        $menu_id = input("post.")['menu_id'];
        $urats = UserRightsAllocationTable::where('menu_id','=',$menu_id)->select();
        return json($urats);
    }
    
    public function delRight($MENU_LIST_ID){
        $SecondTitle = '>删除菜单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','delright');
        $this->assign('MENU_LIST_ID',$MENU_LIST_ID);
        return $this->fetch();
    }
    
    public function addRight(){
        $SecondTitle = '>添加菜单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','addright');
        return $this->fetch();
    }
    
    public function editRight($MENU_LIST_ID){
        $SecondTitle = '>修改菜单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','editright');
        $this->assign('MENU_LIST_ID',$MENU_LIST_ID);
        return $this->fetch();
    }
    
    public function saveRight(){
        $postData = input('post.');
        return json_encode($postData);
    }
    
    public function Login(){
        $qrCode=new QrCode();
        $commController = controller('comm/Index');
        $LOGIN_VERIFICATION_NOTE_ID = $commController->BuildNotes();
        $url = input('server.REQUEST_SCHEME')."://".input('server.HTTP_HOST').'/index/index/login?LOGIN_VERIFICATION_NOTE_ID='.$LOGIN_VERIFICATION_NOTE_ID;
        $qrCode->setText($url)
            ->setSize(300)
            ->setMargin(20)
            ->setErrorCorrectionLevel('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16);
        $this->assign('qrCode',$qrCode->writeDataUri());
        $this->assign('LOGIN_VERIFICATION_NOTE_ID',$LOGIN_VERIFICATION_NOTE_ID);
        return $this->fetch();
    }
    
    public function getMenuList(){
        $MenuLists = \app\admin\model\MenuList::where('MENU_LIST_ID','<>','')->order("DISPLAY_ORDER")->select();
        return json($MenuLists);
    }
    
    public function getMenuList_(){
        $UserInfor = session('UserInfor');
        //$Salesman = session('Salesman');
        //return json($UserInfor);
        $Salesman = \app\admin\model\Salesman::where('openid',$UserInfor['OPENID'])->find();
        $Urats = \app\admin\model\UserRightsAllocationTable::where('ROLE','超级管理员')->select();
        //Log::record("getMenuList_:Urats~".json_encode($Urats));
        $menu_ids = array();
        foreach ($Urats as $key => $value) {
            array_push($menu_ids,$value->menu_id);
        }
        $MenuLists = array();
        if(count($menu_ids)>0){
            $MenuLists = \app\admin\model\MenuList::all($menu_ids);
        }
        //return json($Urats);
        usort($MenuLists,array('\app\admin\controller\Index','DataSorting'));
        $MenuLists_ = \app\admin\model\MenuList::where('designated_personnel','=',$UserInfor['OPENID'])->order("DISPLAY_ORDER")->select();
        return json(array_merge($MenuLists, $MenuLists_));
    }
    
    protected function DataSorting($a,$b)
    {
        if ($a->DISPLAY_ORDER==$b->DISPLAY_ORDER) return 0;
        return ($a->DISPLAY_ORDER<$b->DISPLAY_ORDER)?-1:1;
    }
    
        public function test(){
            $myfile = fopen("/www/wwwroot/thinkphp/public/zy.csv", "r") or die("Unable to open file!");
            // 输出单行直到 end-of-file
            while(!feof($myfile)) {
              $str =  fgets($myfile);
              $ex = explode(',',$str);
              $region = $this->getval($ex,0);
              $street = $this->getval($ex,1); 
              $lane_village = $this->getval($ex,2); 
              $residential_quarters = $this->getval($ex,3); 
              $street_name = $this->getval($ex,4); 
              //echo getval($ex,3); 
              foreach ($ex as $key => $value) {
                  if($key>4){
                      $building_number = mb_convert_encoding($value, "UTF-8", "GBK"); 
                      if($building_number!=''){
                          echo $building_number;
                          Db::execute('insert into broadband_installation_resources (BROADBAND_INSTALLATION_RESOURCES_ID, region,street,lane_village,residential_quarters,street_name,building_number,display_order,last_time) values (uuid(), ?,?,?,?,?,?,?,now())',[$region,$street,$lane_village,$residential_quarters,$street_name,$building_number,$key]);
                          //return;
                      }
                  }
              }
            }
            fclose($myfile);
        }
        
    public function test1(){
        $myfile = fopen("/www/wwwroot/thinkphp/public/zy.csv", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $str =  mb_convert_encoding(fgets($myfile), "UTF-8", "GBK"); 
            Db::execute('insert into test (TEST_ID, test_field) values (uuid(), ?)',[$str]);
        }
    }
    
    public function test3(){
        $UserInfor = session('UserInfor');
        return json_encode($UserInfor);
    }
    
    public function test2(){
        $t = Db::table('test')->where('f',1)->find();
        $id = $t['TEST_ID'];
        $ex = explode(',',$t['test_field']);
        $region = $ex[0];
          $street = $ex[1];
          $lane_village = $ex[2];
          $residential_quarters = $ex[3];
          $street_name = $ex[4];
          //echo getval($ex,3); 
          foreach ($ex as $key => $value) {
              if($key>4){
                  $building_number = $value; 
                  if($building_number!=''){
                      //echo $building_number;
                      Db::execute('insert into broadband_installation_resources (BROADBAND_INSTALLATION_RESOURCES_ID, region,street,lane_village,residential_quarters,street_name,building_number,display_order,last_time) values (uuid(), ?,?,?,?,?,?,?,now())',[$region,$street,$lane_village,$residential_quarters,$street_name,$street_name.$building_number,$key]);
                      //return;
                  }
              }
          }
          Db::table('test')->where('TEST_ID', $id)->update(['f' => '2']);
        return Db::table('test')->where('f', 1)->count()."\n";
    }
        
    function getval($ex,$i){
        return mb_convert_encoding($ex[$i], "UTF-8", "GBK"); 
    }
}
