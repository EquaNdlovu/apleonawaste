<?php
  class Additional_Docs extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->ADModel = $this->model('Additional_Doc');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Certificates
      $Additional_Docs = $this->ADModel->getAD();

      $data = [
        'Additional_Doc' => $Additional_Docs
      ];

      $this->view('Additional_Docs/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'additional_docs_type' => trim($_POST['additional_docs_type']),
          'additional_docs_comments' => trim($_POST['additional_docs_comments']),
          'additional_docs_customer' => trim($_POST['additional_docs_customer']),
          'additional_docs_country' => trim($_POST['additional_docs_country']),
          'additional_docs_files' => '',
          'additional_docs_files_err' => ''
        ];

      // Validate data
      if (empty($_FILES['file']['name'][0])) {
        $data['additional_docs_files_err'] = 'Documentation must be attached';
      } else {
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/Additional_Docs/files/' . $value)) {
            $data['additional_docs_files_err'] = 'File Already Exists';
          }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
          $filesize = $_FILES['file']['size'][$key];
          if ($filesize >= 10485760) {
            $data['additional_docs_files_err'] = 'File size is too large, 10MB Maximum';
          }
        }
      }
      // Make sure no errors
      if (empty($data['additional_docs_files_err'])) {
        // Validated
        if (!empty($_FILES['file']['name'][0])) {
        $i = 0;
        $arr = array();
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        $var = 'add';
        foreach ($str_arr as $value) {
          $arr[$i] = $value;
          //$key = $data['treatment_facility_certificates_key'];
          $this->ADModel->addFile($data, $arr, $i, $var);
        }
        $countfiles = count($_FILES['file']['name']);
        $values = "";
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
          $filename = $_FILES['file']['name'][$i];
          $values != "" && $values .= ",";
          $values .= $filename;
          // Upload file
          move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/Additional_Docs/files/' . $filename);
        }
      }
        if ($this->ADModel->addAD($data)) {
          flash('AD_message','AD Added');
          redirect('Additional_Docs');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('Additional_Docs/add', $data);
      }

      } else {
        $data = [
          'additional_docs_type' => '',
          'additional_docs_comments' => '',
          'additional_docs_customer' => '',
          'additional_docs_country' => '',
          'additional_docs_file' => ''
        ];
  
        $this->view('Additional_Docs/add', $data);
      }
    }

    public function edit($additional_docs_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'additional_docs_key' => $additional_docs_key,
          'additional_docs_type' => trim($_POST['additional_docs_type']),
          'additional_docs_comments' => trim($_POST['additional_docs_comments']),
          'additional_docs_customer' => trim($_POST['additional_docs_customer']),
          'additional_docs_country' => trim($_POST['additional_docs_country']),
          'additional_docs_file' => '',
          'additional_docs_file_err' => ''
        ];

        // Validate data

        //need to convert array back to string, will have to loop through here again as it could be multiple files
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/Additional_Docs/files/' . $value)) {
            $data['additional_docs_file_err'] = 'File Already Exists';
          }
        }


        // Make sure no errors
        if(empty($data['additional_docs_file_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $data['license_certificates_docs']);
            $str_arr = explode(",", $str);
            $var = '';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->ADModel->addFile($data, $arr, $i, $var);
            }
            $countfiles = count($_FILES['file']['name']);
            $values = "";
            // Looping all files
            for ($i = 0; $i < $countfiles; $i++) {
              $filename = $_FILES['file']['name'][$i];
              $values != "" && $values .= ",";
              $values .= $filename;
              // Upload file
              move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/Additional_Docs/files/' . $filename);
            }
          } 
          if($this->ADModel->updateAD($data)){
            flash('AD_message', 'AD Updated');
            redirect('Additional_Docs');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('Additional_Docs/edit', $data);
        }

      } else {
        // Get existing TFC from model
        $Additional_Docs = $this->ADModel->getADById($additional_docs_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        $data = [
          'additional_docs_key' => $additional_docs_key,
          'additional_docs_type' => $Additional_Docs->additional_docs_type,
          'additional_docs_comments' => $Additional_Docs->additional_docs_comments,
          'additional_docs_customer' => $Additional_Docs->additional_docs_customer,
          'additional_docs_country' => $Additional_Docs->additional_docs_country,
        ];
  
        $this->view('Additional_Docs/edit', $data);
      }
    }

    public function download(){
      $data = [
        'file_name' => $_GET['file']
      ];
      $this->ADModel->downloadAD($data);
    }

    public function delete_file(){
      $data = [
        'file_name' => $_GET['file'],
        'additional_docs_key' => $_GET['key']
      ];

      if($this->ADModel->deleteAD($data)){
        redirect('Additional_Docs/edit/'.$data['additional_docs_key']);
      } else {
        die('Something went wrong');
      }
    }
  }