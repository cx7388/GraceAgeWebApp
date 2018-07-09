<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personOverviewController
 * All the information of questions, register answers and send them to model
 *
 * @author Toon
 */
class PersonOverviewController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model('PersonOverviewModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    public function personInfo($personID)
    {
        $data['person'] = $this->PersonOverviewModel->getPerson($personID);
        $data['timestamp'] = $this->PersonOverviewModel->getPersonLastActive($personID);
        $data['notes'] = $this->PersonOverviewModel->getNotes($personID);
        $data['surveys'] = $this->PersonOverviewModel->getSurveys($personID);
        if ($this->input->post('newNote')) {
            $newNote = $this->input->post('newNote');
            //$newNote = $data_form['newNote'];
            $this->PersonOverviewModel->insertNote($personID, $newNote);
        }
        if ($this->input->post('noteID')) {
            $noteID = $this->input->post('noteID');
            $this->PersonOverviewModel->deleteNote($noteID);
        }
        $data['person'] = $this->PersonOverviewModel->getPerson($personID);
        $timestamp = $this->PersonOverviewModel->getPersonLastActive($personID);
        $date = date_create($timestamp);
        $data['timestamp'] = $timestamp;
        $data['date'] = $date;
        $data['notes'] = $this->PersonOverviewModel->getNotes($personID);
        $data['surveys'] = $this->PersonOverviewModel->getSurveys($personID);
        $this->load->view('pages/personOverviewView', $data);
    }
    
}
