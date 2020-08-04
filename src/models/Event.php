<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Event extends Database
{
	private $table = 'event';

	private $property = array(
		'id' => 'id',
		'date_create' => 'create_at'
	);

	public function __construct()
	{
		parent::__construct($this->table, $this->property);
	}
}
