<?php
/**
 * Created by PhpStorm.
 * User: azhar
 * Date: 10/12/19
 * Time: 22:10
 */

class Socket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");

		$this->load->add_package_path(FCPATH.'vendor/romainrg/ratchet_client');
		$this->load->library('ratchet_client');
		$this->load->remove_package_path(FCPATH.'vendor/romainrg/ratchet_client');

		$this->ratchet_client->set_callback('auth', array($this, '_auth'));
		$this->ratchet_client->set_callback('event', array($this, '_event'));

		// Run server
		$this->ratchet_client->run();
    }

    public function index()
    {

    }

	public function _auth($datas = null)
	{
		// Here you can verify everything you want to perform user login.
		// However, method must return integer (client ID) if auth succedeed and false if not.
		return (!empty($datas->user_id)) ? $datas->user_id : false;
	}

	public function _event($datas = null)
	{
		// Here you can do everyting you want, each time message is received
		echo 'Hey ! I\'m an EVENT callback'.PHP_EOL;
	}


}
