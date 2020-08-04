<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Shortcut extends Database
{
	private $table = 'shortcut';

	private $property = array(
		'id' => 'id',
		'date_create' => 'create_at'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}
}
