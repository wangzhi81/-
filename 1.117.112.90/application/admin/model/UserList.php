<?php
    namespace app\admin\model;
    
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
        
        static public function getGenderAttr($value)
        {
            $status = [1=>'男',2=>'女',0=>'未知'];
            return $status[$value];
        }
        
        static public function getNicknameAttr($value)
        {
            return json_decode($value);
        }
        
        static public function getHeadPortraitAttr($value){
            return '<img src="'.$value.'" class="HeadPortrait">';
        }
        
        public function getUrat(){
            return $this->hasMany('UserRightsAllocationTable','role','role');
        }
    }