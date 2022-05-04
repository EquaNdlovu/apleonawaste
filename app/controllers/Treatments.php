<?php
  class Treatments extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->treatmentModel = $this->model('Treatment');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Treatments
      $treatments = $this->treatmentModel->getTreatments();

      $data = [
        'treatments' => $treatments
      ];

      $this->view('treatments/index', $data);
    }

    public function index_test(){
      // Get Treatments
      $treatments = $this->treatmentModel->getTreatments();

      $data = [
        'treatments' => $treatments
      ];

      $this->view('treatments/index_test', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'treatment_facility_name' => trim($_POST['treatment_facility_name']),
          'treatment_facility_country' => trim($_POST['treatment_facility_country']),
          'treatment_facility_name_err' => ''
        ];

        // Validate data

        if(empty($data['treatment_facility_name'])){
          $data['treatment_facility_name_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['treatment_facility_name_err'])){
          // Validated
          if($this->treatmentModel->addTreatment($data)){
            flash('treatment_message', 'Treatment Added');
            redirect('treatments');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('treatments/add', $data);
        }

      } else {
        $data = [
          'treatment_facility_name' => ''
        ];
  
        $this->view('treatments/add', $data);
      }
    }

    public function update(){

      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      
      if(isset($_POST['updatedata'])) {
          $treatment_facility_key = $_POST['treatment_facility_key'];
          $treatment_facility_name = $_POST['treatment_facility_name'];
          $treatment_facility_country = $_POST['treatment_facility_country'];
      
          $sql = "UPDATE treatment_facility SET treatment_facility_name = '$treatment_facility_name', treatment_facility_country = '$treatment_facility_country' WHERE treatment_facility_key = '$treatment_facility_key' ";
          $result = mysqli_query($db, $sql);
      
          if($result) {
             echo '<script> alert("Data Updated"); </script>';
             redirect('brokers/index');
          } else {
             echo '<script> alert("Data Not Updated"); </script>';
          }
      }
  }

    public function edit($treatment_facility_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'treatment_facility_key' => $treatment_facility_key,
          'treatment_facility_name' => trim($_POST['treatment_facility_name']),
          'user_id' => $_SESSION['user_id'],
          'treatment_facility_name_err' => ''
        ];

        // Validate data

        if(empty($data['treatment_facility_name'])){
            $data['treatment_facility_name_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['treatment_facility_name_err'])){
          // Validated
          if($this->treatmentModel->updateTreatment($data)){
            flash('treatment_message', 'Treatment Updated');
            redirect('treatments');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('treatments/edit', $data);
        }

      } else {
        // Get existing treatment from model
        $treatment = $this->treatmentModel->getTreatmentById($treatment_facility_key);

        /*/ Check for owner
        if($treatment->user_id != $_SESSION['user_id']){
          redirect('treatments');
        }*/

        $data = [
          'treatment_facility_key' => $treatment_facility_key,
          'treatment_facility_name' => $treatment->treatment_facility_name
        ];
  
        $this->view('treatments/edit', $data);
      }
    }

    public function show($treatment_facility_key){
      $treatment = $this->treatmentModel->getTreatmentById($treatment_facility_key);
      //$user = $this->userModel->getUserById($treatment->user_id);

      $data = [
        'treatment' => $treatment,
        //'user' => $user
      ];

      $this->view('treatments/show', $data);
    }

    public function delete($treatment_facility_key){
      //if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing treatment from model
        $treatment = $this->treatmentModel->getTreatmentById($treatment_facility_key);
        
        /*/ Check for owner
        if($treatment->user_id != $_SESSION['user_id']){
          redirect('treatments');
        }*/

        if($this->treatmentModel->deleteTreatment($treatment_facility_key)){
          flash('treatment_message', 'Treatment Removed');
          redirect('treatments');
        } else {
          die('Something went wrong');
        }
      // } else {
      //   redirect('treatments');
      // }
    }
  }