<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class WechatMenu extends Model
    {
        use SoftDelete;
        protected $table = 'wechat_menu';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->WECHAT_MENU_ID;
            }catch(\Exception $e){
                $this->WECHAT_MENU_ID = $this->getUuid();
                $this->creation_time = date('Y-m-d H:i:s');
                $this->modification_time = date('Y-m-d H:i:s');
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
        
        public function getMenuContentAttr($value)
        {
            return json_decode($value);
        }
    }