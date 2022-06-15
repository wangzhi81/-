<?php
    namespace app\index\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BroadbandOrders extends Model
    {
        use SoftDelete;
        protected $table = 'broadband_orders';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BROADBAND_ORDERS_ID;
            }catch(\Exception $e){
                $this->BROADBAND_ORDERS_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }