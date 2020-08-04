<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Antrian\models\Media;
use Antrian\models\KeyEvent;
use Antrian\models\Shortcut;
use AppEvent\EventData;
use Antrian\models\App;

class ComponentService extends GLOBAL_Controller
{
	private $userAppID;

	private $media;

	private $keyEvent;
	
	private $shortcut;

	private $eventData;

	private $app;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->userAppID = 1;

		$this->media =  new Media();
		$this->keyEvent = new KeyEvent();
		$this->shortcut = new Shortcut();
		$this->eventData = new EventData();
		$this->app = new App();

		$this->load->model('ComponentModel', 'component');
		$this->load->model('LoketModel', 'loket');
		$this->load->model('LayananModel', 'layanan');
		$this->load->model('ServiceModel', 'service');
	}

	/*
	 * modul untuk mendapatkan data user App
	 * */
	public function userApp()
	{
		$query = array(
			'app_id' => get_cookie('user_app')
		);
		$userApp = parent::model('component')->get_user_app($query);

		if ($userApp !== null) {
			echo json_encode(array(
				'data' => $userApp,
				'message' => 'menampilkan data aplikasi pengguna',
				'status' => 'success'
			));
		} else {
			echo json_encode(array(
				'data' => null,
				'message' => 'tidak ada data untuk ditampilkan',
				'status' => 'error'
			));
		}
	}

	/*
	 * modul untuk menyimpan perubahan setting dari klien ke database
	 * */
	public function editHeader()
	{
		if (isset($_POST['background-header'])) {
			$clientInput = array(
				"logo-position" => parent::post('logo-position'),
				"background-header" => parent::post('background-header'),
				"background-paralelogram" => parent::post('background-paralelogram'),
				"background-timer" => parent::post('background-timer'),
				"color-timer" => parent::post('color-timer'),
				"font-family-timer" => parent::post('font-family-timer'),
				"fon-size" => '45px',
				"color-date" => parent::post('color-date'),
				"font-family-date" => parent::post('font-family-date')
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_header' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID, $dataEdit);
			$this->eventData->fire('refresh',array(
				'data' => 'header'
			));

			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		} else {
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function editFooter()
	{
		if (isset($_POST['background-footer'])) {
			$clientInput = array(
				"background-footer" => parent::post('background-footer'),
				"color-footer" => parent::post('color-footer'),
				"font-family-footer" => parent::post('font-family-footer'),
				"footer-text" => parent::post('footer-text'),
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_footer' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID, $dataEdit);
			$this->eventData->fire('refresh',array(
				'data' => 'footer'
			));
			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		} else {
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function editService()
	{
		if (isset($_POST['background-queue-box'])) {
			$clientInput = array(
				'background-queue-box' => parent::post('background-queue-box'),
				'background-queue-number' => parent::post('background-queue-number'),
				'background-queue-footer' => parent::post('background-queue-footer'),
				'color-number' => parent::post('color-number'),
				'color-queue-name' => parent::post('color-queue-name'),
				'color-footer' => parent::post('color-footer'),
				'color-left-queue' => parent::post('color-left-queue'),
				'font-family-number' => parent::post('font-family-number'),
				'font-family-name' => parent::post('font-family-name'),
				'font-family-footer' => parent::post('font-family-footer'),
				'font-family-left-queue' => parent::post('font-family-left-queue'),
				'border-top-footer-color' => parent::post('background-queue-number')
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_service' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID, $dataEdit);

			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		} else {
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function unggahLatar()
	{
		if (isset($_POST['unggah'])) {
			$backgroundImages = parent::post('background-image');
			$query = array(
				'app_id' => 1
			);

			$data['component'] = parent::model('component')->get_user_app($query);
			$decodeComponent = json_decode($data['component']['app_container'], true);
			$warnaLama = $decodeComponent['background-color'];
			$gambarLama = $decodeComponent['background-image-src'];


			if ($backgroundImages === 'true') {
				$config['upload_path'] = './assets/images/background/';
				$config['allowed_types'] = 'png|jpeg|jpg';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				$this->upload->do_upload('background-image-src');
				$gambarLatar = $this->upload->data('file_name');

				$dataContainer = array(
					'background-color' => $warnaLama,
					'background-image' => parent::post('background-image'),
					'background-image-src' =>  'assets/images/background/'.$gambarLatar
				);

				$dataEdit = array(
					'app_container' => json_encode($dataContainer),
					'app_date_edited' => date('Y-m-d H:i:s')
				);

				parent::model('component')->edit_component($this->userAppID, $dataEdit);
			} else {
				$dataContainer = array(
					'background-color' => parent::post('background-color'),
					'background-image' => parent::post('background-image'),
					'background-image-src' => $gambarLama
				);

				$dataEdit = array(
					'app_container' => json_encode($dataContainer),
					'app_date_edited' => date('Y-m-d H:i:s')
				);

				parent::model('component')->edit_component($this->userAppID, $dataEdit);
			}

			$this->eventData->fire('refresh',array(
				'data' => 'background'
			));
			parent::alert('alert', 'edit');
			redirect('settings/parent');

		} else {
			show_404();
		}
	}

	public function unggahLogo()
	{
		if (isset($_POST['unggah'])) {
			$appData = $this->app->find(1)->makeRowArray();
			$clear = str_replace('\\','',$appData['app_logo']);
			$endClear = str_replace('"','',$clear);
			if (file_exists($endClear)){
				unlink($endClear);
			}
			$config['upload_path'] = './assets/images/logo/';
			$config['allowed_types'] = 'png|jpeg|jpg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('logo-img');
			$logo = $this->upload->data('file_name');

			$dataEdit = array(
				'app_logo' => json_encode('assets/images/logo/'.$logo),
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID, $dataEdit);
			$this->eventData->fire('refresh',array(
				'data' => 'logo'
			));
			parent::alert('alert', 'edit');
			redirect('settings/header');
		} else {
			show_404();
		}
	}

	public function setGambar()
	{
		if (isset($_POST['simpan'])) {
			$userMedia = parent::model('component')->get_user_media($this->userAppID);
			$mediaGambar = json_decode($userMedia['media_gambar'], true);
			$dataGambar = $mediaGambar['data-gambar'];
			$titleGambar = $mediaGambar['title-gambar'];

			$config['upload_path'] = './assets/images/slides/';
			$config['allowed_types'] = 'png|jpeg|jpg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('upload-gambar');
			$titel = $this->upload->data('file_name');

			array_push($dataGambar, 'assets/images/slides/' . $titel);
			array_push($titleGambar, $titel);

			$dataEncode = array(
				'durasi-slide' => parent::post('durasi-gambar'),
				'data-gambar' => $dataGambar,
				'title-gambar' => $titleGambar
			);

			$gambarOption = parent::post('gambar-option');

			if ($gambarOption !== '') {
				$dataEdit = array(
					'media_gambar' => json_encode($dataEncode),
					'media_aktif' => 'gambar',
					'media_date_edited' => date('Y-m-d H:i:s'),
				);
			} else {
				$dataEdit = array(
					'media_gambar' => json_encode($dataEncode),
					'media_aktif' => 'video',
					'media_date_edited' => date('Y-m-d H:i:s')
				);
			}
//			parent::cek_array($dataEdit);

			parent::model('component')->edit_media($this->userAppID, $dataEdit);

			parent::alert('alert', 'edit');
			redirect('settings/media');
		} else {
			show_404();
		}
	}

	public function getMedia($id = null)
	{
		if ($id!==null){
			$data = $this->media->find($id)->makeResultArray();
			echo json_encode(array(
				'status' => '200',
				'data' => $data,
				'message' => 'showing media result by id'
			));
		}

		$data = $this->media->get(array(),array())->makeResultArray();
		echo json_encode(array(
			'status' => '200',
			'data' => $data,
			'message' => 'showing media result'
		));
	}

	public function setMedia()
	{
		if (isset($_POST['simpan'])){
			$config['upload_path'] = './assets/media/slides/';
			$config['allowed_types'] = 'png|jpeg|jpg|mp4';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('media-upload')){
				$title = $this->upload->data('file_name');
				$mediaType = $this->upload->data('file_type');
				$type = 'video';

				if (strpos($mediaType, 'image') !== false){
					$type = 'image';
				}

				$media = $this->media->insert(array(
					'title' => $title,
					'source' => 'assets/media/slides/'.$title,
					'type' => $type,
					'media_type' => $mediaType,
					'image_duration' => parent::post('duration')
				));

				if ($media > 0){
					$this->eventData->fire('refresh',array(
						'data' => 'add-media'
					));
					parent::alert('alert', 'edit');
					redirect('settings/media');
				}

			}else{
				redirect('settings/media');
			}
		}
	}

	public function deleteMedia($id)
	{
		$thisMedia = $this->media->find($id)->makeRowArray();
		$delete =  $this->media->delete($id);

		if ($delete){
			$fileDelete = unlink($thisMedia['source']);
			if ($fileDelete){
				parent::alert('alert', 'edit');
				$this->eventData->fire('refresh',array(
					'data' => 'delete-media'
				));
				;
				redirect('settings/media');
			}else{
				parent::alert('alert', 'error');
				redirect('settings/media');
			}

		}else{
			parent::alert('alert', 'error');
			redirect('settings/media');
		}
	}

	public function deleteGambar($index)
	{
		$userMedia = parent::model('component')->get_user_media($this->userAppID);
		$mediaGambar = json_decode($userMedia['media_gambar'], true);
		$durasi = $mediaGambar['durasi-slide'];
		$titleGambar = $mediaGambar['title-gambar'];
		$dataGambar = $mediaGambar['data-gambar'];
		array_splice($dataGambar, $index, 1);
		array_splice($titleGambar, $index, 1);

		$dataEncode = array(
			'durasi-slide' => $durasi,
			'data-gambar' => $dataGambar,
			'title-gambar' => $titleGambar
		);

		$dataEdit = array(
			'media_gambar' => json_encode($dataEncode),
			'media_date_edited' => date('Y-m-d H:i:s'),
		);

		parent::model('component')->edit_media($this->userAppID, $dataEdit);

		parent::alert('alert', 'edit');
		redirect('settings/media');
	}

	public function deleteVideo($index)
	{
		$userMedia = parent::model('component')->get_user_media($this->userAppID);
		$mediavideo = json_decode($userMedia['media_video'], true);

		array_splice($mediavideo, $index, 1);

		$dataEdit = array(
			'media_video' => json_encode($mediavideo),
			'media_date_edited' => date('Y-m-d H:i:s'),
		);

		parent::model('component')->edit_media($this->userAppID, $dataEdit);

		parent::alert('alert', 'edit');
		redirect('settings/media');
	}

	public function addLocket()
	{
		if (isset($_POST['submit'])) {
			$nama = parent::post('locket_name');
			$nomor = parent::post('locket_number');
			$layanan = parent::post('locket_services');
			$data = array(
				"loket_nama" => $nama,
				"loket_alias" => parent::post('locket_alias'),
				"loket_petugas" => parent::post('locket_officer'),
				"loket_nomor" => $nomor,
				"loket_layanan_id" => $layanan,
				"loket_waktu_panggilan" => date('Y-m-d H:i:s')
			);
			parent::model('loket')->post_loket($data);
			redirect('settings/loket');
		}

	}

	public function deleteLocket($index)
	{
		$data = array(
			"loket_id" => $index
		);
		parent::model('loket')->deleteloket($data);
		redirect('settings/loket');
	}

	public function editloket($index)
	{
		if (isset($_POST['submit'])) {
			$nama = parent::post('locket_name');
			$nomor = parent::post('locket_number');
			$layanan = parent::post('locket_services');
			$data = array(
				"loket_nama" => $nama,
				"loket_alias" => parent::post('locket_alias'),
				"loket_petugas" => parent::post('locket_officer'),
				"loket_nomor" => $nomor,
				"loket_layanan_id" => $layanan
			);
			parent::model('loket')->editloket($index, $data);
			redirect('settings/loket');
		} else {
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Loket Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
			$data['activeMenu'] = 'loket';
			$query = array(
				'app_id' => get_cookie('user_app')
			);
			$data['currentData'] = parent::model('loket')->getOne(array("loket_id" => $index));
			$data['component'] = parent::model('component')->get_user_app($query);
			$data['serviceComponent'] = json_decode($data['component']['app_service'], true);
			$data['loket'] = parent::model('loket')->getJoinLoket();
			$data['layanan'] = parent::model('layanan')->get_layanan();
			parent::settingsPages('components/loket_edit', $data);
		}
	}

	public function addService()
	{
		if (isset($_POST)){
			$suaraNama = parent::model('service')->get_suara_where(array(
				'suara_nama' => parent::post('service_name')
			))->row_array();
			$suaraAwalan = parent::model('service')->get_suara_where(array(
				'suara_nama' => parent::post('service_prefix')
			))->row_array();

			$dataLayanan = array(
				'layanan_nama' => parent::post('service_name'),
				'layanan_awalan' => parent::post('service_prefix'),
				'layanan_suara_nama' => $suaraNama['suara_file'],
				'layanan_suara_awalan' => $suaraAwalan['suara_file']
			);

			$insertStatus = parent::model('layanan')->post_layanan($dataLayanan);

			parent::alert('alert','edit');
			redirect('settings/loket');
		}else{
			show_404();
		}
	}

	public function editLayanan($serviceId)
	{
		if (isset($_POST['submit'])) {
			$suaraNama = parent::model('service')->get_suara_where(array(
				'suara_nama' => parent::post('service_name')
			))->row_array();
			$suaraAwalan = parent::model('service')->get_suara_where(array(
				'suara_nama' => parent::post('service_prefix')
			))->row_array();
			$data = array(
				"layanan_nama" => parent::post('service_name'),
				"layanan_awalan" => parent::post('service_prefix'),
				"layanan_suara_nama" => $suaraNama['suara_file'],
				"layanan_suara_awalan" => $suaraAwalan['suara_file']
			);
			parent::cek_array($data);
			parent::model('layanan')->editLayanan($serviceId, $data);
			redirect('settings/loket');
		} else {
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Loket Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
			$data['activeMenu'] = 'loket';
			$data['currentData'] = parent::model('layanan')->getOne(array("layanan_id" => $serviceId));
			$data['suara'] = parent::model('service')->get_suara();

//			parent::cek_array($data['currentData']);
			parent::settingsPages('components/layanan_edit',$data);
		}
	}

	public function deleteLayanan($index)
	{
		$data = array(
			"layanan_id" => $index
		);
		parent::model('layanan')->deletelayanan($data);
		redirect('settings/loket');
	}

	public function editTombol()
	{
		if (isset($_POST['simpan'])){


			parent::model('layanan')->edit_setting_tombol(1,);

			parent::alert('alert','edit');
			redirect('settings/tombol');
		}
	}

	public function addKeyEvent()
	{
		if (isset($_POST)){
			$loket = parent::post('loket');
			$keyboard = parent::post('keyboard');
			$call = parent::post('call');
			$callCode = parent::post('call-code');
			$recall = parent::post('recall');
			$recallCode = parent::post('recall-code');

			$callInsert = $this->keyEvent->insert(array(
				'loket_id' => $loket,
				'keyboard' => $keyboard,
				'numpad' => $call,
				'code' => $callCode,
				'type' => 'call'
			));

			if ($callInsert > 0){
				$recallInsert = $this->keyEvent->insert(array(
					'loket_id' => $loket,
					'keyboard' => $keyboard,
					'numpad' => $recall,
					'code' => $recallCode,
					'type' => 'recall'
				));

				if ($recallInsert > 0){
					parent::alert('alert','edit');
					redirect('settings/tombol');
				}
			}
		}
	}

	public function deleteKeyEvent()
	{
		if (isset($_GET)){
			$callID = parent::get('call');
			$recallID = parent::get('recall');
			$callDelete = $this->keyEvent->delete($callID);
			if ($callDelete > 0){
				$recallDelete = $this->keyEvent->delete($recallID);
				if ($recallDelete > 0){
					parent::alert('alert','edit');
					redirect('settings/tombol');
				}
			}else{
				parent::cek_type($callDelete);
				parent::alert('alert','error');
				redirect('settings/tombol');
			}
		}
	}

	public function addShortcut()
	{
		if (isset($_POST)){
			$type = parent::post('type');
			$url = parent::post('url');
			$numpad = parent::post('numpad');
			$shortcutInsert = $this->shortcut->insert(array(
				'type' => $type,
				'url' => $url,
				'numpad' => $numpad
			));

			if ($shortcutInsert>0){
				parent::alert('alert','edit');
				redirect('settings/shortcut');
			}else{
				parent::alert('alert','error');
				redirect('settings/shortcut');
			}
		}else{
			show_404();
		}
	}

	public function deleteShortcut($id)
	{
		$this->shortcut->delete($id);
		parent::alert('alert','edit');
		redirect('settings/shortcut');
	}

	public function codeExistCheck()
	{
		if ($this->input->is_ajax_request())
		{
			if (isset($_POST)){
				$keyboard = parent::post('keyboard');
				$code = parent::post('code');

				$checkResult = $this->keyEvent->get(array(
					'keyboard' => $keyboard,
					'code' => $code
				))->makeNumRows();

				echo json_encode($checkResult);
 			}
		}
	}

	public function checkLocketExists($locketId)
	{
		if ($this->input->is_ajax_request()){
			$locketOnKeyEvent = $this->keyEvent->get(array(
				'loket_id'=> $locketId
			))->makeNumRows();
			echo json_encode($locketOnKeyEvent);
		}
	}

	public function addUser()
	{
		if (isset($_POST)){
			$loginData = array(
				'username' => parent::post('username'),
				'password' => parent::a20A(parent::post('password')),
				'level' => 'admin',
				'mac' => parent::post('mac')
			);

			$licenseData = array(
				'nama_pengguna' => parent::post('app_username'),
				'mac_pengguna' => parent::post('mac'),
				'tanggal_aktivasi' => parent::post('activate_at'),
				'durasi_aktivasi' => parent::post('activation_duration'),
				'tipe_aplikasi' => parent::post('type'),
				'tanggal_tempo' => parent::post('expire_at')
			);

			$addUser = parent::model('auth')->add_user($loginData);
			if ($addUser > 0){
				$addLicense = parent::model('auth')->add_license($licenseData);

				if ($addLicense > 0){
					parent::alert('alert','edit');
					redirect('settings/users');
				}
			}
		}else{
			show_404();
		}
	}

	public function editUser()
	{
		if (isset($_POST)){
			$loginData = array(
				'username' => parent::post('username'),
				'password' => parent::a20A(parent::post('password')),
			);

			$licenseData = array(
				'nama_pengguna' => parent::post('app_username'),
				'mac_pengguna' => parent::post('mac'),
				'tanggal_aktivasi' => parent::post('activate_at'),
				'durasi_aktivasi' => parent::post('activation_duration'),
				'tipe_aplikasi' => parent::post('type'),
				'tanggal_tempo' => parent::post('expire_at')
			);
			$mac =parent::model('auth')->get_pengguna_where(array(
				'mac' => parent::_clientMAC()
			))->row_array();
			$licenseMac = parent::UserMAC()->row_array();
			$editUser = parent::model('auth')->edit_user($mac['id_auth'],$loginData);
			$editLicense = parent::model('auth')->edit_license($licenseMac['id_lisensi'],$licenseData);
			parent::alert('alert','edit');
			redirect('settings/users');

		}else{
			show_404();
		}
	}
}
