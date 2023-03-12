<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NoConnection extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX NO CONNECTION
	* ----------------------------------------
	* View: errors/no_connection
	*
	*/
    public function index()
    {
        $this->load->view('errors/no_connection');
    }
}
