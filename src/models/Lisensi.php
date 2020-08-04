<?php


namespace Antrian\models;


use Antrian\helper\Database;

class Lisensi extends Database
{
	private $table = 'lisensi';

	private $property = array(
		'id' => 'id_lisensi',
		'date_create' => 'tanggal_aktivasi'
	);

	public function __construct()
	{
		parent::__construct($this->table, $this->property);
	}
}
