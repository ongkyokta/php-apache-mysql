<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error504 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX ERROR 504
	* ----------------------------------------
	* View: errors/error_504
	*
	*/
    public function index()
    {
        $this->load->view('errors/error_504');
    }
}
