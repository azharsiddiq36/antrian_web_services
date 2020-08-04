<?php


namespace Antrian\helper;


use Antrian\models\Locket;
use Antrian\models\Queue;
use Antrian\models\Service;

class QueueHelper extends \GLOBAL_Model
{

	private $locketId;

	private $serviceId;

	private $locket;

	private $queue;

	private $service;

	private $locketData;

	private $queueData;

	private $serviceData;

	private $firstInQueue;

	private $lastOutQueue;

	public function __construct($locketId)
	{
		parent::__construct();
		$this->locketId = $locketId;
		$this->locket = new Locket();
		$this->queue = new Queue();
		$this->service = new Service();

		$this->setLocketData();
		$this->setFirstInQueue();
	}

	public function getLocketId()
	{
		return $this->locketId;
	}

	/**
	 * @return mixed
	 */
	public function getServiceData()
	{
		return $this->serviceData;
	}

	/**
	 * @param mixed $serviceData
	 */
	public function setServiceData()
	{
		$this->serviceData = $this->service->find($this->serviceId);
	}

	public function getLocketData()
	{
		return $this->locketData;
	}

	public function setLocketData()
	{
		$this->locketData = $this->locket->get(array(
			'loket_id' => $this->locketId
		))->makeRowArray();
		$this->setServiceId();
		$this->setServiceData();
	}

	public function setServiceId()
	{
		$this->serviceId = $this->locketData['loket_layanan_id'];
	}

	public function getServiceId()
	{
		return $this->serviceId;
	}

	public function setFirstInQueue()
	{
		$this->firstInQueue = $this->queue->join(
			array(
				'tbl_layanan' => 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id'
			),
			array(
				'antrian_layanan_id' => $this->serviceId,
				'antrian_status !=' => 'selesai',
				'date_format(antrian_date_created,"%Y-%m-%d")' =>  date('Y-m-d'),
			),array(
				'antrian_date_created' => 'ASC',
		));
	}

	public function getFirstInQueue()
	{
		return $this->firstInQueue;
	}

	/**
	 * @return mixed
	 */
	public function getLastOutQueue()
	{
		return $this->lastOutQueue;
	}

	/**
	 * @param mixed $lastOutQueue
	 */
	public function setLastOutQueue()
	{
		$this->lastOutQueue = $this->queue->join(
			array(
				'tbl_layanan' => 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id'
			),
			array(
				'antrian_loket_id' => $this->locketId,
				'antrian_status =' => 'selesai',
				'date_format(antrian_date_created,"%Y-%m-%d")' =>  date('Y-m-d'),
			),array(
			'antrian_date_created' => 'DESC',
		));
	}



	public function isEmptyQueue(Database $obj)
	{
		if ($obj->makeNumRows() <=0 ){
			return true;
		}
		return false;
	}

	public function jsonOutput($status,$message,$data = array(),$extra = array())
	{
		$data = array(
			'status' => $status,
			'message' => $message,
			'data'  => $data
		);
		if (!empty($extra)){
			foreach ($extra as $key => $value){
				$data[$key]  = $value;
			}
		}
		echo json_encode($data);
	}

}
