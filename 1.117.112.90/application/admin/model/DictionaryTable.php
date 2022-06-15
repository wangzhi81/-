<?php
    namespace app\admin\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class DictionaryTable extends Model
    {
        use SoftDelete;
        protected $table = 'dictionary_table';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->DICTIONARY_TABLE_ID;
            }catch(\Exception $e){
                $this->DICTIONARY_TABLE_ID = $this->getUuid();
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
    }