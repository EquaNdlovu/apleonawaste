<?php
  class WTF_Docs extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->WTFModel = $this->model('WTF_Doc');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Collectors
      $WTF_Doc = $this->WTFModel->getWTF();

      $data = [
        'WTF_Docs' => $WTF_Doc
      ];

      $this->view('WTF_Docs/index', $data);
    }

    public function index_old(){
      // Get Collectors
      $WTF_Doc = $this->WTFModel->getWTF();

      $data = [
        'WTF_Docs' => $WTF_Doc
      ];

      $this->view('WTF_Docs/index_old', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'wtf_client' => trim($_POST['wtf_client']),
          'wtf_site' => trim($_POST['wtf_site']),
          'wtf_date' => trim($_POST['wtf_date']),
          'wtf_documentation' => $_FILES['file']['name'],
          'wtf_number' => trim($_POST['wtf_number']),
          'wtf_owner' => trim($_POST['wtf_owner']),
          'wtf_country' => trim($_POST['wtf_country']),
          'wtf_customer' => trim($_POST['wtf_customer']),
          'wtf_date_err' => '',
          'wtf_documentation_err' => ''
        ];

      // Validate data
      if (empty($_FILES['file']['name'][0])) {
        $data['wtf_documentation_err'] = 'Documentation must be attached';
      } else {
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/WTF_Docs/files/' . $value)) {
            $data['wtf_documentation_err'] = 'File Already Exists';
          }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
          $filesize = $_FILES['file']['size'][$key];
          if ($filesize >= 10485760) {
            $data['wtf_documentation_err'] = 'File size is too large, 10MB Maximum';
          }
        }
      }
      if (empty($data['wtf_date'])) {
        $data['wtf_date_err'] = 'Date Must be Entered';
      }
      // Make sure no errors
      if (empty($data['wtf_documentation_err']) && empty($data['wtf_date_err'])) {
        // Validated
        //var_dump($data);
        $i = 0;
        $arr = array();
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        $var = 'add';
        foreach ($str_arr as $value) {
          $arr[$i] = $value;
          //$key = $data['treatment_facility_certificates_key'];
          $this->WTFModel->addFile($data, $arr, $i, $var);
        }
        if ($this->WTFModel->addWTF($data)) {
          flash('WTF_message','WTF Added');
          redirect('WTF_Docs');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('WTF_Docs/add', $data);
      }

      } else {
        $data = [
          'wtf_client' => '',
          'wtf_site' => '',
          'wtf_date' => '',
          'wtf_documentation' => '',
          'wtf_number' => '',
          'wtf_owner' => '',
          'wtf_country' => '',
          'wtf_customer' => ''
        ];
  
        $this->view('WTF_Docs/add', $data);
      }
    }

    public function edit($wtf_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $WTF_Doc = $this->WTFModel->getWTFById($wtf_key);
        $var = $WTF_Doc->wtf_documentation;

        $data = [
          'wtf_key' => $wtf_key,
          'wtf_client' => trim($_POST['wtf_client']),
          'wtf_site' => trim($_POST['wtf_site']),
          'wtf_date' => trim($_POST['wtf_date']),
          'wtf_documentation' => $_FILES['file']['name'],
          'wtf_number' => trim($_POST['wtf_number']),
          'wtf_site_err' => '',
          'wtf_documentation_err' => ''
        ];
        var_dump($data);
        // Validate data

        if (empty($data['wtf_site'])) {
          $data['wtf_site_err'] = 'Please enter WTF Site';
        }
        if(empty($data['wtf_date'])){
          $data['wtf_date_err'] = 'Please enter WTF Date';
        }
        //need to convert array back to string, will have to loop through here again as it could be multiple files
        $str = implode(",", $data['wtf_documentation']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/WTF_Docs/files/' . $value)) {
            //$data['wtf_documentation_err'] = 'File Already Exists';
          }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
          $filesize = $_FILES['file']['size'][$key];
          if ($filesize >= 10485760) {
            $data['wtf_documentation_err'] = 'File size is too large, 10MB Maximum';
          }
        }

      

        // Make sure no errors
        if(empty($data['wtf_site_err']) && empty($data['wtf_documentation_err']) && empty($data['wtf_date_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $data['wtf_documentation']);
            $str_arr = explode(",", $str);
            $var = '';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->WTFModel->addFile($data, $arr, $i, $var);
            }
          } 
          if($this->WTFModel->updateWTF($data)){
            flash('wtf_message', 'WTF Updated');
            redirect('WTF_Docs');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('WTF_Docs/edit', $data);
        }

      } else {
        // Get existing WTF from model
        $WTF_Doc = $this->WTFModel->getWTFById($wtf_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        $data = [
          'wtf_key' => $wtf_key,
          'wtf_client' => $WTF_Doc->wtf_client,
          'wtf_site' => $WTF_Doc->wtf_site,
          'wtf_date' => $WTF_Doc->wtf_date,
          'wtf_documentation' => $WTF_Doc->wtf_documentation,
          'wtf_number' => $WTF_Doc->wtf_number
        ];
  
        $this->view('WTF_Docs/edit', $data);
      }
    }

    public function download(){
      $data = [
        'wtf_documentation' => $_GET['file']
      ];
      $this->WTFModel->downloadWTF($data);
    }

    public function delete_file(){
      $data = [
        'wtf_documentation' => $_GET['file'],
        'wtf_key' => $_GET['key']
      ];

      if($this->WTFModel->deleteWTF($data)){
        redirect('WTF_Docs/edit/'.$data['wtf_key']);
      } else {
        die('Something went wrong');
      }
    }

    public function show($waste_collector_key){
      $collector = $this->collectorModel->getCollectorById($waste_collector_key);
      //$user = $this->userModel->getUserById($collector->user_id);

      $data = [
        'collector' => $collector,
        //'user' => $user
      ];

      $this->view('collectors/show', $data);
    }

    public function delete($waste_collector_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collector from model
        $collector = $this->collectorModel->getCollectorById($waste_collector_key);
        
        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        if($this->collectorModel->deleteCollector($waste_collector_key)){
          flash('collector_message', 'Collector Removed');
          redirect('collectors');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('collectors');
      }
    }
  }