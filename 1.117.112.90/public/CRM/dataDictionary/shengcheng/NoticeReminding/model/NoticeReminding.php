<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class NoticeReminding extends Model
    {
        use SoftDelete;
        protected $table = 'notice_reminding';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->NOTICE_REMINDING_ID;
            }catch(\Exception $e){
                $this->NOTICE_REMINDING_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }