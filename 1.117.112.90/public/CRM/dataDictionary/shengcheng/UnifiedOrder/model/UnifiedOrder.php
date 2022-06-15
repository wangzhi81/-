<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class UnifiedOrder extends Model
    {
        use SoftDelete;
        protected $table = 'unified_order';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->UNIFIED_ORDER_ID;
            }catch(\Exception $e){
                $this->UNIFIED_ORDER_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }