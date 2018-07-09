<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditInformationController
 * Change the information of residents or add/delete resident
 * 
 * @author Jakhoofd
 */
class EditInformationController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper(array('form', 'url'));
        $this->load->library('encryption');
        $this->load->model('AnswerModel');
        $this->load->model('EditInfoModel');
        $this->load->model('FacebookModel');
        $this->load->library('form_validation');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    public function addNewUser()
    {
        if(empty($_SESSION['caregiverName']))
        {
            redirect("LoginController/loginCareGiver");
        }
        $data['pageData'] = $this->FacebookModel->getAllPages();
        $this->load->view('pages/addNewProfileView',$data);
        
    }
    public function upload(){
       // $elder['picture'] = $this->input->post('userfile');
        $query = $this->EditInfoModel->getAllElderly();
        $num = $query->num_rows();
        $elder['lastName'] = $this->input->post('inputLastName');
        $elder['firstName'] = $this->input->post('inputFirstName');
        $elder['password'] = $this->input->post('inputPassword');
        $elder['gender'] = $this->input->post('inputGender');
        $elder['roomNumber'] = $this->input->post('inputRoomNumber');
        $elder['notes'] = $this->input->post('inputNotes');
        $elder['birthday'] = $this->input->post('inputBirthday');
        $elder['facebookPage'] = $this->input->post('facebookPage');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required|exact_length[4]');
        
        
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['max_size']	= '20840';
	    $config['max_width']  = '5000';
	    $config['max_height']  = '5000';
       
       // $config['file_name'] = $elder['lastName'].$num ;
       
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('uploadError', $error);
        }
        else
	{ 

            $data = array('upload_data' => $this->upload->data());
            $filepath = $data['upload_data']['full_path'];
            $elder['pictureURL'] = $data['upload_data']['file_name'];
            
            $this->EditInfoModel->addElderToDatabase($elder);
            
            chmod($filepath,644); // CHMOD file to be rwxr
            redirect('NavigationController/showDepartments');
        }
       
        
    }

    public function deleteResident () {
	//delete a new resident
    }

    public function editResident () {
	//change information of a resident
    }
}
