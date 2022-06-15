<?php
    namespace app\comm\controller;
    
    use think\Db;
    use think\Url;
    use think\Log;
    use think\Session;
    use think\Controller;
    use think\Request;
    
    class Index extends Controller
    {
        public function index()
        {
            return 'comm';
        }
        
        public function getMenuList()
        {
            //$UserInfor = session('UserInfor');
            $MenuLists = \app\comm\model\MenuList::where('designated_personnel','=','')->order('DISPLAY_ORDER')->select();
            return json($MenuLists);
        }
        
        public function getMenuListById($id)
        {
            $MenuList = \app\comm\model\MenuList::get($id);
            return json($MenuList);
        }
        
        public function delMenuList(){
            $postData = input('post.');
            $id = $postData['id'];
            $MenuList = \app\comm\model\MenuList::get($id);
            $MenuList->delete();
            return "ok";
        }
        
        public function saveMenuList(){
            $postData = input('post.');
            $MenuList = new \app\comm\model\MenuList($postData['menu_list']);
            $MenuList->save();
            return json($MenuList);
        }
        
        public function updateMenuList(){
            $postData = input('post.');
            $MenuList = \app\comm\model\MenuList::get($postData['menu_list']['MENU_LIST_ID']);
            $MenuList->data($postData['menu_list']);
            $MenuList->save();
            return json($MenuList);
        }
        
        public function BuildNotes(){
            $loginVerificationNote = new \app\comm\model\LoginVerificationNote();
            $loginVerificationNote->save();
            return $loginVerificationNote->LOGIN_VERIFICATION_NOTE_ID;
        }
        
        //使用票据
        public function UseNotes(){
            $postData = input('post.');
            $LOGIN_VERIFICATION_NOTE_ID = $postData['LOGIN_VERIFICATION_NOTE_ID'];
            //Log::record('201802171348：'.json_encode($LOGIN_VERIFICATION_NOTE_ID));
            $USER_WECHAT_ID = getOpenid();
            //Log::record('201802171348：'.json_encode($USER_WECHAT_ID));
            $this->updateUser($USER_WECHAT_ID);
            \app\comm\model\UserList::LoginSuccess($USER_WECHAT_ID);
            return \app\comm\model\LoginVerificationNote::UseNotes($LOGIN_VERIFICATION_NOTE_ID,$USER_WECHAT_ID);
        }
        
        //获取票据信息
        public function getTicket(){
            $id = input('LOGIN_VERIFICATION_NOTE_ID');
            //$id = $postData['LOGIN_VERIFICATION_NOTE_ID'];
            for($i=0;$i<30;$i++){
                $LoginVerificationNote = \app\comm\model\LoginVerificationNote::get($id);
                if($LoginVerificationNote->USER_WECHAT_ID!=""){
                    $UserInfor = \app\comm\model\UserList::get(['OPENID' => $LoginVerificationNote->USER_WECHAT_ID]);
                    //Log::record('20200411：'.json_encode($LoginVerificationNote));
                    session('UserInfor',$UserInfor);
                    $Salesman = \app\comm\model\Salesman::get(['openid' => $LoginVerificationNote->USER_WECHAT_ID]);
                    //Log::record('20180701UserInfor：'.json_encode($UserInfor));
                    //Log::record('20200411：'.json_encode($Salesman));
                    session('Salesman',$Salesman);
                    session('OPENID',$LoginVerificationNote->USER_WECHAT_ID);
                    return json($LoginVerificationNote);
                }
                sleep(1);
            }
            $LoginVerificationNote = (object)array();
            $LoginVerificationNote->USER_WECHAT_ID="";
            return $LoginVerificationNote;
        }
        
        public function test(){
            return json(session('Salesman'));
        }
        
        //获取登录信息
        public function getUserInfor(){
            $UserInfor = session('UserInfor');
            return json($UserInfor);
        }
        
        //登出系统
        public function Logout(){
            Session::clear();
            return;
        }
        
        public function getUserList(){
            $user = & load_wechat('User');
            $result = $user->getUserList();
            if($result===FALSE){
                return;
            }else{
                foreach ($result['data']['openid'] as $key => $value) {
                    $this->updateUser($value);
                }
            	return json($result['data']['openid']);
            }
        }
        
        //强制更新用户微信资料--未完成
        public function ForcedUpdate(){
            $openid = 'olz_I0m1-Mu5jz_PTpap2-3quh-g';
            $wxuser = & load_wechat('User');
            $result = $wxuser->getUserInfo($openid);
            $user = \app\comm\model\UserList::get(['OPENID' => $openid]);
            $user->OPENID = $openid;
            $user->NICKNAME = json_encode($result['nickname']);
            $user->GENDER = $result['sex'];
            $user->PROVINCE = $result['province'];
            $user->CITY = $result['city'];
            $user->HEAD_PORTRAIT = $result['headimgurl'];
            //$file = new \think\File($result['headimgurl']);
            //copy($result['headimgurl'],ROOT_PATH . 'public' . DS . 'uploads/headimgurl/'.$openid.'.png');
            //$image = \think\Image::open(ROOT_PATH . 'public' . DS . 'uploads/headimgurl/'.$openid.'.png');
            //$image->thumb(150, 150)->save(ROOT_PATH . 'public' . DS . 'uploads/headimgurl/'.$openid.'.png');
            $user->ATTENTION_TIME = date('Y-m-d H:i:s', $result['subscribe_time']);
            //$user->save();
            return json($result);
        }
        
        //补充更新用户名列表
        public function updateUser($openid){
            //$openid = 'olz_I0qapApA3Y-qzpHMKqO9sVhE';
            $wxuser = & load_wechat('User');
            $user = \app\comm\model\UserList::get(['OPENID' => $openid]);
            if($user==null){
                $user = new \app\comm\model\UserList;
                
                //$oauth = & load_wechat('Oauth');
                //$result = $oauth->getOauthAccessToken();
                
                //return json($result);
                $result = $wxuser->getUserInfo($openid);
                if($result===FALSE){
                    return;
                }else{
                    if($result['subscribe']==0){
                        $result = Session::get('OauthUserinfo');
                        $result['subscribe_time'] = null;
                    }
                    $user->OPENID = $openid;
                    //Log::record(json_encode($result),'201802171435');
                    $user->NICKNAME = json_encode($result['nickname']);
                    $user->GENDER = $result['sex'];
                    $user->PROVINCE = $result['province'];
                    $user->CITY = $result['city'];
                    $user->HEAD_PORTRAIT = $result['headimgurl'];
                    $user->ATTENTION_TIME = date('Y-m-d H:i:s', $result['subscribe_time']);
                    $user->save();
                    return;
                }
            }
            return;
        }
        
        public function PostData(){
            $postData = input("post.img");
            //return json_encode($postData);
            //return json_encode('123');
            $HttpPath = saveUploadFile($postData,"RemoteDesktop");
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>'Cradle']);
            $OperationParameters->parameter_values = '0';
            $OperationParameters->save();
            $this->setOperVal("Heart","0");
            $this->setOperVal("RemoteDesktop",$HttpPath);
            return $HttpPath;
        }
        
        public function CradleInstruction(){
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>'Cradle']);
            $OperationParameters->parameter_values = '1';
            $OperationParameters->save();
            return json_encode($OperationParameters);
        }
        
        public function getCradle(){
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>'Cradle']);
            return $OperationParameters->parameter_values;
        }
        
        public function getOperVal($key){
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>$key]);
            return $OperationParameters->parameter_values;
        }
        
        public function setOperObj($key,$val){
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>$key]);
            $OperationParameters->parameter_values = json_encode($val);
            $OperationParameters->save();
            return $OperationParameters;
        }
        
        public function setOperVal($key,$val){
            $OperationParameters = \app\comm\model\OperationParameters::get(['parameter_name'=>$key]);
            $OperationParameters->parameter_values = $val;
            $OperationParameters->save();
            return $OperationParameters;
        }
        
        public function remotecontrol(){
            $RemoteDesktop = $this->getOperVal("RemoteDesktop");
            $this->assign('RemoteDesktop', $RemoteDesktop);
            return $this->fetch();
        }
        
        public function getRemoteDesktop(){
            $this->setOperVal("Heart","1");
            $RemoteDesktop = $this->getOperVal("RemoteDesktop");
            return $RemoteDesktop;
        }
        
        public function getHeart(){
            $Heart = $this->getOperVal("Heart");
            return $Heart;
        }
        
        public function MousePosition(){
            $postData = input("post.");
            $e = $postData['mp'];
            $this->setOperObj("MousePosition",$e);
            $this->setOperVal("Cradle","1");
            return 'ok';
        }
        
        public function getMousePosition(){
            $MousePosition = $this->getOperVal("MousePosition");
            return $MousePosition;
        }
    }
