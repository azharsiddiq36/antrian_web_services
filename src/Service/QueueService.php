<?php


namespace Antrian\Service;

use Antrian\helper\QueueHelper;
use Antrian\models\Queue;
use Antrian\models\Service;
use AppEvent\EventData;

class QueueService
{

	private $queue;

	private $eventData;

	private $service;

	public function __construct()
	{
		$this->queue = new Queue();
		$this->eventData = new EventData();
		$this->service = new Service();
	}

	public function call($locketId)
	{
		$qh = new QueueHelper($locketId);

		if ($qh->isEmptyQueue($qh->getFirstInQueue())){
			$this->onFirstQueueEmpty($qh);
		}else{
			$this->onFirstQueueExist($qh);
		}

	}

	public function recall($locketId)
	{
		$queueHelper = new QueueHelper($locketId);
		$queueHelper->setLastOutQueue();
		if ($queueHelper->isEmptyQueue($queueHelper->getLastOutQueue())){
			$this->onLastQueueEmpty($queueHelper);
		}else{
			$this->onLastQueueExist($queueHelper);
		}

	}

	public function onFirstQueueExist(QueueHelper $queueHelper)
	{
		$firstIn = $queueHelper->getFirstInQueue();
		//change all active queue to complete (Call Process)
		if ($this->queue->setFirstToComplete($queueHelper)){
			// if call process is success, fire some event
			$queueArray = $firstIn->makeRowArray();
			$queueData = $this->queue->find($queueArray['antrian_id'])->makeRowArray();
			$serviceData = $this->service->find($queueHelper->getServiceId())->makeRowArray();
			$callData = array(
				'audio' => $serviceData,
				'locket' => $queueHelper->getLocketData(),
				'data' => $queueData
			);
			$this->eventData->fire('call',$callData);

			// next step is get firstIn queue in table after active queue has set to complete
			$this->queue->setFirstIn($queueHelper->getServiceId());

			if (!$queueHelper->isEmptyQueue($this->queue->getFirstIn())){
				$nextQueue = $this->queue->getFirstIn()->makeRowArray();
				$this->queue->setNextToActive($nextQueue['antrian_id']);
			}

			// set json output to API, last called queue as callData
			$activeQueue = $firstIn->makeRowArray();
			$queueHelper->jsonOutput('200','berhasil memanggil antrian',$activeQueue,array(
				'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT)
			));

		}else{
			// fail update data on server
			$queueHelper->jsonOutput('500','kesalahan operasi antrian');
		};
	}

	public function onFirstQueueEmpty(QueueHelper $qh)
	{
		$qh->jsonOutput('404','belum ada antrian pada loket tersebut',array(),array(
			'antrian' => '000'
		));
	}

	public function onLastQueueExist(QueueHelper $queueHelper)
	{
		$queueArray = $queueHelper->getLastOutQueue()->makeRowArray();
		$queueData = $this->queue->find($queueArray['antrian_id'])->makeRowArray();
		$serviceData = $this->service->find($queueHelper->getServiceId())->makeRowArray();
		$recallData = array(
			'audio' => $serviceData,
			'locket' => $queueHelper->getLocketData(),
			'data' => $queueData
		);
		$this->eventData->fire('recall',$recallData);
		$queueHelper->jsonOutput('200','menampilkan nomor recall yang terakhir kali dipanggil di loket',$queueArray,array(
			'antrian' => ucwords($queueArray['layanan_awalan']).'-'.str_pad($queueArray['antrian_nomor'], 3, '0', STR_PAD_LEFT),
			'update'  => 1
		));
	}

	public function onLastQueueEmpty(QueueHelper $queueHelper)
	{
		$queueHelper->jsonOutput('404','belum ada antrian pada loket',array(),array(
			'antrian' => str_pad(0, 3, '0', STR_PAD_LEFT),
			'update' => 0
		));
	}
}
