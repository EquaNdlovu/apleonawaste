<?php
  class Collectors extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->collectorModel = $this->model('Collector');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Collectors
      $collectors = $this->collectorModel->getCollectors();

      $data = [
        'collectors' => $collectors
      ];

      $this->view('collectors/index', $data);
    }

    public function index_test(){
      // Get Collectors
      $collectors = $this->collectorModel->getCollectors();

      $data = [
        'collectors' => $collectors
      ];

      $this->view('collectors/index_test', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_collector_name' => trim($_POST['waste_collector_name']),
          'waste_collector_country' => trim($_POST['waste_collector_country']),
          'waste_collector_name_err' => '',
          'waste_collector_country_err' => '',
          'waste_collector_permit_number_err' => ''
        ];

        // Validate data

        if(empty($data['waste_collector_name'])){
          $data['waste_collector_name_err'] = 'Please enter body text';
        }
        if(empty($data['waste_collector_country'])){
          $data['waste_collector_country_err'] = 'Please enter country';
        }

        // Make sure no errors
        if(empty($data['waste_collector_name_err']) && empty($data['waste_collector_country_err'])){
          // Validated
          if($this->collectorModel->addCollector($data)){
            flash('collector_message', 'Collector Added');
            redirect('collectors');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('collectors/add', $data);
        }

      } else {
        $data = [
          'waste_collector_name' => '',
          'waste_collector_country' => '',
          'waste_collector_permit_number' => ''
        ];
  
        $this->view('collectors/add', $data);
      }
    }

    public function update(){

      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      
      if(isset($_POST['updatedata'])) {
          $waste_collector_key = $_POST['waste_collector_key'];
          $waste_collector_name = $_POST['waste_collector_name'];
          $waste_collector_country = $_POST['waste_collector_country'];
      
          $sql = "UPDATE waste_collector SET waste_collector_name = '$waste_collector_name', waste_collector_country = '$waste_collector_country' WHERE waste_collector_key = '$waste_collector_key' ";
          $result = mysqli_query($db, $sql);
      
          if($result) {
             echo '<script> alert("Data Updated"); </script>';
             redirect('brokers/index');
          } else {
             echo '<script> alert("Data Not Updated"); </script>';
          }
      }
  }

    public function edit($waste_collector_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_collector_key' => $waste_collector_key,
          'waste_collector_name' => trim($_POST['waste_collector_name']),
          'waste_collector_country' => trim($_POST['waste_collector_country']),
          'waste_collector_permit_number' => trim($_POST['waste_collector_permit_number']),
          'user_id' => $_SESSION['user_id'],
          'waste_collector_name_err' => '',
          'waste_collector_country_err' => '',
          'waste_collector_permit_number_err' => ''
        ];

        // Validate data

        if(empty($data['waste_collector_name'])){
            $data['waste_collector_name_err'] = 'Please enter body text';
          }
        if(empty($data['waste_collector_country'])){
            $data['waste_collector_country_err'] = 'Please enter country';
          }
        if(empty($data['waste_collector_permit_number'])){
            $data['waste_collector_permit_number_err'] = 'Please enter permit number';
          }

        // Make sure no errors
        if(empty($data['waste_collector_name_err']) && empty($data['waste_collector_country_err']) && empty($data['waste_collector_permit_number_err'])){
          // Validated
          if($this->collectorModel->updateCollector($data)){
            flash('collector_message', 'Collector Updated');
            redirect('collectors');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('collectors/edit', $data);
        }

      } else {
        // Get existing collector from model
        $collector = $this->collectorModel->getCollectorById($waste_collector_key);

        /*/ Check for owner
        if($collector->user_id != $_SESSION['user_id']){
          redirect('collectors');
        }*/

        $data = [
          'waste_collector_key' => $waste_collector_key,
          'waste_collector_name' => $collector->waste_collector_name,
          'waste_collector_country' => $collector->waste_collector_country,
          'waste_collector_permit_number' => $collector->waste_collector_permit_number
        ];
  
        $this->view('collectors/edit', $data);
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
      //if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
      // } else {
      //   redirect('collectors');
      // }
    }
  }