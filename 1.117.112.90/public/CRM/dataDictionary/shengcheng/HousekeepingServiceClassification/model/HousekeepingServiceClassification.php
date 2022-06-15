<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class HousekeepingServiceClassification extends Model
    {
        use SoftDelete;
        protected $table = 'housekeeping_service_classification';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->HOUSEKEEPING_SERVICE_CLASSIFICATION_ID;
            }catch(\Exception $e){
                $this->HOUSEKEEPING_SERVICE_CLASSIFICATION_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }