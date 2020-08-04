<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Service extends Database
{
	public $table = 'tbl_layanan';

	private $property = array(
		'id' => 'layanan_id',
		'date_create' => 'layanan_date_created'
	);

	public function __construct()
	{
		parent::__construct($this->table, $this->property);
	}
}
