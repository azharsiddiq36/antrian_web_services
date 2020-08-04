<?php


namespace Antrian\models;


use Antrian\helper\Database;

class KeyEvent extends Database
{
	private $table = 'keyboard_event';

	private $property = array(
		'id' => 'id',
		'date_create' => 'create_at'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}
}
