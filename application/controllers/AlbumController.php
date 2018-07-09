<?php
class AlbumController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('encryption');
        $this->load->model('LoginModel');
        $this->load->model('FacebookModel');
        $lang = ($this->session->userdata('lang'))?
        $this->session->userdata('lang'): config_item('language');
        $this->lang->load('graceAge',$lang);
    }
    

    public function chooseFamily()
    {
        $this->load->view('pages/upLoadChooseFamily');
    }
    public function uploadPhotos()
    {
        //show saved photos
        
        $this->load->view('pages/upLoadPhotosView');
    }

    public function savePhotos(){
        
        $config = array();
        $config['upload_path'] = "./upload/familyNews/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '256000';
        
        $post['profileID'] = 8;
        $post['familyID'] = 1;
        $post['message'] = $this->input->post('message');
        $post['title'] = $this->input->post('title');
        
        $postID = $this->FacebookModel->addNewPost($post);
        
        $photo['id'] = $postID;
        $this->load->library('upload');
        $this->upload->initialize($config, true);
       
        for ($i = 0; $i<9; $i++) {
            if (! $this->upload->do_multi_upload('upload'.$i)) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('uploadError', $error);
            } else {
                $files_upload = $this->upload->get_multi_upload_data();
                print_r($files_upload);

                foreach ($files_upload as $file_data) {
                    $filepath = $file_data['full_path'];
                    $photo['pictureURL'] = $file_data['file_name'];
                    $this->FacebookModel->addPhotosToDatabase($photo);
      //            chmod($filepath,644); // CHMOD file to be rwxr
                //    redirect('AlbumController/showDepartments');
                }
            }
        }
        
    }
        
    public function upload()
    {
        unset($_SESSION['uploadProfileID']);
        $this->load->view('templates/background');
        $departments = $this->LoginModel->getDepartment();
        $data['departments'] = $departments;
        $data['room']=$this->lang->line('choose_a_room');

        if (isset($_SESSION['uploadRoom'])) { //check if the session already assign room
            $roomOlder = $this->LoginModel->getRoomOlder($_SESSION['uploadRoom']);
            $data['room'] = $_SESSION['uploadRoom'];
            $data['roomOlder']=$roomOlder;
        }

        $data_form = $this->input->post('roomNumber');
        if ($data_form) { //choose room from popup and retrive the data of room and elders
            $roomNumber = $data_form;
            $roomOlder = $this->LoginModel->getRoomOlder($roomNumber);
            $data['room'] = $roomNumber;
            $data['roomOlder']=$roomOlder;
            $_SESSION['uploadRoom'] = $roomNumber;
        }

        $data_form = $this->input->post(array('password','profileID'));//post parmeter name, whether to apply xss filter
        if ($data_form) {
            $password = $data_form['password'];
            $ProfileID = $data_form['profileID'];
            $result = $this->LoginModel->getolder($ProfileID, $password);
            if ($data_form['password']) {
                if ($result) {
                    $_SESSION['uploadProfileID'] = $ProfileID;
                    redirect('AlbumController/uploadPhotos');
                } else {
                    $data['error'] = $this->lang->line('login_fail');
                }
            }
        }
        $this->load->view('pages/uploadLoginView', $data);
    }

    public function getRooms()
    {
        //run this function through ajax
        $data_form = $this->input->post(null, true);
        if ($data_form) {
            $department = $data_form['departmentName'];
            $roomList = $this->LoginModel->getRoomList($department);
            $data['roomList']=$roomList;
        }
        $this->load->view('modals/roomListView', $data); //load this modal
    }

    public function getLogin()
    {
        $data_form = $this->input->post(null, true);
        if ($data_form) {
            $profileID = $data_form['ProfileID'];
            //$roomList = $this->LoginModel->getRoomList($department);
            $data['profileID']=$profileID;
        }
        $this->load->view('modals/loginPopupView', $data);
    }
    public function photoAlbum () {
        $output = array(
            'photo'   => $this->FacebookModel->getPhoto($_SESSION['profileID'])
           );
        echo json_encode($output);
    }
  
}
