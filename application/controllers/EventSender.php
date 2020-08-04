<?php

	use Sse\SSE;
	use Sse\Data;
	use Sse\Event;
	use AppEvent\CallEvent;
	use AppEvent\EventData;
	use Antrian\models\Locket;
	use Antrian\models\Queue;
	use Antrian\Service\QueueService;
	use Antrian\helper\Database;

	class EventSender extends GLOBAL_Controller{
		private $ed;
		private $locket;
		private $queue;
		private $qs;
		public function __construct()
		{
			parent::__construct();
			$this->ed = new EventData();
			$this->locket = new Locket();
			$this->queue = new Queue();
			$this->qs= new QueueService();

			$this->load->model('AntrianModel','antrian');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('LayananModel','layanan');
			$this->load->model('ServiceModel','service');
			$this->load->model('ComponentModel','component');
		}

		public function broadcast()
		{
			$data = new QueueService();
			$data->call(11);
		}

		public function getCallUpdated()
		{
			return parent::model('service')->get_call_by_id(1);
		}

	}
