<?php
    namespace app\comm\model;
    
    use think\Db;
    use think\Model;
    use traits\model\SoftDelete;
    
    class LoginVerificationNote extends Model
    {
        use SoftDelete;
        protected $table = 'login_verification_note';
        protected $deleteTime = 'delete_time';
        protected function initialize()
        {
            parent::initialize();
            try{
                $this->LOGIN_VERIFICATION_NOTE_ID;
            }catch(\Exception $e){
                $this->LOGIN_VERIFICATION_NOTE_ID = $this->getUuid();
                $this->THE_GENERATION_TIME__ = date("Y-m-d H:i:s");
            }
        }
        protected function getUuid(){
            $uuid = Db::query("select uuid() as uuid_");
            return $uuid[0]['uuid_'];
        }
        
        //使用票据
        static public function UseNotes($LOGIN_VERIFICATION_NOTE_ID,$USER_WECHAT_ID){
            Db::execute("update login_verification_note set THE_USE_OF_TIME__=now(),USER_WECHAT_ID=? where LOGIN_VERIFICATION_NOTE_ID=? and THE_USE_OF_TIME__ is null",[$USER_WECHAT_ID,$LOGIN_VERIFICATION_NOTE_ID]);
            $USER_WECHAT_IDs = Db::query("select USER_WECHAT_ID from login_verification_note where LOGIN_VERIFICATION_NOTE_ID=?",[$LOGIN_VERIFICATION_NOTE_ID]);
            return $USER_WECHAT_IDs[0]['USER_WECHAT_ID']==$USER_WECHAT_ID;
        }
    }