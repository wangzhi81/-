<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class Salesman extends Model
    {
        use SoftDelete;
        protected $table = 'salesman';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->SALESMAN_ID;
            }catch(\Exception $e){
                $this->SALESMAN_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
        
        static public function getHeadPortraitAttr($value){
            return '<img src="'.$value.'" class="HeadPortrait">';
        }
        
        public function serve_as_a_post(){
            return "";
        }
    }