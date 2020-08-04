<?php
	
	class ComponentModel extends  GLOBAL_Model {
		private $table;

        public function __construct()
        {
            parent::__construct();
			$this->table = 'tbl_app';
        }

        /*
         * get modules
         * */
        public function get_user_app($query)
		{
			return parent::get_array_of_row($this->table, $query);
		}

		public function get_keyboard_setting($query)
		{
			return parent::get_array_of_row('tbl_setting',$query);
		}

		//user media
		public function get_user_media($appId)
		{
			$query = array('media_id' => $appId);
			return parent::get_array_of_row('tbl_media',$query);
		}

		/*
		 * SERVICES
		 * save changes from client
		 * */

        public function edit_component($appId,$dataEdit)
		{
			parent::update_table_with_status($this->table,'app_id',$appId,$dataEdit);
		}

		//update user media
		public function edit_media($appId,$dataEdit)
		{
			parent::update_table('tbl_media','media_id',$appId,$dataEdit);
		}
    }
