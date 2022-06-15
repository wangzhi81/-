<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class HousekeepingService extends Model
    {
        use SoftDelete;
        protected $table = 'housekeeping_service';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->HOUSEKEEPING_SERVICE_ID;
            }catch(\Exception $e){
                $this->HOUSEKEEPING_SERVICE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }