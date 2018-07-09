<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacebookModel
 *
 * @author Arnor
 */
class FacebookModel extends CI_Model {
    //put your code 

    function getPhoto($profileID)
    {
        $output = '';
        $this->db->select("*");
        $this->db->from("Family_Post");
        $this->db->where('ProfileID',$profileID);
        $this->db->order_by("timestamp");
        $query = $this->db->get();
        
        
        $i = 0;
        foreach($query->result() as $row)
        {
            $id = $row->id;
            $description = $row->Description;
            $timestamp = $row->Timestamp;
            $title = $row->Title;
            $family = $row->Family;
            
            $photo_counter = 0;
            $this->db->select("*");
            $this->db->from("Photos");
            $this->db->where('PostID',$id);
            $query_photo = $this->db->get();
            foreach($query_photo->result() as $row_photo)
            {
                $photo[] = $row_photo->picture;
                $photo_counter++;
            }
            
            if($i % 2 == 0)
            {
                $output.='<li>';   
            }
            else{
                $output.='<li class="timeline-inverted">';
            }
            $output.= '<div class="timeline-panel"> '
                            .'<div class="timeline-heading"> '
                            .'<h4>'.$family.'says: '.$title.'</h4>'
                            .'<span>'
                            .'</div>'
                            .'<div class="timeline-body"><div class="row" style="width:95%;margin:auto;padding:auto">';
      
            if($photo_counter>4){
                    $output .= '<div class="col-md-7">'
                                .'<div class="row">';
                    for($index = 0; $index<$photo_counter; $index++){
                        
                        $output.='<div class="col-md-4">'
                             .'<img class = "img-responsive img-thumbnail" style = "max-height:200px" src="'.base_url().'upload/familyNews/'.$photo[$index].'">'
                             .'</div>';
                    }
                    $output .= '</div></div>'
                            . '<div class="col-md-5">'
                            .'<p>'.$description.'</p></div>';

            }
            else if($photo_counter>=1)
            {
                   $output .= '<div class="col-md-6">'
                                .'<div class="row">';
                    for($index = 0; $index<$photo_counter; $index++){
                        
                        $output.='<div class="col-md-6">'
                             .'<img class = "img-responsive img-thumbnail" style = "max-height:200px" src="'.base_url().'upload/familyNews/'.$photo[$index].'">'
                             .'</div>';
                    }
                    $output .= '</div></div>'
                            . '<div class="col-md-6">'
                            .'<p>'.$description.'</p></div>';
            }
            
            else{
                    $output.='<p>'.$description.'</p>';
            }            
            $output .='</div></div>'
                        .'<div class="timeline-footer">'
                        .'<p class="text-right">'.$timestamp.'</p>'
                        . '</div>'
                        . '</div></li>';     
            $i++;
            
        }
        return $output;
    }
    
    function addPhotosToDatabase($photo){
        $data = array('PostID'=>$photo['id'], 'picture' => $photo['pictureURL']);
        $this->db->insert('Photos', $data);
        $id = $this->db->insert_id();
        return $id;  
    }
    
    function addNewPost($post){
         
        $data = array('ProfileID'=>$post['profileID'], 'Description' => $post['message'],
                     'Title' => $post['title'], 'Family' => $post['familyID']);
        $this->db->insert('Family_Post', $data);
        $id = $this->db->insert_id();
        return $id;         
    }

    function getPages($profileID){
        $this->db->where('ProfileID', $profileID);
        $query = $this->db->get('Chosen_FB');
        return $query->result();
    }

    function getAllPages(){
        $query = $this->db->get('FaceBook');
        return $query->result();
    }

    function getPageName($idFaceBook){
        $this->db->where('idFaceBook', $idFaceBook);
        $query = $this->db->get('FaceBook');
        return $query->result();
    }
}
