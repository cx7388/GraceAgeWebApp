<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditInfoModel
 *
 * @author Arnor
 */
class EditInfoModel extends CI_Model
{
    //put your code here

    function getolder()
    {

        $this->db->where('name', $name);
        $query = $this->db->get('CareGiver');
        return $query;
    }
    
    function getAllElderly(){
        $query = $this->db->query('SELECT * FROM ElderlyPerson');
        return $query;       
    }
    
    function addElderToDatabase($elder){
        //$bd = $elder['birthday'];
        //echo "<script type='text/javascript'>alert('$bd');</script>";

        $data = array('firstName' => $elder['firstName'], 'lastName' => $elder['lastName'],
                     'birthDate' => $elder['birthday'],'pictureURL' => $elder['pictureURL'],
                'roomNumber' => $elder['roomNumber']); //, 'notes' => $elder['notes']) ; //, 'roomNumber' => $elder['roomNumber']);
        if($elder['firstName']!=NULL){
            $str = $this->db->insert_string('ElderlyPerson', $data);
            $this->db->query($str);
            //sleep for a second so the elder can get added to the database
            sleep(1);
            $id = $this->db->insert_id();
            $profileData = array('ProfileID' => $id, 'password' => $this->_hash_string($elder['password']));
            $profileStr = $this->db->insert_string('Profile', $profileData);
            $this->db->query($profileStr);
            $sql = "INSERT INTO `Notes` (`description`,`ProfileID`) VALUES ('".$elder['notes']."',".$id.")";
            $this->db->query($sql);   
            $facebookData = $elder['facebookPage'];
            foreach ($facebookData as $f) {
                $fbdata = array(
                    'ProfileID' =>$id,
                    'idFaceBook' => $f
            );
            
            $this->db->insert('Chosen_FB', $fbdata);
             }
        }
       

    
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
