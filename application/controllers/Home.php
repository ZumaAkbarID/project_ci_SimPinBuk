<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data = [
            'title' => (!$this->session->userdata('account')) ? 'SimPinBuk' : 'Beranda',
        ];
        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('v_home', $data);
        $this->load->view('template/t_footer', $data);
    }
}

/* End of file Home.php */