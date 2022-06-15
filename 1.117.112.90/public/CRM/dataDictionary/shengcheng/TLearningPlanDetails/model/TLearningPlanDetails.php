<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class TLearningPlanDetails extends Model
    {
        use SoftDelete;
        protected $table = 't_learning_plan_details';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->T_LEARNING_PLAN_DETAILS_ID;
            }catch(\Exception $e){
                $this->T_LEARNING_PLAN_DETAILS_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }