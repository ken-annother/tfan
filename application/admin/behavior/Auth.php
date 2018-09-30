<?php

namespace app\admin\behavior;

use \think\Request;

class Auth
{
	use \traits\controller\Jump;

	private $ignore_controller = [
		'login',
	];

	public function run(&$params)
	{
		$request = Request::instance();
		\think\Log::debug("module is :" . $request->module() . " and controller is :"  . $request->controller());
		if($request->module() == 'admin'){
			$this->auth($request->controller());
		}

	}

	public function auth($controller){
		$result = false;

		foreach ($this->ignore_controller as $contro) {
			if($contro != strtolower($controller)){
				if(validateToken()){
					$result =  true;
					break;
				}
			}else{
				$result = true;
				break;
			}
		}


		if(!$result){
			$this->redirect(config('url.WEB_BASE_URL') . '/a/login.html');
		}
	}
}