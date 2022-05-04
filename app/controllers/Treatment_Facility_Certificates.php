<?php
  class Treatment_Facility_Certificates extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->TFCModel = $this->model('Treatment_Facility_Certificate');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Certificates
      $Treatment_Facility_Certificates = $this->TFCModel->getTFC();

      $data = [
        'Treatment_Facility_Certificate' => $Treatment_Facility_Certificates
      ];

      $this->view('Treatment_Facility_Certificates/index', $data);
    }

    public function index_old(){
      // Get Certificates
      $Treatment_Facility_Certificates = $this->TFCModel->getTFC();

      $data = [
        'Treatment_Facility_Certificate' => $Treatment_Facility_Certificates
      ];

      $this->view('Treatment_Facility_Certificates/index_old', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'treatment_facility_certificates_facility_key' => trim($_POST['treatment_facility_certificates_facility_key']),
          'treatment_facility_certificates_date' => trim($_POST['treatment_facility_certificates_date']),
          'treatment_facility_certificates_docs' => '',
          'treatment_facility_certificates_customer' => trim($_POST['treatment_facility_certificates_customer']),
          'treatment_facility_certificates_owner' => trim($_POST['treatment_facility_certificates_owner']),
          'treatment_facility_certificates_country' => trim($_POST['treatment_facility_certificates_country']),
          'treatment_facility_certificates_facility_key_err' => '',
          'treatment_facility_certificates_date_err' => '',
          'treatment_facility_certificates_docs_err' => ''
        ];

      // Validate data
      if (empty($_POST['treatment_facility_certificates_date'])) {
        $data['treatment_facility_certificates_date'] = NULL;
      }
      if (empty($_FILES['file']['name'][0])) {
        $data['treatment_facility_certificates_docs_err'] = 'Documentation must be attached';
      } else {
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/Treatment_Facility_Certificates/files/' . $value)) {
            $data['treatment_facility_certificates_docs_err'] = 'File Already Exists';
          }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
          $filesize = $_FILES['file']['size'][$key];
          if ($filesize >= 10485760) {
            $data['treatment_facility_certificates_docs_err'] = 'File size is too large, 10MB Maximum';
          }
        }
      }
      // if (empty($data['treatment_facility_certificates_date'])) {
      //   $data['treatment_facility_certificates_date_err'] = 'Date Must be Entered';
      // }
      if (empty($data['treatment_facility_certificates_facility_key'])) {
        $data['treatment_facility_certificates_facility_key_err'] = 'Treatment Facility Must be Selected';
      }
      // Make sure no errors
      if (empty($data['treatment_facility_certificates_docs_err']) && empty($data['treatment_facility_certificates_date_err']) && empty($data['treatment_facility_certificates_facility_key_err'])) {
        // Validated
        if (empty($_FILES['file']['name'][0])) {
        $i = 0;
        $arr = array();
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        $var = 'add';
        foreach ($str_arr as $value) {
          $arr[$i] = $value;
          //$key = $data['treatment_facility_certificates_key'];
          $this->TFCModel->addFile($data, $arr, $i, $var);
        }
        $countfiles = count($_FILES['file']['name']);
        $values = "";
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
          $filename = $_FILES['file']['name'][$i];
          $values != "" && $values .= ",";
          $values .= $filename;
          // Upload file
          move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/treatment_facility_certificates/files/' . $filename);
        }
      }
        if ($this->TFCModel->addTFC($data)) {
          flash('TFC_message','TFC Added');
          redirect('Treatment_Facility_Certificates');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('Treatment_Facility_Certificates/add', $data);
      }

      } else {
        $data = [
          'treatment_facility_certificates_facility_key' => '',
          'treatment_facility_certificates_date' => '',
          'treatment_facility_certificates_docs' => '',
          'treatment_facility_certificates_customer' => '',
          'treatment_facility_certificates_owner' => '',
          'treatment_facility_certificates_country' => ''
        ];
  
        $this->view('Treatment_Facility_Certificates/add', $data);
      }
    }

    public function edit($treatment_facility_certificates_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $Treatment_Facility_Certificates = $this->TFCModel->getTFCById($treatment_facility_certificates_key);
        $var = $Treatment_Facility_Certificates->treatment_facility_certificates_docs;

      if (empty($_FILES['file']['name'][0])) {
        //die($var);

        $data = [
          'treatment_facility_certificates_key' => $treatment_facility_certificates_key,
          'treatment_facility_certificates_facility_key' => trim($_POST['treatment_facility_certificates_facility_key']),
          'treatment_facility_certificates_date' => trim($_POST['treatment_facility_certificates_date']),
          'treatment_facility_certificates_docs' => $var,
          'treatment_facility_certificates_docs_err' => ''
        ];

        // Validate data
      } else {

        $data = [
          'treatment_facility_certificates_key' => $treatment_facility_certificates_key,
          'treatment_facility_certificates_facility_key' => trim($_POST['treatment_facility_certificates_facility_key']),
          'treatment_facility_certificates_date' => trim($_POST['treatment_facility_certificates_date']),
          'treatment_facility_certificates_docs' => $_FILES['file']['name'],
          'treatment_facility_certificates_docs_err' => ''
        ];

        // Validate data

        //need to convert array back to string, will have to loop through here again as it could be multiple files
        $str = implode(",", $data['treatment_facility_certificates_docs']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/Treatment_Facility_Certificates/files/' . $value)) {
            $data['treatment_facility_certificates_docs_err'] = 'File Already Exists';
          }
        }

      }

        // Make sure no errors
        if(empty($data['treatment_facility_certificates_docs_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
          $i = 0;
          $arr = array();
          $str = implode(",", $data['treatment_facility_certificates_docs']);
          $str_arr = explode(",", $str);
          $var = '';
          foreach ($str_arr as $value) {
            $arr[$i] = $value;
            //$key = $data['treatment_facility_certificates_key'];
            $this->TFCModel->addFile($data, $arr, $i, $var);
          }
        }
          if($this->TFCModel->updateTFC($data)){
            flash('TFC_message', 'TFC Updated');
            redirect('Treatment_Facility_Certificates');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('Treatment_Facility_Certificates/edit', $data);
        }

      } else {
        // Get existing TFC from model
        $Treatment_Facility_Certificates = $this->TFCModel->getTFCById($treatment_facility_certificates_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        $data = [
          'treatment_facility_certificates_key' => $treatment_facility_certificates_key,
          'treatment_facility_certificates_facility_key' => $Treatment_Facility_Certificates->treatment_facility_certificates_facility_key,
          'treatment_facility_certificates_date' => $Treatment_Facility_Certificates->treatment_facility_certificates_date,
          'treatment_facility_certificates_docs' => $Treatment_Facility_Certificates->treatment_facility_certificates_docs
        ];
  
        $this->view('Treatment_Facility_Certificates/edit', $data);
      }
    }

    public function download(){
      $data = [
        'treatment_facility_certificates_docs' => $_GET['file']
      ];
      $this->TFCModel->downloadTFC($data);
    }

    public function delete_file(){
      $data = [
        'file_name' => $_GET['file'],
        'treatment_facility_certificates_key' => $_GET['key']
      ];

      if($this->TFCModel->deleteTFC($data)){
        redirect('Treatment_Facility_Certificates/edit/'.$data['treatment_facility_certificates_key']);
      } else {
        die('Something went wrong');
      }
    }
  }