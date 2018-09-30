<?php

namespace app\admin\controller;

use think\Controller;

class Menu extends Controller
{
    public function index()
    {
        return view("menu");
    }
}