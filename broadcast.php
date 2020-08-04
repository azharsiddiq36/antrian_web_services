<?php

	require __DIR__.'/vendor/autoload.php';

	use AppEvent\EventData;
	use Sse\Data;
	use Sse\Event;
	use Sse\SSE;


// Create a libSSE data instance, which is shared across all data instances
	// in all PHP scripts. This allows easy cross-script communications for some of
	// the magic we done here.
	$data = new Data('file', array('path' => './data'));

//	var_dump(json_decode()));exit();

	// Create the main instances
	$sse = new SSE();

	// This event handler checks for new users and broadcast
	// the message to all clients.
	class Call implements Event {
		private $cache = 0;
		private $data;
		private $storage;

		public function __construct($data) {
			$this->storage = $data;
		}

		public function update(){
			return json_encode($this->data);
		}

		public function check(){
			// Fetch data from the data instance
			$this->data = json_decode($this->storage->get('call'));

			// And check if it's a new message by comparing its time
			if($this->data->time !== $this->cache){
				$this->cache = $this->data->time;
				return true;
			}

			return false;
		}
	};

	class Recall implements Event {
		private $cache = 0;
		private $data;
		private $storage;

		public function __construct($data) {
			$this->storage = $data;
		}

		public function update(){
			return json_encode($this->data);
		}

		public function check(){
			// Fetch data from the data instance
			$this->data = json_decode($this->storage->get('recall'));

			// And check if it's a new message by comparing its time
			if($this->data->time !== $this->cache){
				$this->cache = $this->data->time;
				return true;
			}

			return false;
		}
	};

	class Refresh implements Event {
		private $cache = 0;
		private $data;
		private $storage;

		public function __construct($data) {
			$this->storage = $data;
		}

		public function update(){
			return json_encode($this->data);
		}

		public function check(){
			// Fetch data from the data instance
			$this->data = json_decode($this->storage->get('refresh'));

			// And check if it's a new message by comparing its time
			if($this->data->time !== $this->cache){
				$this->cache = $this->data->time;
				return true;
			}

			return false;
		}
	};

	// A 30 second time limit can prevent running out of resources quickly.
	$sse->exec_limit = 30;

	// Add the event handlers, if an empty name is given as the event name,
	// it means trigger the default message event on the client.
	$sse->addEventListener('call', new Call($data));

	$sse->addEventListener('recall',new Recall($data));

	$sse->addEventListener('refresh',new Refresh($data));
	// Finally, start the loop.
	$sse->start();
