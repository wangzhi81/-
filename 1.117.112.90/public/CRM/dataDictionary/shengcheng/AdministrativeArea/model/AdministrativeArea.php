<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class AdministrativeArea extends Model
    {
        use SoftDelete;
        protected $table = 'administrative_area';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->ADMINISTRATIVE_AREA_ID;
            }catch(\Exception $e){
                $this->ADMINISTRATIVE_AREA_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }