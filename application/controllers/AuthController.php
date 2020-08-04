<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class AuthController extends GLOBAL_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('AuthModel','auth');
		}
		
		public function login()
		{

			if (isset($_POST['login'])){
				$userdata = array(
					'username' => parent::post('username'),
					'password' => md5(parent::post('password'))
				);

				$userStatus = parent::model('auth')->get_pengguna($userdata['username'],$userdata['password']);


				if ($userStatus->num_rows() > 0){
					$user = $userStatus->row_array();
					$this->session->set_userdata($user);
					redirect(site_url());
				}else{
					parent::alert('alert','invalid');
					redirect('login');
				}
			}else{
				$data['title'] = 'Masuk ke Aplikasi Antrian';
				$data['page_title'] = 'Aplikasi Antrian';

				parent::authPage('auth/login',$data);

			}
		}

	}
