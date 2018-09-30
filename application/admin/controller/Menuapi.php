<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Menuapi extends Controller
{
    public function index()
    {
    	$storeId = getStoreId();
/*		$pricees = Db::name('menu_cat')
				->alias('C')
				->join('__MENU_FOOD__ F', 'C.id = F.menu_cat_id', 'LEFT')
				->join('__MENU_PRICE__ P', 'F.id = P.food_id', 'LEFT')
				->where('C.store_id', $storeId)
				->column('C.id as menu_cat_id, C.menu_category, C.menu_category_order, 
F.id as food_id, F.menu_food_order, F.food_pic, F.food_name, F.food_desc,
P.id as price_id, P.flavor_cat, P.flavor, P.price');*/
		// $sql = "
		// SELECT
		// 	C.id AS menu_cat_id,
		// 	`C`.`menu_category`,
		// 	`C`.`menu_category_order`,
		// 	F.id AS food_id,
		// 	`F`.`menu_food_order`,
		// 	`F`.`food_pic`,
		// 	`F`.`food_name`,
		// 	`F`.`food_desc`,
		// 	P.id AS price_id,
		// 	`P`.`flavor_cat`,
		// 	`P`.`flavor`,
		// 	`P`.`price` 
		// FROM
		// 	`tfan_menu_cat` `C`
		// 	LEFT JOIN `tfan_menu_food` `F` ON `C`.`id` = `F`.`menu_cat_id`
		// 	LEFT JOIN `tfan_menu_price` `P` ON `F`.`id` = `P`.`food_id` 
		// WHERE
		// 	`C`.`store_id` = 1
		// ";

		// $pricees = Db::query($sql);

		echo count($pricees);
		return $this->success("hallo", null, $pricees);
		$menuCatArray = array();

        foreach($pricees as $price){

        	$menuCatId = $price['menu_cat_id'];

        	if(!empty($menuCatId) && !array_key_exists($menuCatId,$menuCatArray)){
				$nowMenuCat = array();
        		$menuCatArray[$menuCatId] = $nowMenuCat;
        	}

        	$menuCatArray[$menuCatId]['menu_cat_id'] = $menuCatId;
        	$menuCatArray[$menuCatId]['menu_category'] = $price['menu_category'];
			$menuCatArray[$menuCatId]['menu_category_order'] = $price['menu_category_order'];

        	$foodId = $price['food_id'];
			if(!empty($foodId)){
				if(!array_key_exists("food_list",$menuCatArray[$menuCatId])){
					$foodList = array();
	        		$menuCatArray[$menuCatId]['food_list'] = $foodList;
	        	}

	        	if( !array_key_exists($foodId,$menuCatArray[$menuCatId]['food_list'])){
					$foodList = array();
	        		$menuCatArray[$menuCatId]['food_list'][$foodId] = $foodList;
	        	}

	        	$menuCatArray[$menuCatId]['food_list'][$foodId]['food_id'] = $foodId;
	        	$menuCatArray[$menuCatId]['food_list'][$foodId]['food_name'] = $price['food_name'];
	        	$menuCatArray[$menuCatId]['food_list'][$foodId]['food_desc'] = $price['food_desc'];
	        	$menuCatArray[$menuCatId]['food_list'][$foodId]['menu_food_order'] = $price['menu_food_order'];

	        	$flavorCat = $price['flavor_cat'];

	        	if(!empty($foodId)){
					if(!array_key_exists("price_list",$menuCatArray[$menuCatId]['food_list'][$foodId])){
						$priceList = array();
		        		$menuCatArray[$menuCatId]['food_list'][$foodId]['price_list'] = $priceList;
		        	}

		        	if( !array_key_exists($flavorCat,$menuCatArray[$menuCatId]['food_list'][$foodId]['price_list'])){
						$flavorList = array();
		        		$menuCatArray[$menuCatId]['food_list'][$foodId]['price_list'][$flavorCat] = $flavorList;
		        	}

		        	$menuCatArray[$menuCatId]['food_list'][$foodId]['price_list'][$flavorCat]['flavor_cat'] = $flavorCat;


	        	}

			}
			

        }

        return $this->success("hallo", null, $pricees);
    }
}