<?php
    namespace app\index\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BroadbandPackage extends Model
    {
        use SoftDelete;
        protected $table = 'broadband_package';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BROADBAND_PACKAGE_ID;
            }catch(\Exception $e){
                $this->BROADBAND_PACKAGE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }