<?php
    namespace app\comm\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class MenuList extends Model
    {
        use SoftDelete;
        protected $table = 'menu_list';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->MENU_LIST_ID;
            }catch(\Exception $e){
                $this->MENU_LIST_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }