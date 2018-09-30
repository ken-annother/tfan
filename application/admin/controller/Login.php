<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    public function index()
    {
        // 进入登录页面,删除UserId的cookie
        cookie("userId", "-1");

    	if(request()->method() == 'POST'){
    		return $this->post();
    	}else{
    		return view("login");
    	}
        
    }

    private function post()
    {
        $msg =  $this->validate(request()->param(),'Admin');
		if(true !== $msg){
			// return ['code' => 400, 'mgs' => $result];
            return $this->error($msg);
		}

    	$username = input('post.username');
    	$password = input('post.password');

        $ret = Db::name('admin')->where('admin_name', $username)->find();
        if(empty($ret)){
            return $this->error("用户名不存在");
        }

        if($ret['admin_pwd'] != $password){
            return $this->error("密码错误");
        }

        saveToken($ret['id']);
    	return $this->success("登录成功");
    }
}