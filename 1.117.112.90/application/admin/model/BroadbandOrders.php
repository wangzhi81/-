<?php
    namespace app\admin\model;
    
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
        
        public function getFrontOfIdCardAttr($value){
            return '<img src="'.$value.'" class="IdCard">';
        }
        
        public function getReverseOfIdCardAttr($value){
            return '<img src="'.$value.'" class="IdCard">';
        }
        
        public function userList(){
            return $this->belongsTo('UserList','author_openid','OPENID')->bind(['full_name']);
        }
        
        public function salesman(){
            return $this->belongsTo('Salesman','author_openid','openid');
        }
        
        public function serve_as_a_post(){
            return "";
        }
    }