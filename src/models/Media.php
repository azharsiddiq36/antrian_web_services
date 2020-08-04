<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Media extends Database
{
	private $table = 'media';

	private $property = array(
		'id' => 'id',
		'date_create' => 'create_at'
	);

	public function __construct()
	{
		parent::__construct($this->table,$this->property);
	}
}
