<?php

	namespace AppEvent;

	use Sse\SSE;
	use Sse\Data;

	use Antrian\models\Event as EventModel;

	class EventData{
		private $data;

		private $event;

		public function __construct()
		{
			$this->data = new Data('file',array('path' => './data'));
			$this->event = new EventModel();
		}

		public function fire($event,$data)
		{
			if (!array_key_exists('time',$data)){
				$data['time'] = time();
			}
			$this->event->update(array(
				'name' => $event
			),array(
				'data' => json_encode($data)
			));
			$this->data->set($event,json_encode($data));
		}

		public function set($key,$data)
		{
			$this->data->set($key,json_encode($data));
		}

		public function get($key)
		{
			return $this->data->get($key);
		}

	}

