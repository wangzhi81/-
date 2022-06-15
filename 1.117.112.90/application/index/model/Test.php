<?php
    namespace app\index\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class TEST extends Model
    {
        use SoftDelete;
        protected $table = 'test';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->TEST_ID;
            }catch(\Exception $e){
                $this->TEST_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }