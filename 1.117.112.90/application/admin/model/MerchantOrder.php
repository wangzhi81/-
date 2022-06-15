<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class MerchantOrder extends Model
    {
        use SoftDelete;
        protected $table = 'merchant_order';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->MERCHANT_ORDER_ID;
            }catch(\Exception $e){
                $this->MERCHANT_ORDER_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }