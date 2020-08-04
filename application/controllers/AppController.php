<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	use Antrian\models\Media;

	class AppController extends GLOBAL_Controller {

		private $media;
		
		public function __construct()
		{
			parent::__construct();
			parent::licenseCheck();

			$this->media = new Media();

			$this->load->model('AuthModel','auth');
			$this->load->model('ComponentModel','component');
			$this->load->model('AntrianModel','antrian');
			date_default_timezone_set("Asia/Jakarta");
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
			parent::authPage('app/index',$data);
		}

		public function settings()
		{
			if ($this->session->userdata('username') === null){
				redirect('layanan/registrasi');
			}else{
				$data['title'] = 'Pengaturan Aplikasi';
				$data['page_title'] = 'Pengaturan Aplikasi';
				$data['settingsTitle'] = 'Pengaturan Umum';
				$data['activeMenu'] = 'umum';


				parent::settingsPages('app/settings',$data);
			}
		}

		public function loket()
		{
			$data['title'] = 'Pengaturan Loket';
			$data['page_title'] = 'Pengaturan Loket';
			$data['settingsTitle'] = 'Pengaturan Loket';
			$data['activeMenu'] = 'loket';

			parent::settingsPages('app/loket',$data);
		}

		public function colours()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Warna';
			$data['activeMenu'] = 'warna';

			parent::settingsPages('app/colours',$data);
		}

		public function texts()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Teks';
			$data['activeMenu'] = 'teks';

			parent::settingsPages('app/texts',$data);
		}

		public function audio()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Suara';
			$data['activeMenu'] = 'suara';

			parent::settingsPages('app/audio',$data);
		}

		public function media()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Media';
			$data['activeMenu'] = 'media';

			$data['media'] = $this->media->get(array(),array(
				'create_at' => 'DESC'
			))->makeResultArray();

			$duration = $this->media->get(array(
				'type' => 'image'
			))->makeRowArray();

			if ($duration!==null){
				$data['duration'] = $duration['image_duration'];
			}else{
				$data['duration'] = 0;
			}

			parent::settingsPages('app/media',$data);
		}

		public function prints()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Hasil Cetak';
			$data['activeMenu'] = 'cetakan';

			parent::settingsPages('app/prints',$data);
		}


	}
