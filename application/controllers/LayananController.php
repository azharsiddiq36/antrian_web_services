<?php

	use Antrian\models\Lisensi as LicenseModel;

	class LayananController extends GLOBAL_Controller{


		private $userAppID;

		public function __construct()
		{
			parent::__construct();
			$this->appTypeCheck();
			date_default_timezone_set("Asia/Jakarta");
			$this->userAppID = get_cookie('user_app');
			$this->load->model('ComponentModel', 'component');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('AntrianModel','antrian');
			$this->load->model('ServiceModel','service');
			$this->load->model('LayananModel','layanan');
		}

		public function index()
		{
			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';

			parent::authPage('layanan/index',$data);
		}

		public function registrasi()
		{
			if (isset($_POST['login'])){
				$username = parent::post('username');
				$password = parent::post('password');

				$query = array(
					'username' => $username,
					'password'  => parent::a20A($password)
				);

				$user = parent::model('antrian')->get_user($query);

				if ($user->num_rows() > 0){
					$thisUser = $user->row_array();

					$this->session->set_userdata($thisUser);
					redirect('settings/parent');
				}else{
					parent::alert('alert','fail');
					redirect('layanan/registrasi');
				}
			}else{
				$data['title'] = 'Aplikasi Antrian';
				$data['page_title'] = 'Aplikasi Antrian';

				parent::authPage('layanan/registrasi',$data);
			}
		}

		public function lists(){
			$data['title'] = 'Daftar Loket/Layanan';
			$data['page_title'] = 'Aplikasi Antrian';
			$data['dataLoket'] = parent::model('antrian')->get_loket()->result_array();
			$data['service'] = parent::model('service');
			$data['dataLayanan'] = parent::model('layanan')->get_layanan()->result_array();
			$data['loket'] = parent::model('loket');
			$data['layanan'] = parent::model('layanan');
			$data['antrian'] = parent::model('antrian');

			parent::authPage('layanan/daftar',$data);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect('layanan');
		}

		public function appTypeCheck()
		{
			$licenseModel = new LicenseModel();
			$sessionData = $licenseModel->get(array(
				'mac_pengguna' => parent::_clientMAC()
			))->makeRowArray();

			if ($sessionData !== null){
				$this->session->set_userdata($sessionData);
			}

		}

		public function loketApi($id = null)
		{
			if ($id!== null){
				$locket = parent::model('loket')->getJoinLocketWhere(array(
					'loket_id' =>  $id
				))->row_array();
			}elseif (isset($_GET)){
				$query  = array();
				foreach ($_GET as $key => $v){
					$query[$key] = $v;
				}
				$locket = parent::model('loket')->getJoinLocketWhere($query)->result_array();
			}else{
				$locket = parent::model('loket')->get_loket()->result_array();
			}

			echo json_encode(array(
				'status' => '200',
				'message' => 'menampilkan hasil request',
				'data' => $locket
			));
		}
	}
