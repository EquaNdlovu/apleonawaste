<?php
  class Certificates extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->certificateModel = $this->model('Certificate');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get certificates
      $certificates = $this->certificateModel->getcertificates();

      $data = [
        'certificates' => $certificates
      ];

      $this->view('certificates/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'collector_certificates_collector_key' => trim($_POST['collector_certificates_collector_key']),
          'collector_certificates_type' => trim($_POST['collector_certificates_type']),
          'collector_certificates_permit_no' => trim($_POST['collector_certificates_permit_no']),
          'collector_certificates_date' => trim($_POST['collector_certificates_date']),
          'collector_certificates_file' => $_FILES['file']['name'],
          'collector_certificates_collector_key_err' => '',
          'collector_certificates_type_err' => '',
          'collector_certificates_permit_no_err' => '',
          'collector_certificates_date_err' => '',
          'collector_certificates_file_err' => ''
        ];

        if (file_exists(APPROOT . '/views/certificates/files/'.$data['collector_certificates_file'])) {
          $data['collector_certificates_file_err'] = 'File Already Exists';
        }
        if (empty($data['collector_certificates_file'])) {
          $data['collector_certificates_file_err'] = 'Documentation must be attached';
        }
        if(empty($data['collector_certificates_type'])){
          $data['collector_certificates_type_err'] = 'Please enter Permit Type';
        }
        if(empty($data['collector_certificates_permit_no'])){
          $data['collector_certificates_permit_no_err'] = 'Please enter Permit Number';
        }
        if(empty($data['collector_certificates_date'])){
          $data['collector_certificates_date_err'] = 'Please enter Expiry Date';
        }

        // Make sure no errors
        if(empty($data['collector_certificates_file_err']) && empty($data['collector_certificates_type_err']) && empty($data['collector_certificates_permit_no_err']) && empty($data['collector_certificates_date_err'])){
          // Validated
          if($this->certificateModel->addcertificate($data)){
            flash('certificates_message', 'Certificate Added');
            redirect('certificates');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('certificates/add', $data);
        }

      } else {
        $data = [
          'collector_certificates_collector_key' => '',
          'collector_certificates_type' => '',
          'collector_certificates_permit_no' => '',
          'collector_certificates_date' => '',
          'collector_certificates_file' => ''
        ];
  
        $this->view('certificates/add', $data);
      }
    }

    public function edit($collector_certificates_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $Permit_File = $this->certificateModel->getcertificateById($collector_certificates_key);
        $var = $Permit_File->collector_certificates_file;

      if (empty($_FILES['file']['name'])) {
      $data = [
        'collector_certificates_key' => $collector_certificates_key,
        'collector_certificates_collector_key' => trim($_POST['collector_certificates_collector_key']),
        'collector_certificates_type' => trim($_POST['collector_certificates_type']),
        'collector_certificates_permit_no' => trim($_POST['collector_certificates_permit_no']),
        'collector_certificates_date' => trim($_POST['collector_certificates_date']),
        'collector_certificates_file' => $var,
        'collector_certificates_collector_key_err' => '',
        'collector_certificates_type_err' => '',
        'collector_certificates_permit_no_err' => '',
        'collector_certificates_date_err' => ''
      ];

    // Validate data

    if (empty($data['collector_certificates_permit_no'])) {
      $data['collector_certificates_permit_no_err'] = 'Please enter Permit Number';
    }
    if (empty($data['collector_certificates_type'])) {
      $data['collector_certificates_type_err'] = 'Please enter Permit Type';
    }
    if (empty($data['collector_certificates_date'])) {
      $data['collector_certificates_date_err'] = 'Please enter Permit Expiry';
    }
      
      } else {
        $data = [
          'collector_certificates_key' => $collector_certificates_key,
          'collector_certificates_collector_key' => trim($_POST['collector_certificates_collector_key']),
          'collector_certificates_type' => trim($_POST['collector_certificates_type']),
          'collector_certificates_permit_no' => trim($_POST['collector_certificates_permit_no']),
          'collector_certificates_date' => trim($_POST['collector_certificates_date']),
          'collector_certificates_file' => $_FILES['file']['name'],
          'collector_certificates_type_err' => '',
          'collector_certificates_permit_no_err' => '',
          'collector_certificates_date_err' => '',
          'collector_certificates_file_err' => ''
        ];
      // Validate data

      if (file_exists(APPROOT . '/views/certificates/files/'.$data['collector_certificates_file'])) {
        $data['collector_certificates_file_err'] = 'File Already Exists';
      }
      if (empty($data['collector_certificates_permit_no'])) {
        $data['collector_certificates_permit_no_err'] = 'Please enter Permit Number';
      }
      if (empty($data['collector_certificates_type'])) {
        $data['collector_certificates_type_err'] = 'Please enter Permit Type';
      }
      if (empty($data['collector_certificates_date'])) {
        $data['collector_certificates_date_err'] = 'Please enter Permit Expiry';
      }

    }

        // Make sure no errors
        if(empty($data['collector_certificates_permit_no_err']) && empty($data['collector_certificates_type_err']) && empty($data['collector_certificates_file_err'])){
          // Validated
          if($this->certificateModel->updatecertificate($data)){
            flash('collector_message', 'Collector Updated');
            redirect('certificates');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('certificates/edit', $data);
        }

      } else {
        // Get existing collector from model
        $collector = $this->certificateModel->getcertificateById($collector_certificates_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('certificates');
        }*/

        $data = [
          'collector_certificates_key' => $collector_certificates_key,
          'collector_certificates_collector_key' => $collector->collector_certificates_collector_key,
          'collector_certificates_type' => $collector->collector_certificates_type,
          'collector_certificates_permit_no' => $collector->collector_certificates_permit_no,
          'collector_certificates_date' => $collector->collector_certificates_date,
          'collector_certificates_file' => $collector->collector_certificates_file
        ];
  
        $this->view('certificates/edit', $data);
      }
    }
     
    public function download(){
      $data = [
        'collector_certificates_file' => $_GET['file']
      ];
      $this->certificateModel->downloadcertificate($data);
    }

    public function delete_file(){
      $data = [
        'collector_certificates_file' => $_GET['file'],
        'collector_certificates_key' => $_GET['key']
      ];

      if($this->certificateModel->deleteCertificateFile($data)){
        redirect('certificates/edit/'.$data['collector_certificates_key']);
      } else {
        die('Something went wrong');
      }
    }

    public function show($collector_certificates_key){
      $certificate = $this->certificateModel->getCertificateById($collector_certificates_key);
      //$user = $this->userModel->getUserById($collector->user_id);

      $data = [
        'certificate' => $certificate,
        //'user' => $user
      ];

      $this->view('certificates/show', $data);
    }

    public function delete($collector_certificates_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collector from model
        $certificate = $this->certificateModel->getCertificateById($collector_certificates_key);
        
        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('certificates');
        }*/

        if($this->certificateModel->deleteCertificate($collector_certificates_key)){
          flash('certificate_message', 'Certificate Removed');
          redirect('certificates');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('certificates');
      }
    }
  }