<?php
	require __DIR__ . '/../../vendor/autoload.php';

	use Nacmartin\PhpExecJs\PhpExecJs;
	class ExtendScreen extends GLOBAL_Controller{

		public function __construct()
		{
			parent::__construct();
			parent::licenseCheck();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->model('AntrianModel','antrian');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('LayananModel','layanan');
			$this->load->model('ServiceModel','service');
			$this->load->model('ComponentModel','component');
		}

		public function index()
		{

			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';

			$data['dataLoket'] = parent::model('antrian')->get_loket()->result_array();

			$data['component']  = parent::model('component')->get_user_app(array('app_id' => 1));
			$data['container'] = json_decode($data['component']['app_container'],true);
			$data['header'] = json_decode($data['component']['app_header'],true);
			$data['loket'] = json_decode($data['component']['app_service'],true);
			$data['footer'] = json_decode($data['component']['app_footer'],true);
			$data['logo'] = json_decode($data['component']['app_logo'],true);

			$data['media']  = parent::model('component')->get_user_media(1);
			$mediaGambar = json_decode($data['media']['media_gambar'],true);
			$data['dataGambar'] = $mediaGambar['data-gambar'];
			$data['titleGambar'] = $mediaGambar['title-gambar'];
			$data['durasi'] = $mediaGambar['durasi-slide'];

			parent::authPage('extend/index',$data);
		}

	}
