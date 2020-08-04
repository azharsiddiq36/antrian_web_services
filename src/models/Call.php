<?php


namespace Antrian\models;


use Antrian\helper\Database;
use Antrian\helper\QueueHelper;

class Call extends Database
{
	private $table = 'tbl_panggilan';

	private $property = array(
		'id' => 'panggilan_id',
		'date_create' => 'panggilan_date_created'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}
}
