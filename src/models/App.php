<?php


namespace Antrian\models;


use Antrian\helper\Database;

class App extends Database
{
	private $table = 'tbl_app';

	private $property = array(
		'id' => 'app_id',
		'date_create' => 'app_date_created'
	);

	public function __construct()
	{
		parent::__construct($this->table, $this->property);
	}
}
