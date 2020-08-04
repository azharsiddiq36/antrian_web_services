<?php
	class DevicesController extends GLOBAL_Controller{

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
			if ($this->session->has_userdata('layanan')){
				$data['title'] = 'Aplikasi Antrian';
				$data['page_title'] = 'Aplikasi Antrian';
				$data['layanan'] = parent::model('layanan')
					->get_layanan()
					->result_array();
				$data['layananSelected'] = parent::model('layanan')->get_layanan_where(array(
					'layanan_id' => $this->session->userdata('layanan')
				))->row_array();
				$data['session'] = array(
					'layanan' => $this->session->userdata('layanan'),
					'loket' => $this->session->userdata('loket'),
					'alternatif' => $this->session->userdata('alternatif'),
				);
				$data['alternatif'] = parent::model('loket')->getJoinLocketWhere(array(
					'loket_id' => $data['session']['alternatif']
				))->row_array();
				$data['callData'] = array(
					'leftQueue' =>$this->getLeftQueue($data['session']['loket']),
					'activeQueue' => $this->getActiveNumber($data['session']['loket'])['text'],
					'activeQueueData' => $this->getActiveNumber($data['session']['loket'])['data']
				);
//				parent::cek_array($data['callData']['activeQueueData']);
				parent::authPage('devices/index',$data);
			}else{
				redirect('devices/registration');
			}
		}

		public function registration()
		{
			if (isset($_POST['masuk'])){
				$sessionData = array(
					'layanan' => parent::post('layanan'),
					'loket' => parent::post('loket'),
					'alternatif' => parent::post('alternatif')
				);
				$this->session->set_userdata($sessionData);
				redirect('devices');

			}else{
				$data['title'] = 'Aplikasi Antrian';
				$data['page_title'] = 'Aplikasi Antrian';
				$data['layanan'] = parent::model('layanan')
					->get_layanan()
					->result_array();
				parent::authPage('devices/registration',$data);
			}
		}

		public function getLeftQueue($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));
			$serviceId = $locketData['loket_layanan_id'];
			$activeQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status' => 'aktif'
			));

			$leftQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status' => 'menunggu'
			));

			if ($leftQueue->num_rows() > 0){
				$sisaAntrian = $activeQueue->num_rows()+$leftQueue->num_rows();
			}else{
				$sisaAntrian = $activeQueue->num_rows();
			}

			return $sisaAntrian;
		}

		public function getActiveNumber($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));

			$serviceId = $locketData['loket_layanan_id'];
			$serviceData = parent::model('layanan')->get_layanan_where(array(
				'layanan_id' => $serviceId
			))->row_array();

			$completeQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_loket_id' => $locketId,
				'antrian_status' => 'selesai'
			));

			$switchedQueue  = parent::model('antrian')
				->get_switched_queue(array(
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'selesai'
				),'antrian_date_created','desc');

			if ($switchedQueue->num_rows() > 0){
				$complete = $switchedQueue->row_array();

				return array(
					'text' => $complete['antrian_nomor_aktif'],
					'data' => $complete
				);
			}else{
				return array(
					'text' => ucwords($serviceData['layanan_awalan']).'-000',
					'data' => null
				);
			}

		}

	}
