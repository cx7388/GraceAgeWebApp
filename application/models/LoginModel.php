<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function getolder($ProfileID, $password)
    {
        $this->db->where('ProfileID', $ProfileID);
        $query = $this->db->get('Profile');
        if ($query->row()) {
            $sql = $query->result();
            $hash_pwd = $sql[0]->password;
            $result = password_verify($password, $hash_pwd);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getOlderName($ProfileID)
    {
        $this->db->select("*");
        $this->db->where('ProfileID', $ProfileID);
        $query = $this->db->get('ElderlyPerson');
        $result = $query->result();
        return $result;
    }
    public function getuser($username, $password)
    {
        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('CareGiver');
        if ($query->row()) {
            return true;
        } else {
            return false;
        }
    }
    public function getDepartment()
    {
        $query = $this->db->query('SELECT * FROM Department');
        $query = $query->result();
        return $query;
    }

    public function getRoomList($department)
    {
        $this->db->where('departmentName', $department);
        $query =$this->db->get('Room');
        return $query->result();
    }

    public function getRoomOlder($roomNumber)
    {
        $this->db->where('roomNumber', $roomNumber);
        $query = $this->db->get('ElderlyPerson');
        $query = $query->result();
        return $query;
    }
}
