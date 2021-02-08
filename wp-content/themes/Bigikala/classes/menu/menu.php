<?php
if(!class_exists('BKMenu')){

	class BKMenu {

		protected $version;

		protected static $_instance;

		public $front;


		public function __construct() {
			$this->defines();
			$this->requires();
			$this->init();
            
		}
        
       

        
		public static function instance(){
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function init(){
			$this->front = new BKM_Front();
		}

		private function defines(){
			define('BKM_URL', get_template_directory_uri() . '/classes/menu/');
			define('BKM_PATH', dirname(__FILE__));
		}

		private function requires(){
            require_once BKM_PATH . '/inc/bkm-front-class.php';
            require_once BKM_PATH . '/inc/bkm-frontend-functions.php';
		}

	}

}

function BKM(){
	return BKMenu::instance();
}

$GLOBALS['BigikalaMenu'] = BKM();