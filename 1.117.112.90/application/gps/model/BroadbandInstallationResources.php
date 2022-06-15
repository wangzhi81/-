<?php
    namespace app\index\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BroadbandInstallationResources extends Model
    {
        use SoftDelete;
        protected $table = 'broadband_installation_resources';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BROADBAND_INSTALLATION_RESOURCES_ID;
            }catch(\Exception $e){
                $this->BROADBAND_INSTALLATION_RESOURCES_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }