<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error400 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX ERROR 400
	* ----------------------------------------
	* View: errors/error_400
	*
	*/
    public function index()
    {
        $this->load->view('errors/error_400');
    }
}
