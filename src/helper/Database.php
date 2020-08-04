<?php


namespace Antrian\helper;


use Antrian\models\Locket;
use phpDocumentor\Reflection\Types\Array_;

class Database extends \GLOBAL_Model
{
	private $table;

	private $property;

	private $object;

	public function __construct($table,array $property)
	{
		parent::__construct();
		$this->property = $property;
		$this->table = $table;
	}

	public function setObject(Database $db)
	{
		$this->object = $db;
	}

	/**
	 * @author bagussjm
	 * @param $query
	 * @return $this
	 * @version 1.0.0
	 */

	public function get($query = array(),$order = array())
	{
		if (!empty($query)){
			$this->object =  parent::get_object_of_row($this->table,$query,$order);
			return $this;
		}
		$this->object =  parent::get_object_of_table($this->table);
		return $this;
	}

	public function join($join,$query = array(),$order = array())
	{
		if (!empty($query) || !empty($order)){
			foreach ($join as $item => $value):
				$this->db->join($item,$value);
			endforeach;
			foreach ($order as $item => $value):
				$this->db->order_by($item,$value);
			endforeach;
			$this->object =  $this->db->get_where($this->table,$query);
			return $this;
		}
		foreach ($join as $item):
			$this->db->join($item['table'],$item['relation']);
		endforeach;
		$this->object =  $this->db->get_where($this->table,$query);
		return $this;
	}

	/**
	 * @param $id
	 * @return $this
	 */

	public function find($id)
	{
		$query = array(
			$this->property['id'] => $id
		);
		$this->object = parent::get_object_of_row($this->table,$query);
		return $this;
	}

	public function insert($data)
	{
		return parent::insert_with_status($this->table,$data);
	}

	public function update($query,$update)
	{
		foreach ($query as $item => $value){
			$this->db->where($item,$value);
		}
		$this->db->update($this->table,$update);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		return parent::delete_row_with_status($this->table,array(
			'id' => $id
		));
	}

	public function makeResultArray()
	{
		return $this->object->result_array();
	}

	public function makeRowArray()
	{
		return $this->object->row_array();
	}

	public function makeNumRows()
	{
		return $this->object->num_rows();
	}

	public function status()
	{
		return $this->object->affected_rows();
	}

}
