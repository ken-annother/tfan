<?php

require("../core/common.php");


use Illuminate\Database\Capsule\Manager as Capsule;

$users = Capsule::table('admin')->where('id', '=', 1)->get();

print_r($users);