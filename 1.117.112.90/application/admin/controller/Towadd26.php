<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Log;

class Towadd26 extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    public function baocun(){
        $ps = input("post.");
        $points = $ps['points'];
        file_put_contents("teshu.json",json_encode($points));
        return json_encode($points);
    }
    
    public function ztqkfx(){
        return $this->fetch();
    }
    
    public function dpsjzs(){
        return $this->fetch();
    }
    
    public function gjdpsjzs(){
        return $this->fetch();
    }
    
    public function sslbzs(){
        return $this->fetch();
    }
    
    public function getshengxzqh(){
        return $this->fetch();
    }
    
    public function tongjifenxi(){
        return $this->fetch();
    }
    
    public function jtllxc(){
        return $this->fetch();
    }
}