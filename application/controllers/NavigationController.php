<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NavigationController
 *
 * @author Jarno
 */


class NavigationController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model('NavigationModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    //
    public function showDepartments(){
        if(empty($_SESSION['caregiverName']))
        {
            redirect("LoginController/loginCareGiver");
        }
        $data['departments'] = $this->NavigationModel->getDepartments();
        $departmentName = $this->NavigationModel->getDepartments()->row()->name;
        $data['rooms'] = $this->NavigationModel->getRooms($departmentName);
        $data['elders'] = $this->NavigationModel->getEldersFromDepartment($departmentName);
        $this->load->view('pages/departmentView', $data);
    }
    
    
    public function showRooms($departmentName){
        //departments and rooms are of type query, and elders is an array
        $data['departments'] = $this->NavigationModel->getDepartments();
        $data['rooms'] = $this->NavigationModel->getRooms($departmentName);
        $data['elders'] = $this->NavigationModel->getEldersFromDepartment($departmentName);
        $this->load->view('pages/departmentView', $data);
        
    }
    
}
