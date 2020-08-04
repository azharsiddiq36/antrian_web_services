<?php

class GLOBAL_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
        $this->load->database();
    }

    /*
     * helper untuk mempermudah proses yang berulang
     * metode insert,update,delete dibuat disini
     * get data yang berbeda juga disini
     * **/
    // get data
    public function get_array_of_table($table)
    {
        $query = $this->db->get($table);
        return $query->result_array($query);
    }

    public function get_object_of_table($table)
    {
        $query = $this->db->get($table);
        return $query;
    }

    /*
* dynamicly join 2 table or more
* you can see PembayaranModel for example
*/
    public function get_join_table($sourcetable, $jointable)
    {
        $this->db->select('*');
        $this->db->from($sourcetable['name']);
        for ($i = 0; $i < count($jointable['table']); $i++) {
            $this->db->join($jointable['table'][$i], $jointable['table'][$i] . '.' . $jointable['id'][$i] . ' = ' . $sourcetable['name'] . '.' . $sourcetable[0][$i]);
        }

        $query = $this->db->get();
        return $query;
    }

    public function get_array_of_row($table, $query)
    {
        $sql = $this->db->get_where($table, $query);
        return $sql->row_array();
    }

    public function get_object_of_row($table, $query,$order =array())
    {
    	if (!empty($order)){
//    		for ($i =0;$i< count($order);$i++){
//				$this->db->order_by($order[$i]['column'],$order[$i]['order']);
//			}
    		foreach ($order as $item => $value){
				$this->db->order_by($item,$value);
			}
			$sql = $this->db->get_where($table, $query);
			return $sql;
		}
        $sql = $this->db->get_where($table, $query);
        return $sql;
    }

    //insert
    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function insert_with_status($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    // update
    public function update_table($table, $key, $value, $data)
    {
        $this->db->where($key, $value);
        $this->db->update($table, $data);
    }

    public function update_table_with_status($table, $key, $value, $data)
    {
        $this->db->where($key, $value);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    // delete
    public function delete_row($table, $query)
    {
        return $this->db->delete($table, $query);
    }

    public function delete_row_with_status($table, $query)
    {
        $this->db->delete($table, $query);
        return $this->db->affected_rows();
    }

    // specific condition
	public function _ODB()
	{
		return $this->db;
	}

}
