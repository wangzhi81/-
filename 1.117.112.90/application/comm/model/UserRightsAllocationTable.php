<?php
    namespace app\comm\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class UserRightsAllocationTable extends Model
    {
        use SoftDelete;
        protected $table = 'user_rights_allocation_table';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->USER_RIGHTS_ALLOCATION_TABLE_ID;
            }catch(\Exception $e){
                $this->USER_RIGHTS_ALLOCATION_TABLE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }