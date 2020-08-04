<?php
/**
 * Created by PhpStorm.
 * User: azhar
 * Date: 10/12/19
 * Time: 22:10
 */

class AntrianController extends GLOBAL_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('AntrianModel');
        $this->load->model('LoketModel');
        $this->load->model('LayananModel');
    }

    public function index()
    {
        $data['title'] = 'Aplikasi Antrian';
        $data['layanan'] = parent::model('LayananModel')->get_layanan();
        $data['loket'] = parent::model('LoketModel')->getJoinLoket()->result_array();
        $data['page_title'] = 'Aplikasi Antrian';
        $data['waktu'] = date('h:i');
        parent::authPage('antrian/index',$data);
    }

    public function layanan()
    {
        $response = null;
        $data = $this->LayananModel->get_layanan();
        $response['status'] = 200;
        $response['message'] = "Berhasil Memuat Data";
        $response['data'] = $data->result_array();
        echo json_encode($response);
    }
    public function getCount(){
        $id = $this->uri->segment(2);
        $date = date('Y-m-d');
        $total = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
        return $total;
    }
    public function countLocket(){
        $response = null;
        $count = $this->LoketModel->getJoinLoket();
        $response['status'] = 200;
        $response['message'] = 'Berhasil Memuat Data';
        $response['data'] = $count->result_array();
        $response['total'] = $count->num_rows();
        echo json_encode($response);
    }
    public function sekarang(){
        $response = null;
        $id = $this->input->post('loket_id');
        $date = date('Y-m-d');
        $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
        $response['status'] = 200;
        if ($sekarang->num_rows()<1){
            $response['message'] = 'Antrian Masih Kosong';
            $response['sekarang'] = 0;
        }
        else{
            $response['message'] = 'Berhasil Memuat Data';
            $response['sekarang'] = $sekarang->row_array();
        }
        echo json_encode($response);
    }

    public function sisa(){
        $response = null;
        $id = $this->input->post('loket_id');

        $date = date('Y-m-d');
        $sisa = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
        $response['status'] = 200;
        if ($sisa<1){
            $response['message'] = 'Antrian Masih Kosong';
            $response['sisa'] = 0;
        }
        else{
            $response['message'] = 'Berhasil Memuat Data';
            $response['sisa'] = $sisa;
        }
        echo json_encode($response);
    }
    public function antrian()
    {
        $response = null;
        $id = $this->input->post('loket_id');

        $date = date('Y-m-d');
        $data = $this->AntrianModel->getByLayanan($id, $date);

//        $data = $this->AntrianModel->getByLayanan($id, $date);
            $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
            if ($data->num_rows() <= 0) {
                //$this->addQueue($id,$data->num_rows());
                $response['status'] = "400";
                $response['message'] = "Antrian Belum Ada";
            } else {
                $response['status'] = 200;
                $response['message'] = "Berhasil Memuat Data";
                $response['data'] = $data->result_array();
                $response['sekarang'] = $sekarang->row_array();
                $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
                //$this->addQueue($id,1);
            }
        echo json_encode($response);
    }

    public function call()
    {
        $response = null;
        $id = $this->input->post('loket_id');
        $date = date('Y-m-d');
        $data = $this->AntrianModel->getByLoket($id, $date);
        $sekarang = $this->AntrianModel->getCurrentNumber($id, $date)->row_array();
        if ($data) {
            if ($data->num_rows() <= 0) {
                $response['status'] = "400";
                $response['message'] = "Antrian Belum Ada";
            } else {
                $getnextid = $this->AntrianModel->getFirstWait($id, $date)->row_array();
                if ($getnextid != null){
                    $update = array("antrian_status" => 'selesai');
                    $this->AntrianModel->editantrian($sekarang['antrian_id'], $update);
                    $update = array("antrian_status" => 'aktif');
                    $this->AntrianModel->editantrian($getnextid['antrian_id'], $update);
                    $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
                    $response['status'] = 200;
                    $response['message'] = "Nomor Antrian Sudah Habis";
                    $response['sekarang'] = $sekarang->row_array();
                    $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                    $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
                }
                else{
                    $response['status'] = 403;
                    $response['message'] = "Antrian Berikutnya Belum Tersedia";
                }

            }
        }
        else{
            $response['status'] = 403;
            $response['message'] = "Antrian Berikutnya Belum Tersedia";
        }
        echo json_encode($response);
    }

    public function recall()
    {
        $response = null;
        $id = $this->input->post('loket_id');
        $date = date('Y-m-d');
        $data = $this->AntrianModel->getByLoket($id, $date);
        $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
        if ($data->num_rows() <= 0) {
            $response['status'] = "400";
            $response['message'] = "Antrian Belum Ada";
        } else {
            $response['status'] = 200;
            $response['message'] = "Berhasil Memuat Data";
            $response['sekarang'] = $sekarang->row_array();
            $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
            $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
        }
        echo json_encode($response);
    }
    public function tambah(){
        $response = null;
        $param = $this->input->post('loket_id');
        $id = explode('@',$param);
        //$id[0] untuk id loket, $id[1] untuk id layanan

        $date = date('Y-m-d');
        $antrian= $this->AntrianModel->getByLoket($id[0], $date);
        $total = $antrian->num_rows();
        $nomor = null;
        $status = 'menunggu';
        if ($total <1){
            $nomor = 1;
            $status = 'aktif';
        }
        else{
            $antrian = $this->AntrianModel->getByLoket($id[0],$date)->row_array();
            $nomor = $antrian['antrian_nomor']+1;
        }

        $data = array("antrian_nomor"=>$nomor,
            "antrian_loket_id"=>$id[0],
            "antrian_status" => $status,
            "antrian_layanan_id"=>$id[1]);
        $this->AntrianModel->post_antrian($data);
        $response['status'] = 200;
        $response['message'] = "Berhasil Menambahkan Antrian";
        echo json_encode($response);
    }

    public function errorhandling()
    {
        echo 'Layanan tidak tersedia';
    }

}
