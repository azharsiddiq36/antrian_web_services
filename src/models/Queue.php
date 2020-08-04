<?php


	namespace Antrian\models;


	use Antrian\helper\Database;
	use Antrian\helper\QueueHelper;

	class Queue extends Database
	{
		public $table = 'tbl_antrian';

		private $firstIn;

		private $locket;

		private $property = array(
			'id' => 'antrian_id',
			'date_create' => 'antrian_date_created'
		);

		public function __construct()
		{
			parent::__construct($this->table, $this->property);
			$this->locket = new Locket();
		}

		public function getFirstIn()
		{
			return $this->firstIn;
		}

		public function setFirstIn($serviceId)
		{
			$this->firstIn = parent::join(
				array(
					'tbl_layanan' => 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id'
				),
				array(
					'antrian_layanan_id' => $serviceId,
					'antrian_status !=' => 'selesai',
					'date_format(antrian_date_created,"%Y-%m-%d")' =>  date('Y-m-d'),
				),array(
					'antrian_date_created' => 'ASC',
				)
			);
		}

		public function setFirstToComplete(QueueHelper $queueHelper)
		{
			$queue = $queueHelper->getFirstInQueue()->makeRowArray();
			if ($queue['antrian_jenis_panggilan'] === 'alihan'){
				$activeNumber = $queue['antrian_nomor_alihan'];
			}else{
				$activeNumber =  $queue['layanan_awalan'].'-'.str_pad($queue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
			}
			$this->locket->update(array(
				'loket_id' => $queueHelper->getLocketId()
			),array(
				'loket_waktu_panggilan' => date('Y-m-d H:i:s')
			));
			return parent::update(array(
				'antrian_id' => $queue['antrian_id']
			), array(
				'antrian_loket_id' => $queueHelper->getLocketId(),
				'antrian_nomor_aktif' => $activeNumber,
				'antrian_status' => 'selesai'
			));
		}

		public function setNextToActive($queueId)
		{
			return parent::update(array(
				'antrian_id' => $queueId
			),array(
				'antrian_status' => 'aktif'
			));
		}

	}
