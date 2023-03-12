<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error500 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX ERROR 500
	* ----------------------------------------
	* View: errors/error_500
	*
	*/
    public function index()
    {
        $this->load->view('errors/error_500');
    }
}
