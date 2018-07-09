<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultsModel
 *
 * @author Arnor
 */
class ResultsModel extends CI_Model {
   
    function getQuestionList()
    {
        $this->db->select("*");
        $this->db->from("Question");
        $query = $this->db->get();
        return $query->result();
    }
    
    function getAnswerList($questionid)
    {
        $query = $this->db->query('SELECT DISTINCT Answerid FROM Survey_Question_Answer 
            WHERE Questionid='.$questionid);//get all answer list
        return $query->result();
    }

    function getQuestionDescription($questionid)
    {
        $query = $this->db->query('SELECT * FROM Question WHERE id ='.$questionid);
        $query = $query->result();
        return $query[0]->description;//get the description for certain questionid
    }

    function getMostRecentSurvey($profileID){
        $surveys = $this->db->query("SELECT * FROM Survey WHERE profileID = ".$profileID);
        //for all the surveys from the same person, compare the timestamps to get the most recent one
        $mostRecentSurvey = null;
        foreach($surveys->result() as $survey){
            if(!isset($mostRecentSurvey)){
                $mostRecentSurvey = $survey;
            }
            else{
                if($survey->timestamp > $mostRecentSurvey->timestamp){
                    $mostRecentSurvey = $survey;
                }
            }
        }
        return $mostRecentSurvey;
    }
    
    function getSurveyByID($surveyID){
        $sql = "SELECT * FROM Survey WHERE ID = ".$surveyID;
        $survey = $this->db->query($sql)->row();
        return $survey;
    }
    
    function getElder($elderID){
        $sql = "SELECT * FROM ElderlyPerson WHERE ProfileID = ".$elderID;
        $elder = $this->db->query($sql)->row();
        return $elder;
    }
    
    //gives the question and answers for the given survey
    function getQuestionAndAnswers($surveyID){
        $sql = "SELECT Question.description as question, Answer.description as answer, questionID
                FROM Survey_Question_Answer
                INNER JOIN Question
                ON Survey_Question_Answer.Questionid = Question.id
                INNER JOIN Answer
                ON Survey_Question_Answer.Answerid = Answer.id
                WHERE SurveyID = ".$surveyID;
        
        $QAs = $this->db->query($sql);
        
        
        return $QAs;
    }
    
    //gives the all the information for one question for one elder
    function getQuestionResults($questionID, $elderID){
        $sql = "SELECT Survey.ID AS surveyID, Survey.timestamp, Survey_Question_Answer.Questionid, Survey_Question_Answer.Answerid,
                    Question.description AS question, Answer.description AS answer
                FROM Survey
                INNER JOIN Survey_Question_Answer ON Survey_Question_Answer.SurveyID = ID 
                INNER JOIN Question ON Survey_Question_Answer.Questionid = Question.id
                INNER JOIN Answer ON Survey_Question_Answer.Answerid = Answer.id
                WHERE ProfileID = ".$elderID." AND Questionid = ".$questionID;
        
        $questionResults = $this->db->query($sql);
        
        return $questionResults;
    }


    function getTips($profileID, $weekNr){
        $output = '';
        $this->db->select("*");
        $this->db->from("HealthTips");
        $array = array('ProfileID' => $profileID, 'index' => $weekNr);
        $this->db->where($array);
        $query = $this->db->get();
        $output .= '<ul style="width:100%; list-style:none; ">';
        foreach($query->result() as $row)
        {
         $output .= '<h3 class = "tips_string">'.' '.$row->description.'</h3></li>';
                 
        }
        $output .= '</ul>';
        
        return $output;
              
    }
    function getCurrentWeek($profileID){
     
        $this->db->select_max("index");
        $this->db->from('HealthTips');
        $this->db->where('ProfileID',$profileID);
        $query = $this->db->get();
        return $query->result();
    }
    function getScores($profileID){
        
        $sql = "SELECT 	s.ProfileID,
		s.ID,
		(SUM(a.score)+75) as SelfReliance,
                (SELECT (SUM(a.Answerid))*(-1) 
                FROM a17_webapps09.`Survey_Question_Answer` a
		WHERE a.SurveyID = s.ID AND a.Answerid <=2) as reliability,
		s.`timestamp` 
                FROM a17_webapps09.Question_has_Answer a INNER JOIN a17_webapps09.`Survey_Question_Answer` sqa
                ON (sqa.Answerid = a.Answer_id and sqa.Questionid = a.Question_id) INNER JOIN a17_webapps09.Survey s ON (s.ID = sqa.SurveyID) WHERE s.ProfileID =".$profileID." GROUP BY sqa.SurveyID order by s.timestamp desc";
        $query = $this->db->query($sql);
        foreach($query->result() as $row)
        {
            $output['SelfReliance'][] = $row->SelfReliance;
            $output['timestamp'][] = substr($row->timestamp, 0, 10);
                
        }
        $result = $query->result();
        $output['mostRecent'] = $result[0]->SelfReliance;
        return $output;
    }
    
    function getFalling($surveyID){
    $sql = 'SELECT q.id,sqa.Answerid  FROM a17_webapps09.`Survey_Question_Answer` sqa INNER JOIN a17_webapps09.`Question` q ON (sqa.Questionid = q.id)
            WHERE sqa.SurveyID = '.$surveyID.' AND q.label = \'f\'';
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        
    }
    
    function getPain($surveyID){
        $sql = "SELECT q.id,sqa.Answerid  FROM a17_webapps09.`Survey_Question_Answer` sqa INNER JOIN a17_webapps09.`Question` q ON (sqa.Questionid = q.id)
        WHERE sqa.SurveyID = ".$surveyID." AND q.label = 'p' order by q.id;";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    function getSelfReliance($surveyID){
        $sql = "SELECT q.id,sqa.Answerid, a.description FROM a17_webapps09.`Survey_Question_Answer` sqa INNER JOIN a17_webapps09.`Question` q ON (sqa.Questionid = q.id)
            INNER JOIN a17_webapps09.`Answer` a ON (sqa.Answerid = a.id) WHERE sqa.SurveyID = ".$surveyID." AND q.label = 'r'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    function getDataSets($questionid){
        $this->db->select('*');
        $this->db->from('Question_has_Answer');
        $this->db->where('Question_id',$questionid);
        $query = $this->db->get();
        $answer = $query->result();
        foreach($answer as $row){
            $answerid = $row->Answer_id;
            $sql = 'SELECT count(*) as number, description FROM a17_webapps09.Answer as a inner join a17_webapps09.Survey_Question_Answer as s on  a.id = s.Answerid where s.Questionid = '.$questionid.' and s.Answerid = '.$answerid;
            $query = $this->db->query($sql);
            $answer2 = $query->result();
            $output['number'][] = $answer2[0]->number;
            $output['description'][] = $answer2[0]->description;
        }
        return $output;
    }
    
    function getDataSetsLine($questionid, $start_date, $answerid){
        
        $number = 0;
        $stop_date = $start_date;
        while($stop_date<date('Y-m-d'))
        {
            $current_date = $stop_date;
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +6 day'));
           
            while($current_date<$stop_date)
            {
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));

                    $sql = 'SELECT count(*) as number, survery.timestamp as timestamp, description, s.SurveyID  FROM a17_webapps09.Answer as a inner join a17_webapps09.Survey_Question_Answer as s on  a.id = s.Answerid  inner join a17_webapps09.Survey as survery on survery.ID = s.SurveyID  where s.Questionid = '.$questionid.' and s.Answerid = '.$answerid.' and timestamp like "'.$current_date.'%"';
                    $query = $this->db->query($sql);
                    $answer = $query->result();
                    $number += (int)$answer[0]->number;

            }
            $output[] = $number.'';
        }
        return $output;
    }
    
}
