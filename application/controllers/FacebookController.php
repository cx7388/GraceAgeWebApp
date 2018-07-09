<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FamilyFacebookController
 *show data from FACEBOOK API and show saved Photos
 *
 * @author Jakhoofd
 */
class FacebookController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encryption');
        $this->load->model('FacebookModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    
    public function choosePage()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        if (!session_id()) {
            session_start();
        }
        
        /*
         * Get access token using Facebook Graph API
         */
        if (isset($_SESSION['facebook_access_token'])) {
            // Get access token from session
            $access_token = $_SESSION['facebook_access_token'];
        } else {
            // Facebook app id & app secret
            $appId = '1750214425275048';
            $appSecret = '7c58d61d8684ef13d45265fd36539c1f';
            
            // Generate access token
            $graphActLink = "https://graph.facebook.com/oauth/access_token?client_id={$appId}&client_secret={$appSecret}&grant_type=client_credentials";
            
            // Retrieve access token
            $accessTokenJson = file_get_contents($graphActLink);
            $accessTokenObj = json_decode($accessTokenJson);
            $access_token = $accessTokenObj->access_token;
            
            // Store access token in session
            $_SESSION['facebook_access_token'] = $access_token;
        }
        $data['title'] = $this->lang->line('choose_page');
        // Get photo albums of Facebook page using Facebook Graph API
        $fields = "id,name,description,link,cover_photo,count";

        $pages = $this->FacebookModel->getPages($_SESSION['profileID']);
        $count = 0;
        $arrayfb = [];
        foreach ($pages as $page) {
            // Get photo albums of Facebook page using Facebook Graph API
            $fb_page_id = $page->idFaceBook;
            $graphAlbLink = "https://graph.facebook.com/v2.9/{$fb_page_id}/albums?fields={$fields}&access_token={$access_token}";
            $jsonData = file_get_contents($graphAlbLink);
            $fbAlbumObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
            // Facebook albums content
            $fbAlbumData = $fbAlbumObj['data'];
            $fbAlbumData = $fbAlbumData[0];
            $nameData = $this->FacebookModel->getPageName($fb_page_id);
            $fbAlbumData["name"] = $nameData[0]->PageName;
            $fbAlbumData["id"] =  $page->idFaceBook;
            $arrayfb[] = $fbAlbumData;
        }
        $data['fbAlbumData'] = $arrayfb;
        $this->load->view('pages/choosePageView', $data);
    }
    
    public function facebook()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        $access_token = $_SESSION['facebook_access_token'];

        $data['title'] = "Facebook Album";
        // Get photo albums of Facebook page using Facebook Graph API
        $fields = "id,name,description,link,cover_photo,count";
        $fb_page_id = $this->input->get('fb_page_id');
        $graphAlbLink = "https://graph.facebook.com/v2.9/{$fb_page_id}/albums?fields={$fields}&access_token={$access_token}";
        
        $jsonData = file_get_contents($graphAlbLink);
        $fbAlbumObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
        // Facebook albums content
        $fbAlbumData = $fbAlbumObj['data'];
        $data['fbAlbumData'] = $fbAlbumData;
        $this->load->view('pages/facebookAlbumView', $data);
    }

    public function facebookPhoto()
    {
        if (!isset($_SESSION['profileID'])) { //check if the session already assign room
            redirect('LoginController/loginOlderAdults');
        }
        // Get album id from url
        //$album_id = isset($_GET['album_id'])?$_GET['album_id']:header("Location: index.php");
        //$album_name = isset($_GET['album_name'])?$_GET['album_name']:header("Location: index.php");
        
        // Get access token from session
        $access_token = $_SESSION['facebook_access_token'];
        $album_id = $this->input->get('album_id');
        $album_name = $this->input->get('album_name');
        $data['album_name']=$album_name;
        // Get photos of Facebook page album using Facebook Graph API
        $graphPhoLink = "https://graph.facebook.com/v2.9/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
        $jsonData = file_get_contents($graphPhoLink);
        $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
        $fbPhotoData = $fbPhotoObj['data'];
        $data['fbPhotoData'] = $fbPhotoData;
        $data['title'] = "Photos in the album";

        $this->load->view('pages/facebookPhotosView', $data);
    }
    public function familyFacebook()
    {
        //show recent information of family
    }

    public function photoAlbum()
    {
        $output = array(
            'photo'   => $this->FacebookModel->getPhoto($_SESSION['profileID'])
           );
        echo json_encode($output);
    }
}
