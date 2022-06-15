<?php
    namespace app\index\model;
    
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
    }