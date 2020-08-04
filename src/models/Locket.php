<?php


namespace Antrian\models;

use Antrian\helper\Database;


class Locket extends Database
{
	public $table = 'tbl_loket';

	private $property = array(
		'id' => 'loket_id',
		'date_create' => 'loket_date_created'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}


}
