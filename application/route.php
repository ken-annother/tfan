<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::group(
	'a',
	[
		'index'     => "admin/index/index",
		'login'     => ['admin/login/index', ['method' => 'get|post']],
    	'welcome'   => "admin/welcome/index",
    	'menuedit'	=> "admin/menu/index",
	]
);

return [
	'__rest__'=>[
	        'a/menu'=>'admin/menuapi',
	],
];
