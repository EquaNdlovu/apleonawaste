<?php
  class Brokers extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->brokerModel = $this->model('Broker');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Brokers
      $brokers = $this->brokerModel->getBrokers();

      $data = [
        'brokers' => $brokers
      ];

      $this->view('brokers/index', $data);
    }

    public function index_test(){
      // Get Brokers
      $brokers = $this->brokerModel->getBrokers();

      $data = [
        'brokers' => $brokers
      ];

      $this->view('brokers/index_test', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_broker_name' => trim($_POST['waste_broker_name']),
          'waste_broker_country' => trim($_POST['waste_broker_country']),
          'waste_broker_name_err' => ''
        ];

        // Validate data

        if(empty($data['waste_broker_name'])){
          $data['waste_broker_name_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['waste_broker_name_err'])){
          // Validated
          if($this->brokerModel->addBroker($data)){
            flash('broker_message', 'Broker Added');
            redirect('brokers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('brokers/add', $data);
        }

      } else {
        $data = [
          'waste_broker_name' => '',
          'waste_broker_country' => ''
        ];
  
        $this->view('brokers/add', $data);
      }
    }

    public function update(){

      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      
      if(isset($_POST['updatedata'])) {
          $waste_broker_key = $_POST['waste_broker_key'];
          $waste_broker_name = $_POST['waste_broker_name'];
          $waste_broker_country = $_POST['waste_broker_country'];
      
          $sql = "UPDATE waste_broker SET waste_broker_name = '$waste_broker_name', waste_broker_country = '$waste_broker_country' WHERE waste_broker_key = '$waste_broker_key' ";
          $result = mysqli_query($db, $sql);
      
          if($result) {
             echo '<script> alert("Data Updated"); </script>';
             redirect('brokers/index');
          } else {
             echo '<script> alert("Data Not Updated"); </script>';
          }
      }
  }

    public function edit($waste_broker_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_broker_key' => $waste_broker_key,
          'waste_broker_name' => trim($_POST['waste_broker_name']),
          'waste_broker_country' => trim($_POST['waste_broker_country']),
          'waste_broker_name_err' => ''
        ];

        // Validate data

        if(empty($data['waste_broker_name'])){
            $data['waste_broker_name_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['waste_broker_name_err'])){
          // Validated
          if($this->brokerModel->updateBroker($data)){
            flash('broker_message', 'Broker Updated');
            redirect('brokers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('brokers/edit', $data);
        }

      } else {
        // Get existing broker from model
        $broker = $this->brokerModel->getBrokerById($waste_broker_key);

        /*/ Check for owner
        if($broker->user_id != $_SESSION['user_id']){
          redirect('brokers');
        }*/

        $data = [
          'waste_broker_key' => $waste_broker_key,
          'waste_broker_name' => $broker->waste_broker_name,
          'waste_broker_country' => $broker->waste_broker_country
        ];
  
        $this->view('brokers/edit', $data);
      }
    }

    public function show($waste_broker_key){
      $broker = $this->brokerModel->getBrokerById($waste_broker_key);
      //$user = $this->userModel->getUserById($broker->user_id);

      $data = [
        'broker' => $broker,
        //'user' => $user
      ];

      $this->view('brokers/show', $data);
    }

    public function delete($waste_broker_key){
      //if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing broker from model
        $broker = $this->brokerModel->getBrokerById($waste_broker_key);
        
        /*/ Check for owner
        if($broker->user_id != $_SESSION['user_id']){
          redirect('brokers');
        }*/

        if($this->brokerModel->deleteBroker($waste_broker_key)){
          flash('broker_message', 'Broker Removed');
          redirect('brokers/index_test');
        } else {
          die('Something went wrong');
        }
      // } else {
      //   redirect('brokers');
      // }
    }
  }