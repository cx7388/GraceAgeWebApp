<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NavigationModel
 *
 * @author Jakhoofd
 */
class NavigationModel extends CI_Model{
    
    
    //this function return the query of all the departments in the carehome.
    function getDepartments(){
        $departments = $this->db->get('Department');
        return $departments;
    }
    
    //this function returns the query of all the rooms in a department.
    function getRooms($departmentName){
        $sql = "SELECT * FROM Room WHERE departmentName = ".$departmentName;
        $rooms = $this->db->query($sql);
        return $rooms;
    }
    
    //this function returns an ARRAY of all the elders from a department.
    function getEldersFromDepartment($departmentName){
        $rooms = $this->getRooms($departmentName);
        $elders = [];
        foreach($rooms->result() as $room){
            $sql = "SELECT * FROM ElderlyPerson WHERE roomNumber = ".$room->number;
            $query = $this->db->query($sql);
            $result = $query->result_array();
            $elders = array_merge($elders, $result);
        }
        return $elders;
    }
}
