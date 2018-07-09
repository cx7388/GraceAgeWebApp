<?php
class LanguageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('encryption');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    public function english()
    {
        $lang = $data_form['language'];
        $this->session->unset_userdata('lang');
        $this->session->set_userdata('lang','english');

    }

    public function dutch()
    {
        $lang = $data_form['language'];
        $this->session->unset_userdata('language');
        $this->session->set_userdata('lang','dutch');
 
    }
}