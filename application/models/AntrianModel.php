<?php
	
	class AntrianModel extends  GLOBAL_Model {

       public function __construct()
        {
            parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
		}
        public function initTable(){
            return "tbl_antrian";
        }
        public function get_user($query)
		{
			return parent::_ODB()->get_where('auth',$query);
		}
        public function get_join_antrian()
		{
			$this->db->select('*');
			$this->db->from($this->initTable());
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d H:i:s'));
			$this->db->join('tbl_loket', 'tbl_loket.loket_id = tbl_antrian.antrian_loket_id');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor','desc');
			$this->db->limit(5);
			$query = $this->db->get();
			return $query;
		}
		public function get_join_where($query)
		{
			$query['date_format(antrian_date_created,"%Y-%m-%d")'] =date('Y-m-d');
			$this->db->select('*');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor', 'desc');
			return $this->db->get_where('tbl_antrian',$query);
		}
		public function get_switched_queue($query,$orderParam,$sort = 'asc')
		{
			$query['date_format(antrian_date_created,"%Y-%m-%d")'] =date('Y-m-d');
			$this->db->select('*');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by($orderParam, $sort);
			return $this->db->get_where('tbl_antrian',$query);
		}
        public function get_antrian()
		{
			return parent::get_object_of_table($this->initTable());
		}
		public function get_loket()
		{
			$this->db->select('*');
			$this->db->from('tbl_loket');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_loket.loket_layanan_id');
			$query = $this->db->get();
			return $query;
		}
		public function post_antrian($data){
            return parent::insert_with_status($this->initTable(),$data);
        }
        public function getOne($param){
            return parent::get_array_of_row($this->initTable(),$param);
        }
        public function editantrian($id,$data){
            return parent::update_table($this->initTable(),"antrian_id",$id,$data);
        }
        public function editby_pengguna($id,$data){
            return parent::update_table($this->initTable(),"antrian_id",$id,$data);
        }
        public function deleteantrian($data){
            return parent::delete_row($this->initTable(),$data);
        }
		public function getActive($layanan){
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->where('antrian_layanan_id',$layanan);
			$this->db->where('antrian_status','aktif');
			$this->db->limit(1);
			$this->db->order_by('antrian_id','desc');
			$query = $this->db->get();
			return $query;
		}
		public function getWaiting($layanan){
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->where('antrian_layanan_id',$layanan);
			$this->db->where('antrian_status','menunggu');
			$this->db->order_by('antrian_id','desc');
			$query = $this->db->get();
			return $query;
		}
		public function getLastCall($loket){
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->where('antrian_loket_id',$loket);
			$this->db->where('antrian_status','selesai');
			$this->db->limit(1);
			$this->db->order_by('antrian_id','desc');
			$query = $this->db->get();
			return $query;
		}
    }