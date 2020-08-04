<?php
	
	class AuthModel extends  GLOBAL_Model {
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_pengguna($username,$password)
		{
			$user = array(
				'username' => $username,
				'password' => $password
			);
			
			return parent::get_object_of_row('auth',$user);
		}

		public function get_pengguna_where($query)
		{
			$obj = $this->db->get_where('auth',$query);
			return $obj;
		}

		public function get_lisensi_where($query)
		{
			$obj = $this->db->get_where('lisensi',$query);
			return $obj;
		}

		public function add_user($data)
		{
			return parent::insert_with_status('auth',$data);
		}

		public function add_license($data)
		{
			return parent::insert_with_status('lisensi',$data);
		}

		public function edit_user($id,$loginData)
		{
			return parent::update_table_with_status('auth','id_auth',$id,$loginData);
		}

		public function edit_license($id,$licenseData)
		{
			return parent::update_table_with_status('lisensi','id_lisensi',$id,$licenseData);
		}

		public function get_enc_setting()
		{
			return parent::get_object_of_table('encryption');
		}
		
	}
