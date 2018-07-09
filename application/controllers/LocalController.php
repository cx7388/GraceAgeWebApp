<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocalController
 *
 * @author Jarno
 */
class LocalController extends CI_Controller
{
    
    //the owner id should be passed from login controller
    public $questionNr = 40;
    
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
        $this->load->model('LoginModel');
        $this->load->model('ResultsModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    public function index(){
    
     
    }
    
    public function testNumpad(){
        $this->load->view('pages/testNumpad');
    }
    public function elderHomepage()
    {
        if(!isset($_SESSION['profileID'])) //check if the session already assign room
        {
              redirect('LoginController/loginOlderAdults'); 
        }  
        else
        {
         $result = $this->LoginModel->getOlderName($_SESSION['profileID']);
         $name = $result[0]->firstName;
            
         $data['item1'] = array(
               'className'=>'first',  
               'name'  =>$this->lang->line('questionnaire'), 
               'link' => 'questionair',   
               'image'=>'../../assets/image/002-customer-service.png'
         );
         $data['item2'] =array(
                "className"=>"second",
                "name"=>$this->lang->line('tips'),
                "link" => "tips",
                "image"=>"../../assets/image/004-tips.png"
         );
         $data['item3'] = array(
             "className"=>"third",
             "name"=>$this->lang->line('newsletter'),
             "link"=>"newsletter",
             "image"=>"../../assets/image/001-news.png"
          );
         $data['item4'] = array(
             "className"=>"fourth",
             "name"=>$this->lang->line('album'),
             "link"=>"album",
             "image"=>"../../assets/image/003-album.png"
                  
         );
        $data['name'] = $name;
        $query = $this->AnswerModel->getCurrentSurvey($_SESSION['profileID']);
       
        if($query->num_rows()!=0)
        {
            $result = $query->result();
            if($result[0]->index!=$this->questionNr){
                $data["unfinished"] = '1';
            }
            else $data["unfinished"] = '0';
        }
        else
            $data["unfinished"] = '0';

        $this->parser->parse('pages/homepageElderly.php', $data);
        }
        
    }
    public function tips()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        $result = $this->ResultsModel->getCurrentWeek($_SESSION['profileID']);
        $data["homepage"] = "elderHomepage";
        $data['tips_week'] = $result[0]->index;
        $this->parser->parse('pages/tipsElderly.php', $data);
    }
    public function album()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
                $data["album"] = array(
                array(
                    "link"=>"https://static.pexels.com/photos/415829/pexels-photo-415829.jpeg",
                    "string"=>"Nothing"),
                array(
                    "link"=>"https://static.pexels.com/photos/407035/model-face-beautiful-black-and-white-407035.jpeg",
                    "string"=>"still Nothing")
         );
                 $data["homepage"] = "elderHomepage";
        $this->parser->parse('pages/albumElderly.php', $data);
    }
    public function newsletter()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
          redirect('FacebookController/choosePage');
      //  $this->parser->parse('pages/newsletterElderly.php', $data);
    }
    
    public function new_questionair($state)
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        $query = $this->AnswerModel->getCurrentSurvey($_SESSION['profileID']);
        $result = $query->result();
        $newSurvey['ProfileID'] = $_SESSION['profileID'];
        $newSurvey['index'] = 0;
        if($query->num_rows()==0)
        {
            $this->AnswerModel->addNewSurvey($newSurvey);
            redirect('AnswerController/question/1');
        }
        else
        {
            // no need to define 
            if($state == 'false')
            {
                $this->AnswerModel->deleteSurvey($result[0]->id);
                $this->AnswerModel->addNewSurvey($newSurvey); 
                
            }
            else if($state=='true'){
                //判断 是否已经填了
                $this->AnswerModel->addNewSurvey($newSurvey); 
            }
            redirect('AnswerController/question/4');
        }
        
    }
     public function old_questionair()
    {
      
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        $query = $this->AnswerModel->getCurrentSurvey($_SESSION['profileID']);
        $result = $query->result();
        $newSurvey['ProfileID'] = $_SESSION['profileID'];
        $newSurvey['timestamp'] = time();
        $newSurvey['ID'] = $query->num_rows();
        $data_id = $result[0]->index;
        redirect('AnswerController/question/'.$data_id);

      
    }
    public function showLocalPage()
    {
        //load the views for the local page
    }
   
    public function editLocalUser()
    {
    //edit a local user
    }

    public function deleteLocalUser()
    {
    //delete a local user
    }

    public function caregiverHomepage()
    {
        if(empty($_SESSION['caregiverName']))
        {
            redirect("LoginController/loginCareGiver");
        }

        $data['roomList'] = array('room1', 'room2', 'room3');
        $data['departmentList'] = array('department1', 'department2', 'department3');
        $data['curentRoom'] = "room";
        $data['older1'] = "older1";
        $data['older2'] = "older2";
        
        $this->load->view('templates/background');
        $this->load->view('pages/homepageCareGiverView', $data);
    }
    
   public function test(){
        $data['roomList'] = array('room1', 'room2', 'room3');
        $data['departmentList'] = array('department1', 'department2', 'department3');
        $data['elderList'] = array('elder1', 'elder2', 'elder3');
        
        $selected = $this->input->post('departmentCheckbox');
        //use selected to get the necessary departments and rooms to put in data roomList
        
        $this->load->view('pages/roomView', $data);
   }
}
