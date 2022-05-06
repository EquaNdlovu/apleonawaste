<?php
  class Rds extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->rdModel = $this->model('Rd');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Rds
      $rds = $this->rdModel->getRds();

      $data = [
        'rds' => $rds
      ];

      $this->view('rds/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'rd_code' => trim($_POST['rd_code']),
            'rd_name' => trim($_POST['rd_name']),
            'rd_description' => trim($_POST['rd_description']),
            'rd_name_err' => ''
        ];

        // Validate data

        if(empty($data['rd_name'])){
          $data['rd_name_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['rd_name_err'])){
          // Validated
          if($this->rdModel->addRd($data)){
            flash('rd_message', 'Rd Added');
            redirect('rds');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('rds/add', $data);
        }

      } else {
        $data = [
            'rd_code' => '',
            'rd_name' => '',
            'rd_description' => '',
        ];
  
        $this->view('rds/add', $data);
      }
    }

    public function edit($rd_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'rd_key' => $rd_key,
            'rd_code' => trim($_POST['rd_code']),
            'rd_name' => trim($_POST['rd_name']),
            'rd_description' => trim($_POST['rd_description']),
            'user_id' => $_SESSION['user_id'],
            'rd_name_err' => ''
        ];

        // Validate data

        if(empty($data['rd_name'])){
            $data['rd_name_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['rd_name_err'])){
          // Validated
          if($this->rdModel->updateRd($data)){
            flash('rd_message', 'Rd Updated');
            redirect('rds');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('rds/edit', $data);
        }

      } else {
        // Get existing rd from model
        $rd = $this->rdModel->getRdById($rd_key);

        /*/ Check for owner
        if($rd->user_id != $_SESSION['user_id']){
          redirect('rds');
        }*/

        $data = [
            'rd_key' => $rd_key,
            'rd_code' => $rd->rd_code,
            'rd_name' => $rd->rd_name,
            'rd_description' => $rd->rd_description,
        ];
  
        $this->view('rds/edit', $data);
      }
    }

    public function show($rd_key){
      $rd = $this->rdModel->getRdById($rd_key);
      //$user = $this->userModel->getUserById($rd->user_id);

      $data = [
        'rd' => $rd,
        //'user' => $user
      ];

      $this->view('rds/show', $data);
    }

    public function delete($rd_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing rd from model
        $rd = $this->rdModel->getRdById($rd_key);
        
        /*/ Check for owner
        if($rd->user_id != $_SESSION['user_id']){
          redirect('rds');
        }*/

        if($this->rdModel->deleteRd($rd_key)){
          flash('rd_message', 'Rd Removed');
          redirect('rds');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('rds');
      }
    }
  }