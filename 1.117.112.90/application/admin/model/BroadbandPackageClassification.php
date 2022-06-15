<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BroadbandPackageClassification extends Model
    {
        use SoftDelete;
        protected $table = 'broadband_package_classification';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BROADBAND_PACKAGE_CLASSIFICATION_ID;
            }catch(\Exception $e){
                $this->BROADBAND_PACKAGE_CLASSIFICATION_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }