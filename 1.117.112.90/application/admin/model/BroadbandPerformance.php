<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BroadbandPerformance extends Model
    {
        use SoftDelete;
        protected $table = 'broadband_performance';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BROADBAND_PERFORMANCE_ID;
            }catch(\Exception $e){
                $this->BROADBAND_PERFORMANCE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
        
        public function userList(){
            return $this->belongsTo('UserList','openid','OPENID')->bind(['full_name']);
        }
        
        public function BroadbandOrders(){
            return $this->belongsTo('BroadbandOrders','order_id')->bind(['master_name','phone_number']);
        }
        
        public function Salesman(){
            return $this->belongsTo('Salesman','openid','openid')->bind(['affiliated_business_hall']);
        }
    }