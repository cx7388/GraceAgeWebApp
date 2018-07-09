<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 * Load the views of the different logins and of the homePageOlderAdults. *
 * @author Jarno
 */
class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('encryption');
        $this->load->model('LoginModel');
        //$this->session->unset_userdata('lang');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    public function loginOlderAdults()
    {
        //clear the session of user
        unset($_SESSION['profileID']);
        unset($_SESSION['caregiverName']);
        unset($_SESSION['uploadProfileID']);
        unset($_SESSION['uploadRoom']);
        $this->load->view('templates/background');
        $departments = $this->LoginModel->getDepartment();
        $data['departments'] = $departments;
        $data['room']=" ";

        if(isset($_SESSION['room'])) //check if the session already assign room
        {
            $roomOlder = $this->LoginModel->getRoomOlder($_SESSION['room']);
            $data['room'] = $_SESSION['room'];
            $data['roomOlder']=$roomOlder;
         
        }

        $data_form = $this->input->post('roomNumber');
        if($data_form) //choose room from popup and retrive the data of room and elders
        {
            $roomNumber = $data_form;
            $roomOlder = $this->LoginModel->getRoomOlder($roomNumber);
            $data['room'] = $roomNumber;
            $data['roomOlder']=$roomOlder;
            $_SESSION['room'] = $roomNumber;
        }

        $data_form = $this->input->post(array('password','profileID'));//post parmeter name, whether to apply xss filter
        if ($data_form) 
        {   
            $password = $data_form['password'];
            $ProfileID = $data_form['profileID'];
            $result = $this->LoginModel->getolder($ProfileID,$password);
            if ($data_form['password']) {
                if ($result) {
                    $_SESSION['profileID'] = $ProfileID;
                    redirect('LocalController/elderHomepage');
                } else {
                    $data['error'] = $this->lang->line('login_fail');
                }
            }
              
        }

        $this->parser->parse('pages/loginOlderAdultsView', $data);
    }

    public function getRooms()
    { 
        //run this function through ajax
        $data_form = $this->input->post(null,true);
        if($data_form)
        {
            $department = $data_form['departmentName'];
            $roomList = $this->LoginModel->getRoomList($department);
            $data['roomList']=$roomList;
        }
        $this->load->view('modals/roomListView', $data); //load this modal
    }

    public function getLogin()
    {
        $data_form = $this->input->post(null,true);
        if($data_form)
        {
            $profileID = $data_form['ProfileID'];
            //$roomList = $this->LoginModel->getRoomList($department);
            $data['profileID']=$profileID;
        }
        $this->load->view('modals/loginPopupView', $data);
    }

    public function loginCareGiver()
    {
        unset($_SESSION['uploadProfileID']);
        unset($_SESSION['uploadRoom']);
        //clear session of user
        unset($_SESSION['profileID']);
        unset($_SESSION['caregiverName']);
        $this->load->view('templates/background');
        $data_form = $this->input->post(null, true);
        $data['validation'] = 'hidden';
        if ($data_form) {
            $username = $data_form['username'];
            $password = $data_form['password'];

            $result = $this->LoginModel->getuser($username, $password);
            if ($result) {
                $_SESSION['caregiverName']=$username;
                redirect('NavigationController/showDepartments');
            } else {
                $data['validation'] = 'text';
            }
        }
        $this->load->view('pages/loginCareGiversView.php', $data);
    }


    public function _hash_string($str)
    {
        $hashed_string = password_hash($str,PASSWORD_DEFAULT);
        return $hashed_string;
    }

    public function _verify_hash($plain_text_str,$hashed_string)
    {
        $result = password_verify($plain_text_str,$hashed_string);
        return $result;
    }
}
