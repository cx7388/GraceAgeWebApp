<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DisplayResultsController
 *
 * @author Jarno
 */
class DisplayResultsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encryption');
        $this->load->model('ResultsModel');
        $this->load->model('AnswerModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }

    public function displayTips($weekNr)
    {
        $output = array(
            'tips_items'   => $this->ResultsModel->getTips($_SESSION['profileID'],$weekNr)
           );
        echo json_encode($output);
    }    
    
    public function displayFalling(){
        $result = $this->AnswerModel->getCurrentFinishedSurvey($_SESSION['profileID']);
        $result = $result[0];
        $result = $this->ResultsModel->getFalling($result->ID);
        $falling_risk = $result[0]->Answerid;
        if($falling_risk==66){
            $risk = $this->lang->line('fall_normal');
        }
        if($falling_risk==67 || $falling_risk==42){
            $risk = $this->lang->line('fall_triggered');
        }
        if($falling_risk==68){
            $risk = $this->lang->line('fall_high');
        }
        if($falling_risk==101 || $falling_risk==102){
            $risk = $this->lang->line('undetermined');
        }
        $output = '';
        $output .= '<div class="col-md-4">'
                .'<div class="row problem">'
                .'<div class="col-md-3" style="background-color: #03A9F4; margin:0;padding:0">'
                .'</div>'
                .'<div class="col-md-9" style="background-color: #B3E5FC; opacity: 0.8; margin:0;padding:">'
                ;
        $output .= '
              <h3>'.$this->lang->line('falling').'</h3><p>'.$this->lang->line('fall_indicator').$risk.'</p>';
                 $output .= '</div></div></div>';      
      //  echo $output;  
        echo json_encode($output);
    }    
    
    public function displayPain(){
        $result_array = $this->AnswerModel->getCurrentFinishedSurvey($_SESSION['profileID']);
        $result_id = $result_array[0];
        $result = $this->ResultsModel->getPain($result_id->ID);
        $pain = '';
        
        if($result[0]->id == '30'){
                
                if($result[0]->Answerid == '56'){
                    $pain =$this->lang->line('pain_none');
                }
                if($result[0]->Answerid == '57' ){
                    $pain =$this->lang->line('pain_not_daily');
                }
                if($result[0]->Answerid == '42'){
                    $pain =$this->lang->line('pain_not_daily');
                }
                if($result[0]->Answerid == '43'){
                    if($result[1]->Answerid = '56' || $result[1]->Answerid = '58'|| $result[1]->Answerid = '59'){
                        $pain =$this->lang->line('pain_daily_light');
                    }
                    if($result[1]->Answerid = '60'){
                        $pain =$this->lang->line('pain_daily_severe');
                    }
                    if($result[1]->Answerid = '61'){
                        $pain =$this->lang->line('pain_daily_excruciating');
                    }
                }
        }
       
        $output = '';
        $output .= '<div class="col-md-4">'
                .'<div class="row problem">'
                .'<div class="col-md-3" style="background-color: #03A9F4; margin:0;padding:0">'
                .'</div>'
                .'<div class="col-md-9" style="background-color: #B3E5FC; opacity: 0.8; margin:0;padding:">'
                ;
        $output .= '
              <h3>'.$this->lang->line('pain').'</h3><p>'.$this->lang->line('pain_indicator').$pain.'</p>';
                 $output .= '</div></div></div>';      
        //echo $output;    
        
        echo json_encode($output);
    }   
    
    public function displaySelfReliance(){
        $result_array = $this->AnswerModel->getCurrentFinishedSurvey($_SESSION['profileID']);
        $result_id = $result_array[0];
        $result = $this->ResultsModel->getSelfReliance($result_id->ID);       
        $reliance =  $this->lang->line('reliance_self');
        foreach($result as $row)
        {
            if($row->Answerid == '37' || $row->Answerid == '38' || $row->Answerid == '64'|| $row->Answerid == '65' || $row->Answerid == '69'){
                $reliance =  $this->lang->line('reliance_problem');
            }
        }
        
        $output = '';
        $output .= '<div class="col-md-4">'
                .'<div class="row problem">'
                .'<div class="col-md-3" style="background-color: #03A9F4; margin:0;padding:0">'
                .'</div>'
                .'<div class="col-md-9" style="background-color: #B3E5FC; opacity: 0.8; margin:0;padding:">'
                ;
        $output .= '
              <h3>'.$this->lang->line('reliance').'</h3><p>'.$reliance.'</p>';
                 $output .= '</div></div></div>';  
        echo json_encode($output);
    }
    public function displayScores(){
       
        $result = $this->ResultsModel->getScores($_SESSION['profileID']);
        $output = array(
            'scores_items'   => $result['SelfReliance'],
            'scores_timestamps' => $result['timestamp'],
            'mostRecent' =>$result['mostRecent'],
            'label' => $this->lang->line('reliance')
           );
        echo json_encode($output);
        
    }
    
    public function displayPersonScores($person_id){
        $result = $this->ResultsModel->getScores($person_id);
        $output = array(
            'scores_items'   => $result['SelfReliance'],
            'scores_timestamps' => $result['timestamp'],
            'mostRecent' =>$result['mostRecent'],
            'label' => $this->lang->line('reliance')
           );
        echo json_encode($output); 
    }
    
   
    public function displayResultsOlderAdults()
    {
        //display simple version of last questionnaire
    }

    public function displayResultsCareGivers()
    {
        //display Elaborated results of one older adult
        //use javaScript to show different styles of information (questions, notes, graphs, ... )
    }

    public function displayResultsOverview()
    {
        if(empty($_SESSION['caregiverName']))
        {
            redirect("LoginController/loginCareGiver");
        }
        $data['questions'] = $this->ResultsModel->getQuestionList(); //get the result as array
        $this->parser->parse('pages/questionOverviewView', $data);
    }
    
    public function createDataSet($questionid){
        $result = $this->ResultsModel->getDataSets($questionid);
        $output = array(
                'number' => $result['number'],
                'description' => $result['description']
               );
        echo json_encode($output);        
    }
     
    public function createDataSetForLine($questionid){
        $d=mktime(11, 14, 54, 12, 20, 2017);
        $start_date = date("Y-m-d", $d);
   
        $answers = $this->ResultsModel->getAnswerList($questionid);
        $output = array();
        $label = array();
        $timeline = array();
        $i = 1;
        foreach($answers as $row)
        {
            $answerid = $row->Answerid;
            $label[] = $i;
            $output[] = $this->ResultsModel->getDataSetsLine($questionid, $start_date, $answerid);
            $i++;
      
        }
        $stop_date = $start_date;
        
        while($stop_date<date('Y-m-d'))
        {
            $timeline[] = $stop_date;
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +6 day'));
            
        }
        
        $final = ['number' => $output,
            'label' => $label,
            'timeline' => $timeline];
        
        echo json_encode($final);        
    }
    public function displaySurveyOfElder($elderID, $surveyID){
        //$mostRecentSurvey = $this->ResultsModel->getMostRecentSurvey($elderID);
        $survey = $this->ResultsModel->getSurveyByID($surveyID);
        $data['survey'] = $survey;
        $data['elder'] = $this->ResultsModel->getElder($elderID);
        $data['QnAs'] = $this->ResultsModel->getQuestionAndAnswers($surveyID);//$mostRecentSurvey->ID);
        $this->load->view('pages/surveyOneElderView', $data);
    }
    
    public function displayOneQuestion($questionID, $elderID){
        $questionResults = json_encode($this->ResultsModel->getQuestionResults($questionID, $elderID)->result());
        echo $questionResults;
    }
    

}
