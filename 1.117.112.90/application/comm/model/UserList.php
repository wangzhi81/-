<?php
    namespace app\comm\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class UserList extends Model
    {
        use SoftDelete;
        protected $table = 'user_list';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->USER_LIST_ID;
            }catch(\Exception $e){
                $this->USER_LIST_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
        
        //登录成功
        static public function LoginSuccess($openid){
            Db::execute("update user_list set LAST_LOGON_TIME=now() where OPENID=?",[$openid]);
        }
        
        public function getUrat(){
            return $this->hasMany('UserRightsAllocationTable','role','ROLE');
        }
    }