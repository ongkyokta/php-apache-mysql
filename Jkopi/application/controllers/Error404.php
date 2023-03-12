<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error404 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX ERROR 404
	* ----------------------------------------
	* View: errors/error_404
	*
	*/
    public function index()
    {
        $this->load->view('errors/error_404');
    }
}
