<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class OperationParameters extends Model
    {
        use SoftDelete;
        protected $table = 'operation_parameters';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->OPERATION_PARAMETERS_ID;
            }catch(\Exception $e){
                $this->OPERATION_PARAMETERS_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }