<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Log;

class Zhuzhou extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    
}