<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {
	function __construct() 
    {
        parent::__construct();

        if (!$this->session->has_userdata('email')) {
            redirect("login");
        }
    }


	public function index()
	{
		$this->load->view('main');
	}
}
