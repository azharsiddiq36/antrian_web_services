<?php
	
	class LoketModel extends  GLOBAL_Model {

        public function __construct()
        {
            parent::__construct();

        }
        public function initTable(){
            return "tbl_loket";
        }
        public function get_loket()
		{
			return parent::get_object_of_table($this->initTable());
		}
		public function post_loket($data){
            return parent::insert_data($this->initTable(),$data);
        }
        public function getOne($param){
            return parent::get_array_of_row($this->initTable(),$param);
        }
        public function editloket($id,$data){
            return parent::update_table_with_status($this->initTable(),"loket_id",$id,$data);
        }
        public function editby_pengguna($id,$data){
            return parent::update_table($this->initTable(),"loket_id",$id,$data);
        }
        public function deleteloket($data){
            return parent::delete_row($this->initTable(),$data);
        }
        public function getJoinLoket(){
            $this->db->select('*');
            $this->db->from($this->initTable());
            $this->db->join('tbl_layanan', 'tbl_loket.loket_layanan_id = tbl_layanan.layanan_id');
            $query = $this->db->get();
            return $query;
        }
		public function getJoinLoketById($locketId){
			$this->db->select('*');
			$this->db->from($this->initTable());
			$this->db->join('tbl_layanan', 'tbl_loket.loket_layanan_id = tbl_layanan.layanan_id');
			$this->db->where('loket_id',$locketId);
			$query = $this->db->get();
			return $query;
		}
        public function get_by_layanan($id){
            $this->db->select('*');
            $this->db->from($this->initTable());
			$this->db->join('tbl_layanan', 'tbl_loket.loket_layanan_id = tbl_layanan.layanan_id');
			$this->db->where('loket_layanan_id',$id);
            $query = $this->db->get();
            return $query;
        }
        public function getJoinLocketWhere($query)
		{
			$this->db->join('tbl_layanan', 'tbl_loket.loket_layanan_id = tbl_layanan.layanan_id');
			return $this->db->get_where('tbl_loket',$query);
		}
    }
