<?php


function get_bk_menus($parent = 0 , $level = 1){
	return BKM()->front->get_menus($parent, $level);
}

function get_bk_menu($id = 0, $col = 'id'){
	$menu = BKM()->front->get_menu($id, $col);

	if($menu){
		return $menu;
	}

	return "";
}

function get_bk_key_meta($id = 0, $key = 'img'){
	return BKM()->front->get_meta_value($id, $key);
}


function bkm_menu(){
	require BKM_PATH . '/views/bkm-menu.php';
}
