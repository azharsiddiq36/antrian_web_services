<?php
	
	class LayananModel extends  GLOBAL_Model {

        public function __construct()
        {
            parent::__construct();

        }
        public function initTable(){
            return "tbl_layanan";
        }
        public function get_layanan()
		{
			return parent::get_object_of_table($this->initTable());
		}
		public function post_layanan($data){
            return parent::insert_data($this->initTable(),$data);
        }
        public function getOne($param){
            return parent::get_array_of_row($this->initTable(),$param);
        }
        public function editlayanan($id,$data){
            return parent::update_table($this->initTable(),"layanan_id",$id,$data);
        }
        public function editby_pengguna($id,$data){
            return parent::update_table($this->initTable(),"layanan_id",$id,$data);
        }
        public function deletelayanan($data){
            return parent::delete_row($this->initTable(),$data);
        }
        public function getByLayanan($id){
            $this->db->select('*');
            $this->db->from($this->initTable());
            $this->db->where('layanan_layanan_id',$id);
            $query = $this->db->get();
            return $query;
        }
        public function edit_setting_tombol($id,$dataEdit){
        	return parent::update_table('tbl_setting','setting_id',$id,$dataEdit);
		}

		public function get_layanan_where($query){
        	return $this->db->get_where('tbl_layanan',$query);
		}
    }
