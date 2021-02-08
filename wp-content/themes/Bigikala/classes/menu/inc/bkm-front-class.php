<?php

if(!defined('ABSPATH')){
	exit;
}

class BKM_Front {

	public function __construct() {
	}

	public function get_menus( $parent = 0, $level = 1){
		global $wpdb;

		if(!is_numeric($parent) || !is_numeric($level)){
			return false;
		}

		$table = $wpdb->prefix . 'bk_menu';
		$query_prepare = $wpdb->prepare("select * from $table where parent = %d and level = %d", $parent, $level);

		$result = $wpdb->get_results($query_prepare);

		if(!$result){
			return false;
		}

		if($wpdb->num_rows < 0){
			return false;
		}

		return $result;
	}

	public function get_menu($id, $col = 'id'){
		global $wpdb;

		if(!is_numeric($id)){
			return false;
		}

		$table = $wpdb->prefix . 'bk_menu';
		$query_prepare = $wpdb->prepare("select $col from $table where id = %d limit 1", $id);

		$result = $wpdb->get_var($query_prepare);

		if(!$result){
			return false;
		}

		if($wpdb->num_rows < 0){
			return false;
		}

		return $result;

	}

	public function get_meta_value($id, $key){
		global $wpdb;

		if(!is_numeric($id) or is_null($key)){
			return false;
		}

		$table = $wpdb->prefix . 'bk_menumeta';

		$query_prepare = $wpdb->prepare("select meta_value from $table where menu_id = %d and meta_key = %s limit 1", $id, $key);

		$result = $wpdb->get_var($query_prepare);

		if(!$result){
			return false;
		}


		return $result;
	}

}