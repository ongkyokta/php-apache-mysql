<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ComingSoon extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* INDEX COMING SOON
	* ----------------------------------------
	* View: errors/coming_soon
	*
	*/
    public function index()
    {
        $this->load->view('errors/coming_soon');
    }
}
