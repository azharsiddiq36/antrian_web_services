<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Antrian\models\Keyboard as KeyboardModel;
use Antrian\models\KeyEvent;
use Antrian\models\Locket;
use Antrian\models\Shortcut;
use Antrian\models\Service as Service;
use Antrian\models\Lisensi;

class ComponentController extends GLOBAL_Controller {

	private $KM;

	private $KE;

	private $LM;

	private $SM;

	private $SRCM;

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('level') === 'admin'){
			parent::licenseCheck();
		}
		$this->KM  = new KeyboardModel();
		$this->KE = new KeyEvent();
		$this->LM = new Locket();
		$this->SM = new Shortcut();
		$this->SRCM = new Service();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('ComponentModel','component');
		$this->load->model('LoketModel','loket');
		$this->load->model('LayananModel','layanan');
		$this->load->model('ServiceModel','service');
	}

	public function index()
	{
		$data['title'] = 'Aplikasi Antrian';
		$data['page_title'] = 'Aplikasi Antrian';
		$data['waktu'] = date('h:i');

		parent::authPage('app/index',$data);
	}

	public function parent()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan  Aplikasi';
			$data['activeMenu'] = 'parent';

			$data['component']  = parent::model('component')->get_user_app(array('app_id' => 1));
			$data['container'] = json_decode($data['component']['app_container'],true);
//		parent::cek_array($data['container']);

			parent::settingsPages('components/parent',$data);

		}
	}

	public function header()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Header Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Header Aplikasi';
			$data['activeMenu'] = 'header';

			$data['component']  = parent::model('component')->get_user_app(array(
				'app_id' => 1
			));
			$data['headerComponent'] = json_decode($data['component']['app_header'],true);
			$data['logo'] = json_decode($data['component']['app_logo'],true);

			parent::settingsPages('components/header',$data);
		}
	}

	public function footer()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Footer Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Footer Aplikasi';
			$data['activeMenu'] = 'footer';

			$query = array(
				'app_id' => 1
			);

			$data['component']  = parent::model('component')->get_user_app($query);
			$data['footerComponent'] = json_decode($data['component']['app_footer'],true);
//		parent::cek_array($data['footerComponent']);

			parent::settingsPages('components/footer',$data);
		}
	}

	public function loket()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Loket Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
			$data['activeMenu'] = 'loket';

			$query = array(
				'app_id' => 1
			);
			$data['component']  = parent::model('component')->get_user_app($query);
			$data['serviceComponent'] = json_decode($data['component']['app_service'],true);
			$data['loket'] = parent::model('loket')->getJoinLoket();
			$data['layanan'] = parent::model('layanan')->get_layanan();
			$data['nextLocket'] = $data['loket']->num_rows()+1;
			$data['suara'] = parent::model('service')->get_suara();
//			parent::cek_array($data['layanan']);
			parent::settingsPages('components/loket',$data);
		}
	}
	public function tombol()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Tombol Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Tombol Aplikasi';
			$data['activeMenu'] = 'tombol';

			$keyEventList = array();
			$keyListId = array();

			$query = array(
				'app_id' => 1
			);
			$data['keyboard']  = parent::model('component')->get_keyboard_setting($query);
			$data['dataLoket'] = parent::model('loket')->getJoinLoket()->result_array();
			$data['keyList'] = json_decode($data['keyboard']['setting_tombol'],true);
			$data['keyboard'] = $this->KM->get()->makeResultArray();

			foreach ($this->KE->get()->makeResultArray() as $key => $val){
					if (!in_array($val['loket_id'],$keyListId)){
						array_push($keyListId,$val['loket_id']);
					}
			}

			foreach ($keyListId as $key => $val){
				$locket = $this->LM->find($val)->makeRowArray();

				$callLocket = $this->KE->get(array(
					'loket_id' => $val,
					'type' => 'call'
				))->makeRowArray();

				$recallLocket = $this->KE->get(array(
					'loket_id' => $val,
					'type' => 'recall'
				))->makeRowArray();

				$keyboard = $this->KM->get(array(
					'code' => $callLocket['keyboard']
				))->makeRowArray();
				$dateTime = new DateTime($keyboard['create_at']);

				array_push($keyEventList,array(
					'call_id' => $callLocket['id'],
					'recall_id' => $recallLocket['id'],
					'loket'=> $locket['loket_nama'],
					'loket_id' => $callLocket['loket_id'],
					'keyboard'=> $keyboard['manufacture'].' | '.$dateTime->format('m-d-Y'),
					'keyboard_code' => $callLocket['keyboard'],
					'call_code'=> $callLocket['code'],
					'recall_code'=> $recallLocket['code'],
					'call_numpad' => $callLocket['numpad'],
					'recall_numpad' => $recallLocket['numpad'],
					'create_at' => $keyboard['create_at']
				));
			}

//			parent::cek_array($keyEventList);

			$data['keyevent'] = $keyEventList;

			parent::settingsPages('components/tombol',$data);
		}
	}

	public function shortcut()
	{
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Tombol Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Tombol Aplikasi';
		$data['activeMenu'] = 'shortcut';

		$data['dataLoket'] = parent::model('loket')->getJoinLoket()->result_array();
		$data['servicesList'] = $this->SRCM->get()->makeResultArray();
		$shortcutData = $this->SM->get()->makeResultArray();
		$locketShortcut = array();
		foreach ($shortcutData as $key => $value){
			$locketId = substr($value['url'],19,2);
			$service = $this->SRCM->find($locketId)->makeRowArray();
			$serviceName = $service['layanan_nama'];

			array_push($locketShortcut,array(
				'id' => $value['id'],
				'type' => $value['type'],
				'url' => $value['url'],
				'numpad' => $value['numpad'],
				'loket' => $serviceName,
				'create_at' => $value['create_at']
			));
		}
		$data['locketShortcuts'] =$locketShortcut;

		parent::settingsPages('components/shortcut',$data);
	}

	public function users()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			if ($this->session->userdata('level') === 'superAdmin'){
				$licenseModel = new Lisensi();
				$data['title'] = 'Pengaturan Aplikasi';
				$data['page_title'] = 'Pengaturan Pengguna Aplikasi';
				$data['settingsTitle'] = 'Pengaturan Pengguna Aplikasi';
				$data['activeMenu'] = 'users';
				$data['macUser'] = parent::UserMAC()->row_array();
				$data['licensedUser'] = parent::model('auth')->get_pengguna_where(array(
					'mac' => parent::_clientMAC()
				))->row_array();

				$data['keyboard']  = parent::model('component')->get_keyboard_setting(array('app_id' => 1));
				$data['dataLoket'] = parent::model('loket')->getJoinLoket()->result_array();
				$data['keyList'] = json_decode($data['keyboard']['setting_tombol'],true);
				$data['mac'] = parent::_clientMAC();
				$data['licenseData'] = $licenseModel->get(array(
					'mac_pengguna' => parent::_clientMAC()
				))->makeRowArray();

				parent::settingsPages('components/users',$data);
			}else{
				show_404();
			}
		}
	}

	public function editLoket(){
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Loket Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
		$data['activeMenu'] = 'loket';
		$query = array(
			'app_id' => 1
		);
		$data['component']  = parent::model('component')->get_user_app($query);
		$data['serviceComponent'] = json_decode($data['component']['app_service'],true);
		$data['loket'] = parent::model('loket')->getJoinLoket();
		$data['layanan'] = parent::model('layanan')->get_layanan();
		parent::settingsPages('components/loket_edit',$data);
	}

	
}
