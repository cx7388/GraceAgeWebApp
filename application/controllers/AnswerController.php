<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnswerController
 * All the information of questions, register answers and send them to model
 * 
 * @author Jakhoofd
 */
class AnswerController extends CI_Controller {
    
    public $questionNr = 40;
    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model('AnswerModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
        
    }
    public function question ($data_id) {
       
        
        if($data_id == $this->questionNr+1){
            
            redirect('LocalController/Tips');
        }
        else{
            
            $data['question'] = $this->AnswerModel->getQuestions($data_id);
            $data['answer'] = $this->AnswerModel->getAnswers($data_id);
            $answer = $data['answer']->result();
            $data['index'] = $data_id;
            $this->load->view('pages/questionView',$data);
        }
    }
    
    public function getAnswer(){
       
        //the owner id should be passed from login controller
        $result = $this->AnswerModel->getCurrentSurvey($_SESSION['profileID'])->result();
        
        $surveyid = $result[0]->id;
        $answerid = $this->input->post('AnswerID');
        $questionid = $this->input->post('QuestionID');
        
        $data = array(
            'SurveyID'=>$surveyid,
            'QuestionID'=>$questionid,
            'AnswerID'=> $answerid
        );
        $questionid++;
        if($questionid <= 3 ){
            $this->AnswerModel->addStaticInfo($questionid, $_SESSION['profileID'], $answerid);
            $this->AnswerModel->refreshIndex($data);  
            $this->AnswerModel->storeAnswer($data); 
            sleep(2);
            redirect('AnswerController/question/'.$questionid);
        }
        
        else
        {
            $query = $this->AnswerModel->getQuestions($questionid-1);
            
            $result = $query->result();
            if($result[0]->userInput == '1' && $answerid == '100' ){
                $question_input  = $this->input->post('userInput');
                
                $userInput = array(
                    'description'=> $question_input
                );
                $id = $this->AnswerModel->addUserInput($userInput);
               
                $data['AnswerID'] = $id;
            }
          
            sleep(2);
            $this->AnswerModel->refreshIndex($data);  
            $this->AnswerModel->storeAnswer($data);  
            redirect('AnswerController/question/'.$questionid);
        }
    }
    
    public function pauseSurvey($index){
        $result = $this->AnswerModel->getCurrentSurvey($_SESSION['profileID'])->result();
        
        $surveyid = $result[0]->id;
        $this->AnswerModel->pauseSurvey($index,$surveyid); 
        redirect('LocalController/elderHomepage');
    }
}
