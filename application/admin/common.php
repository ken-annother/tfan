<?php
use think\Db;

function saveToken($userId){
	session('token', $userId);
	cookie('userId', $userId,3600);
}


function validateToken(){
	$ret = session('token');
	$userId = cookie('userId');
	if(empty($ret) || empty($userId) || $ret != $userId ){
		return false;
	}

	return true;
}


$USERNAME = '';
$STORE_ID = null;

function getUserName(){
	if(empty($USERNAME)){
    	$user = Db::name('admin')->where('id', cookie('userId'))->find();
    	$USERNAME = $user['admin_name'];
    	$STORE_ID = $user['store_id'];
	}

	return $USERNAME;
}


function getStoreId(){
	if(empty($STORE_ID)){
    	$user = Db::name('admin')->where('id', cookie('userId'))->find();
    	$USERNAME = $user['admin_name'];
    	$STORE_ID = $user['store_id'];
	}

	return $STORE_ID;
}