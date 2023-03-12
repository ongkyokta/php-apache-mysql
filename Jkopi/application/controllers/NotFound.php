<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotFound extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX NOt FOUND
	* ----------------------------------------
	* View: errors/not_foung
	*
	*/
    public function index()
    {
        $this->load->view('errors/not_found');
    }
}
