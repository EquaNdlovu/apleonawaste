<?php
  class License_Certificates extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->LCModel = $this->model('License_Certificate');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Certificates
      $License_Certificates = $this->LCModel->getLC();

      $data = [
        'License_Certificate' => $License_Certificates
      ];

      $this->view('License_Certificates/index', $data);
    }

    public function index_old(){
      // Get Certificates
      $License_Certificates = $this->LCModel->getLC();

      $data = [
        'License_Certificate' => $License_Certificates
      ];

      $this->view('License_Certificates/index_old', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'license_certificates_vendor' => trim($_POST['license_certificates_vendor']),
          'license_certificates_date' => trim($_POST['license_certificates_date']),
          'license_certificates_type' => trim($_POST['license_certificates_type']),
          'license_certificates_docs' => $_FILES['file']['name'],
          'license_certificates_customer' => trim($_POST['license_certificates_customer']),
          'license_certificates_owner' => trim($_POST['license_certificates_owner']),
          'license_certificates_country' => trim($_POST['license_certificates_country']),
          'license_certificates_date_err' => '',
          'license_certificates_docs_err' => ''
        ];

      // Validate data
      if (empty($_FILES['file']['name'][0])) {
        $data['license_certificates_docs_err'] = 'Documentation must be attached';
      } else {
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/License_Certificates/files/' . $value)) {
            $data['license_certificates_docs_err'] = 'File Already Exists';
          }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
          $filesize = $_FILES['file']['size'][$key];
          if ($filesize >= 10485760) {
            $data['license_certificates_docs_err'] = 'File size is too large, 10MB Maximum';
          }
        }
      }
      if (empty($data['license_certificates_date'])) {
        $data['license_certificates_date_err'] = 'Date Must be Entered';
      }
      // Make sure no errors
      if (empty($data['license_certificates_docs_err']) && empty($data['license_certificates_date_err'])) {
        // Validated
        $i = 0;
        $arr = array();
        $str = implode(",", $_FILES['file']['name']);
        $str_arr = explode(",", $str);
        $var = 'add';
        foreach ($str_arr as $value) {
          $arr[$i] = $value;
          //$key = $data['treatment_facility_certificates_key'];
          $this->LCModel->addFile($data, $arr, $i, $var);
        }
        if ($this->LCModel->addLC($data)) {
          flash('LC_message','LC Added');
          redirect('License_Certificates');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('License_Certificates/add', $data);
      }

      } else {
        $data = [
          'license_certificates_vendor' => '',
          'license_certificates_date' => '',
          'license_certificates_type' => '',
          'license_certificates_docs' => '',
          'license_certificates_customer' => '',
          'license_certificates_owner' => '',
          'license_certificates_country' => ''
        ];
  
        $this->view('License_Certificates/add', $data);
      }
    }

    public function edit($license_certificates_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $License_Certificates = $this->LCModel->getLCById($license_certificates_key);
        $var = $License_Certificates->license_certificates_docs;

      if (empty($_FILES['file']['name'][0])) {

        $data = [
          'license_certificates_key' => $license_certificates_key,
          'license_certificates_vendor' => trim($_POST['license_certificates_vendor']),
          'license_certificates_date' => trim($_POST['license_certificates_date']),
          'license_certificates_type' => trim($_POST['license_certificates_type']),
          'license_certificates_docs' => $var,
          'license_certificates_customer' => trim($_POST['license_certificates_customer']),
          'license_certificates_owner' => trim($_POST['license_certificates_owner']),
          'license_certificates_country' => trim($_POST['license_certificates_country']),
          'license_facility_certificates_docs_err' => ''
        ];

        // Validate data
      } else {

        $data = [
          'license_certificates_key' => $license_certificates_key,
          'license_certificates_vendor' => trim($_POST['license_certificates_vendor']),
          'license_certificates_date' => trim($_POST['license_certificates_date']),
          'license_certificates_type' => trim($_POST['license_certificates_type']),
          'license_certificates_docs' => $_FILES['file']['name'],
          'license_certificates_customer' => trim($_POST['license_certificates_customer']),
          'license_certificates_owner' => trim($_POST['license_certificates_owner']),
          'license_certificates_docs_err' => ''
        ];

        // Validate data

        //need to convert array back to string, will have to loop through here again as it could be multiple files
        $str = implode(",", $data['license_certificates_docs']);
        $str_arr = explode(",", $str);
        foreach ($str_arr as $value) {
          if (file_exists(APPROOT . '/views/License_Certificates/files/' . $value)) {
            $data['license_certificates_docs_err'] = 'File Already Exists';
          }
        }

      }

        // Make sure no errors
        if(empty($data['license_certificates_docs_err'])){
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
              $this->LCModel->addFile($data, $arr, $i, $var);
            }
          } 
          if($this->LCModel->updateLC($data)){
            flash('LC_message', 'LC Updated');
            redirect('License_Certificates');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('License_Certificates/edit', $data);
        }

      } else {
        // Get existing TFC from model
        $License_Certificates = $this->LCModel->getLCById($license_certificates_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        $data = [
          'license_certificates_key' => $license_certificates_key,
          'license_certificates_vendor' => $License_Certificates->license_certificates_vendor,
          'license_certificates_date' => $License_Certificates->license_certificates_date,
          'license_certificates_type' => $License_Certificates->license_certificates_type,
          'license_certificates_docs' => $License_Certificates->license_certificates_docs,
          'license_certificates_customer' => $License_Certificates->license_certificates_customer,
          'license_certificates_owner' => $License_Certificates->license_certificates_owner
        ];
  
        $this->view('License_Certificates/edit', $data);
      }
    }

    public function download(){
      $data = [
        'license_certificates_docs' => $_GET['file']
      ];
      $this->LCModel->downloadLC($data);
    }

    public function delete_file(){
      $data = [
        'file_name' => $_GET['file'],
        'license_certificates_key' => $_GET['key']
      ];

      if($this->LCModel->deleteLC($data)){
        redirect('License_Certificates/edit/'.$data['license_certificates_key']);
      } else {
        die('Something went wrong');
      }
    }
  }