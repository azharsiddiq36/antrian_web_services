<?php

	namespace AppEvent;

	use Sse\Event;

	class CallEvent implements Event{

		private $cache = '';
		private $callData;
		private $callStorage;

		public function __construct($call)
		{
			$this->callStorage = $call;
		}

		/**
		 * Check for continue to send event.
		 *
		 * @return bool
		 */
		public function check()
		{
			$this->callData = $this->callStorage['name'];

			if ($this->callData !== $this->cache){
				$this->cache = $this->callData;
				return true;
			}

			return false;
		}

		/**
		 * Get Updated Data.
		 *
		 * @return string
		 */
		public function update()
		{
			return json_encode($this->callStorage);
		}
	}




