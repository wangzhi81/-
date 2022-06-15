<?php
    namespace app\index\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class ParameterSetting extends Model
    {
        use SoftDelete;
        protected $table = 'parameter_setting';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->PARAMETER_SETTING_ID;
            }catch(\Exception $e){
                $this->PARAMETER_SETTING_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }