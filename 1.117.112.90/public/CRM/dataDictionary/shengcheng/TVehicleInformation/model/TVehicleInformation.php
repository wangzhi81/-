<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class TVehicleInformation extends Model
    {
        use SoftDelete;
        protected $table = 't_vehicle_information';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->T_VEHICLE_INFORMATION_ID;
            }catch(\Exception $e){
                $this->T_VEHICLE_INFORMATION_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }