<?php

namespace app\admin\controller;

use think\Controller;
use think\Log;

class Welcome
{

	public function index()
    {
    	Log::error("就想打个错误日志");
        return view("welcome");
    }
}