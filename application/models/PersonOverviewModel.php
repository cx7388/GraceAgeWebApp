<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnswerModel
 *
 * @author Toon
 */
class PersonOverviewModel extends CI_Model{
    
    
    public function getPerson($personID){     
        $sql = "SELECT * FROM `ElderlyPerson` WHERE `ProfileID` = ".$personID;
        return $this->db->query($sql)->row();
    }
 
    public function getPersonLastActive($personID){     
        $sql = "SELECT MAX(`timestamp`) as `timestamp` FROM `Survey` WHERE `ProfileID` =" .$personID;
        return $this->db->query($sql)->row()->timestamp;
    }
    public function getSurveys($personID){     
        $sql = " SELECT
                    s.ProfileID,
                    s.ID,
                    (SUM(a.score)+75) as `SelfReliance`,
                    (SELECT (SUM(a.Answerid))*(-1) 
			FROM a17_webapps09.`Survey_Question_Answer` a
			WHERE a.SurveyID = s.ID AND a.Answerid <=2) as `Reliability`,
                    s.`timestamp` 
                FROM a17_webapps09.`Question_has_Answer` a INNER JOIN a17_webapps09.`Survey_Question_Answer` sqa
                ON (sqa.Answerid = a.Answer_id and sqa.Questionid =a.Question_id) INNER JOIN a17_webapps09.Survey s ON (s.ID = sqa.SurveyID) 
                WHERE s.ProfileID = $personID GROUP BY sqa.SurveyID ORDER BY s.`timestamp` DESC";
        return $this->db->query($sql)->result();
    }
    public function getNotes($personID){     
        $sql = " SELECT `id`,`description`,`timestamp` FROM `Notes` WHERE `ProfileID` = $personID ORDER BY `timestamp` DESC";
        return $this->db->query($sql)->result();
    }
    public function insertNote($personID, $description){
        $sql = "INSERT INTO `Notes` (`description`,`ProfileID`) VALUES ('".$description."',".$personID.")";
        $this->db->query($sql);   
    }
    public function deleteNote($id){
        $sql = "DELETE FROM `Notes` WHERE `id` = $id";
        $this->db->query($sql); 
        // $this->db->where('id',$id);
        // $this->db->delete('Notes');
    }
    public function editPersonImage($personID, $image){
        $sql = "UPDATE TABLE `ElderlyPerson` SET `image` = $image WHERE profileID = $personID";
        $this->db->query($sql);            
    }
    public function editPersonInfo($personID, $birthday){
        $sql = "UPDATE TABLE `ElderlyPerson` SET `birthDay` = $birthday WHERE profileID = $personID";
        $this->db->query($sql);            
    }
        
 
}
