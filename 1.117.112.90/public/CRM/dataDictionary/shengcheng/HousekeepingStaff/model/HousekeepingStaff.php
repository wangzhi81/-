<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class HousekeepingStaff extends Model
    {
        use SoftDelete;
        protected $table = 'housekeeping_staff';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->HOUSEKEEPING_STAFF_ID;
            }catch(\Exception $e){
                $this->HOUSEKEEPING_STAFF_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }