<?php

	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
	use Mike42\Escpos\EscposImage;
	use AppEvent\EventData;
	use Antrian\Service\QueueService;
	use Antrian\models\Event as EventModel;
	use Antrian\helper\QueueHelper;
	use Antrian\models\Queue as QueueModel;
	use Antrian\models\Keyboard as KeyboardModel;
	use Antrian\models\KeyEvent as KeyEvent;
	use Antrian\models\Shortcut as Shortcut;

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Services extends GLOBAL_Controller
	{
		private $ED;

		private $EM;

		public function __construct()
		{
			parent::__construct();
			$this->ED = new EventData();
			$this->EM = new EventModel();
			parent::licenseCheck();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->model('AntrianModel','antrian');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('LayananModel','layanan');
			$this->load->model('ServiceModel','service');
			$this->load->model('ComponentModel','component');
		}

		public function queue()
		{
			$queueData = parent::model('antrian')->get_loket()->result_array();

			echo json_encode(array(
				'data' => $queueData,
				'status'=> '200',
				'message'=> 'menampilkan data seluruh loket yang tersedia'
			));
		}

		public function call($locketId)
		{
			$queueService = new QueueService();

			$queueService->call($locketId);

		}

		public function recall($locketId)
		{
			$queueService = new QueueService();
			$queueService->recall($locketId);
		}

		/*-- API for switch to other service  --*/
		public function switchApi($serviceId)
		{
			if (isset($_POST)){
				$dataSwitch = array(
					'antrian_nomor' => parent::post('nomor'),
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'alihan',
					'antrian_nomor_alihan' => parent::post('text'),
					'antrian_suara_alihan_prefix' => parent::post('suara_awalan'),
					'antrian_suara_alihan' => parent::post('suara')
				);

				$switchDataValidation = parent::model('antrian')->get_join_where(array(
					'antrian_layanan_id' => $serviceId,
					'antrian_nomor_alihan' =>parent::post('text')
				))->row_array();


				if ($switchDataValidation !== null){
					echo json_encode(array(
						'status' => '500',
						'message' => 'antrian tersebut telah di alihkan ke layanan yang dituju'
					));
				}else{
					$insertQueue = parent::model('antrian')->post_antrian($dataSwitch);
					if ($insertQueue > 0){
						echo json_encode(array(
							'status' => '200',
							'message' => 'berhasil mengalihkan antrian ke layanan lain'
						));
					}
				}
			}
		}

		/*
		 * get number active queue
		 * */
		public function activeNumber($locketId)
		{
			$queueHelper = new QueueHelper($locketId);
			if ($queueHelper->getLocketData()!==null){
				$service = $queueHelper->getServiceData()->makeRowArray();
				$queueHelper->setLastOutQueue();
				$lastOut = $queueHelper->getLastOutQueue()->makeRowArray();
				if ($lastOut!==null){
					echo json_encode(array(
						'status' => '200',
						'message' => 'antrian yang baru saja di panggil',
						'antrian' => $lastOut['antrian_nomor_aktif']
					));
				}else{
					echo json_encode(array(
						'status' => '200',
						'message' => 'belum ada antrian dipanggil',
						'antrian' => $service['layanan_awalan'].'-000'
					));

				}
			}else{
				echo json_encode(array(
					'status' => '200',
					'message' => 'loket tidak ada',
					'antrian' => '-000'
				));
			}

		}

		/*
		 * menghitung sisa antrian berdasarkan id loket dan status antrian
		 * */
		public function leftQueue($locketId)
		{
			$queueHelper  = new QueueHelper($locketId);
			$queueModel = new QueueModel();

			$serviceId = $queueHelper->getServiceId();
			$leftQueue = $queueModel->get(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status !=' => 'selesai',
				'date_format(antrian_date_created,"%Y-%m-%d")' =>  date('Y-m-d'),
			))->makeNumRows();

			echo json_encode(array(
				'status' => '200',
				'sisa_antrian' => $leftQueue,
				'message' => 'menampilkan sisa antrian pada layanan'
			));
		}


		// return Panggilan Service API
		public function getCall()
		{
			$dataCall = parent::model('service')->get_call_by_id(1);
			$number = str_pad($dataCall['panggilan_antrian'], 3, '0', STR_PAD_LEFT);

//			array_push($dataCall,'L'.$dataCall['panggilan_loket'].'-'.$number);
			echo json_encode(array(
				'status' => '200',
				'data' => $dataCall,
				'message' => 'menampilkan data panggilan',
			));
		}

		// menambah antrian per loket
		public function takeQueue($serviceId){
			$currentData = parent::model('service')->get_queue_by_service($serviceId);
			$switchedQueue  = parent::model('antrian')
				->get_switched_queue(array(
					'antrian_jenis_panggilan' => 'alihan',
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'menunggu'
				),'antrian_date_created','desc')->row_array();

			if ($currentData->num_rows() > 0){
				$waitQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'menunggu',
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'terusan'
				));
				$activeQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'aktif',
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'terusan'
				));

				$serviceQueue = $currentData->result_array();
				$total  = count($serviceQueue);
				$lastQueue = $serviceQueue[$total-1];

				// memeriksa antrian selanjutnya/menunggu
				if ($waitQueue->num_rows() <= 0) {
					if ($activeQueue->num_rows() > 0) {
						$dataQueue = array(
							'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
							'antrian_layanan_id' => $lastQueue['layanan_id'],
							'antrian_status' => 'menunggu'
						);
					} else {
						if ($switchedQueue!==null){
							// jika antrian aktif tidak ada
							$dataQueue = array(
								'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
								'antrian_layanan_id' => $lastQueue['layanan_id'],
								'antrian_status' => 'menunggu'
							);
						}else{
							// jika antrian aktif tidak ada
							$dataQueue = array(
								'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
								'antrian_layanan_id' => $lastQueue['layanan_id'],
								'antrian_status' => 'aktif'
							);
						}

					}
				} else {
					$dataQueue = array(
						'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
						'antrian_layanan_id' => $lastQueue['layanan_id'],
						'antrian_status' => 'menunggu'
					);
				}

				$insertQueue = parent::model('antrian')->post_antrian($dataQueue);

				if ($insertQueue > 0){
					$queueNumber = str_pad($dataQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
					$freshWaitQueue = parent::model('antrian')->get_join_where(array(
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					));
					echo json_encode(array(
						'status' => '200',
						'message' => 'berhasil mengambil antrian, silahkan menunggu',
						'antrian_nomor' => ucwords($lastQueue['layanan_awalan']).'-'.$queueNumber,
						'service_name' => $lastQueue['layanan_nama'],
						'left_queue' => $freshWaitQueue->num_rows()
					));
				}else{
					echo json_encode(array(
						'status' => '500',
						'message' => 'kesalahan operasi mengambil antrian',
						'antrian_nomor' => 0
					));
				}
			}else{
				// jika antrian berdasarkan layanan pada DB kosong
				if ($switchedQueue!==null){
					$dataQueue = array(
						'antrian_nomor' => 1,
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					);
				}else{
					$dataQueue = array(
						'antrian_nomor' => 1,
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'aktif'
					);
				}


				$insertQueue = parent::model('antrian')->post_antrian($dataQueue);
				// jika berhasil insert antrian aktif pertama
				if ($insertQueue > 0){
					$queueNumber = str_pad($dataQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
					$freshLocket = parent::model('layanan')->getOne(array('layanan_id' => $serviceId));
					$freshWaitQueue = parent::model('antrian')->get_join_where(array(
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					));
					echo json_encode(array(
						'status' => '200',
						'message' => 'berhasil mengambil antrian, silahkan menunggu',
						'antrian_nomor' => ucwords($freshLocket['layanan_awalan']).'-'.$queueNumber,
						'service_name' => $freshLocket['layanan_nama'],
						'left_queue' => $freshWaitQueue->num_rows()
					));
				}else{
					echo json_encode(array(
						'status' => '500',
						'message' => 'kesalahan operasi mengambil antrian',
						'antrian_nomor' => 0
					));
				}

			}
		}

		public function execKeyboard($key){
			$shortcut = new Shortcut();

			$data = $shortcut->get(array(
				'numpad' => $key
			))->makeRowArray();

			echo json_encode($data);
		}

		public function receiptPrint()
		{
			if (isset($_POST)){
				$queueNumber = parent::post('queue_number');
				$serviceName = parent::post('service_name');
				$leftQueue = parent::post('left_queue');

				$connector = new FilePrintConnector("php://stdout");
				$printer = new Printer($connector);

				/* Initialize */
				$printer -> initialize();

				/* Line feeds */
				$printer -> text($serviceName);
				$printer -> feed(7);
				$printer -> text($queueNumber);
				$printer -> feedReverse(3);
				$printer -> text("Sisa Antrian : ".$leftQueue);
				$printer -> feed();
				$printer -> cut();

				redirect('layanan/daftar');
			}
		}

		/*
		 * APIs
		 * */
		public function loket($locketId){
			$param = array(
				'loket_id' => $locketId
			);
			$loket = parent::model('loket')->getOne($param);
			echo json_encode(array(
				'status' => '200',
				'data' => $loket,
				'message' => 'menampilkan loket per id'
			));
		}

		public function layananApi($id = null){
			if ($id!== null){
				$locket = parent::model('layanan')->get_layanan_where(array(
					'layanan_id' =>  $id
				))->row_array();
			}elseif (isset($_GET)){
				$query  = array();
				foreach ($_GET as $key => $v){
					$query[$key] = $v;
				}
				$locket = parent::model('layanan')->get_layanan_where($query)->result_array();
			}else{
				$locket = parent::model('layanan')->get_layanan()->result_array();
			}

			echo json_encode(array(
				'status' => '200',
				'message' => 'menampilkan hasil request',
				'data' => $locket
			));
		}

		public function suaraApi($id = null){
			if ($id!== null){
				$locket = parent::model('service')->get_suara_where(array(
					'suara_id' =>  $id
				))->row_array();
			}elseif (isset($_GET)){
				$query  = array();
				foreach ($_GET as $key => $v){
					$query[$key] = $v;
				}
				$locket = parent::model('service')->get_suara_where($query)->result_array();
			}else{
				$locket = parent::model('service')->get_suara();
			}

			echo json_encode(array(
				'status' => '200',
				'message' => 'menampilkan hasil request',
				'data' => $locket
			));
		}

		public function getLastCall()
		{
			if ($this->input->is_ajax_request()){
				$data = $this->ED->get('call');
				if ($data!==null){
					echo $data;
				}else{
					$callData = $this->EM->get(array(
						'name' => 'call'
					))->makeRowArray();
					$this->ED->set('call',json_decode($callData['data'],true));
					$data =  $this->ED->get('call');
					echo $data;
				}
			}else{
				echo 'access forbidden';
			}
		}

		public function getLastRecall()
		{
			if ($this->input->is_ajax_request()){
				$data = $this->ED->get('recall');
				if ($data!== null){
					echo $data;
				}else{
					$callData = $this->EM->get(array(
						'name' => 'recall'
					))->makeRowArray();
					$this->ED->set('recall',json_decode($callData['data'],true));
					$data =  $this->ED->get('recall');
					echo $data;
				}
			}else{
				echo 'access forbidden';
			}
		}

		public function getLastRefresh()
		{
			if ($this->input->is_ajax_request()){
				$data = $this->ED->get('refresh');
				if ($data!== null){
					echo $data;
				}else{
					$callData = $this->EM->get(array(
						'name' => 'refresh'
					))->makeRowArray();
					$this->ED->set('refresh',json_decode($callData['data'],true));
					$data =  $this->ED->get('refresh');
					echo $data;
				}
			}else{
				echo 'access forbidden';
			}
		}

		public function saveKeyboard()
		{
			if (isset($_GET)){
				$code = parent::get('id');
				$info = parent::get('info');
				
				$keyboard = new KeyboardModel();

				$existKeyboard = $keyboard->get(
					array('code' => $code)
				)->makeRowArray();

				if ($existKeyboard !== null){
					echo 'keyboard sudah terdaftar';
				}else{
					$keyboard->insert(array(
						'code' => $code,
						'manufacture' => $info
					));

					echo 'berhasil menambahkan keyboard';
				}

			}else{
				show_404();
			}
		}
		public function keyboardCall()
		{
			if (isset($_GET)){
				$KE = new KeyEvent();

				$replace = str_replace('{','',$_GET['key']);
				$secondReplace = str_replace('}','',$replace);

				$keyboardArray = explode(',',$secondReplace);

				if ($keyboardArray[1] === 'Down'){

					$keyExists = $KE->get(array(
						'keyboard' => parent::get('path'),
						'code' => $keyboardArray[0]
					));
					if ($keyExists->makeNumRows() > 0){
						$keyEventRow = $keyExists->makeRowArray();

						$locketID = $keyEventRow['loket_id'];
						$type = $keyEventRow['type'];

						if ($type === 'call'){
							$queueService = new QueueService();
							$queueService->call($locketID);
						}else{
							$queueService = new QueueService();
							$queueService->recall($locketID);
						}
					}
				}
			}
		}

	}
