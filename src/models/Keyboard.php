<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Keyboard extends Database
{
	private $table = 'keyboard';

	private $property = array(
		'id' => 'id',
		'date_create' => 'create_at'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}
}
