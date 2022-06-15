<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BusinessHall extends Model
    {
        use SoftDelete;
        protected $table = 'business_hall';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BUSINESS_HALL_ID;
            }catch(\Exception $e){
                $this->BUSINESS_HALL_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }