<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class FinalPerformance extends Model
    {
        use SoftDelete;
        protected $table = 'final_performance';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->FINAL_PERFORMANCE_ID;
            }catch(\Exception $e){
                $this->FINAL_PERFORMANCE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }