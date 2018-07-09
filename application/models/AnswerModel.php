<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnswerModel
 *
 * @author Arnor
 */
class AnswerModel extends CI_Model{
    
    public function refreshIndex($answer){
            $data = array(
            'index'=>$answer['QuestionID']
        );
        $this->db->where('ID', $answer['SurveyID']);
        $this->db->update('Survey',$data);
       
        
    }
    public function storeAnswer ($answer) {
        $sql = "SELECT * FROM a17_webapps09.Survey_Question_Answer WHERE `SurveyID`=".$answer['SurveyID']." and`Questionid`=".$answer['QuestionID'];
        $query = $this->db->query($sql);
        if($query->num_rows()!=0)
        {
        $sql = "UPDATE `a17_webapps09`.`Survey_Question_Answer` SET `Answerid`=".$answer['AnswerID']." WHERE `SurveyID`=".$answer['SurveyID']." and`Questionid`=".$answer['QuestionID'];
        $query = $this->db->query($sql);
        }
        else
        {
            $this->db->insert('Survey_Question_Answer',$answer);
        }
    
    }
    
    public function addUserInput($answer) {
        $this->db->where('description', $answer['description']);
        $query = $this->db->get('Answer');
        if($query->row())
        {
                $result = $query->result();
                $answer = $result[0];
                return $answer->id;
        }
        else{
             $this->db->insert('Answer',$answer);
             $insert_id = $this->db->insert_id();
             return $insert_id;
        }
        
    }
    
    public function getQuestions($question_id){
     
         $this->db->where('id', $question_id);
         $query = $this->db->get('Question');
         if($query->row())
         {
                return $query;
         }
     
    }

    public function getAnswers($question_id){
     
        $this->db->select('*');
        $this->db->from('Question_has_Answer');
        $this->db->where('Question_id',$question_id);
        $this->db->join('Answer', 'Answer.id = Answer_id');
        $query = $this->db->get();
        return $query; 

    }
    
    public function getCurrentSurvey($ownerid){
        $this->db->select_max('ID');
        $this->db->from('Survey');
        $this->db->where('ProfileID',$ownerid);
        $result = $this->db->get()->result();
        $maxID = $result[0]->ID;
        $this->db->select('ID as id, index');
        $this->db->from('Survey');
        $this->db->where('ID',$maxID);
        $query = $this->db->get();
        return $query;
    }
     public function getCurrentFinishedSurvey($ownerid){
        $this->db->select_max('ID');
        $this->db->from('Survey');
        $this->db->where('ProfileID',$ownerid);
        $this->db->where('index','40');
        $query = $this->db->get();
        return $query->result();
    }   
   
    public function addNewSurvey($data) {
        $this->db->insert('Survey',$data);
    }
    
    public function pauseSurvey($index, $surveyid ){
        //UPDATE `a17_webapps09`.`Survey` SET `index`='16' WHERE `ID`='1';
        $this->db->where('ID',$surveyid);
        $this->db->update('Survey',array('index'=>$index));
        
    }
    
    public function deleteSurvey($surveyID){
        $this->db->where('Surveyid', $surveyID);
        $this->db->delete('Survey_Question_Answer');
        
        $this->db->where('ID', $surveyID);
        $this->db->delete('Survey'); 
    }
    
    public function addStaticInfo($questionID, $ownerid, $answerid){
           
        $this->db->select('description');
        $this->db->from('Answer');
        $this->db->where('id',$answerid);
        $result = $this->db->get()->result();
        $answer = $result[0]->description;
        if($questionID=='1')
        {        
            $this->db->where('ProfileID', $ownerid);
            $this->db->update('ElderlyPerson',array('gender'=>$answer));
        }
        if($questionID=='2')
        {
            $this->db->where('ProfileID', $ownerid);
            $this->db->update('ElderlyPerson',array('maritalState'=>$answer));
        }
        if($questionID=='3')
        {
            $this->db->where('ProfileID', $ownerid);
            $this->db->update('ElderlyPerson',array('householdPerson'=>$answer));
        }
    }
}
