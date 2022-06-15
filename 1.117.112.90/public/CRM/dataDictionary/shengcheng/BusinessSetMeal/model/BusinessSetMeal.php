<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class BusinessSetMeal extends Model
    {
        use SoftDelete;
        protected $table = 'business_set_meal';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->BUSINESS_SET_MEAL_ID;
            }catch(\Exception $e){
                $this->BUSINESS_SET_MEAL_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }