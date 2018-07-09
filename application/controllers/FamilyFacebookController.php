<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FamilyFacebookController
 *show data from FACEBOOK API and show saved Photos
 * 
 * @author Jakhoofd
 */
class FamilyFacebookController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encryption');
        $this->load->model('FacebookModel');        
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    public function familyFacebook () {
	//show recent information of family
    }


}
