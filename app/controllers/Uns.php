<?php
  class Uns extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->unModel = $this->model('Un');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Uns
      $uns = $this->unModel->getUns();

      $data = [
        'uns' => $uns
      ];

      $this->view('uns/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'un_code' => trim($_POST['un_code']),
          'un_code_description' => trim($_POST['un_code_description']),
          'un_code_err' => ''
        ];

        // Validate data

        if(empty($data['un_code'])){
          $data['un_code_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['un_code_err'])){
          // Validated
          if($this->unModel->addUn($data)){
            flash('un_message', 'Un Added');
            redirect('uns');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('uns/add', $data);
        }

      } else {
        $data = [
          'un_code' => ''
        ];
  
        $this->view('uns/add', $data);
      }
    }

    public function edit($un_code_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'un_code_key' => $un_code_key,
          'un_code' => trim($_POST['un_code']),
          'un_code_description' => trim($_POST['un_code_description']),
          'user_id' => $_SESSION['user_id'],
          'un_code_err' => ''
        ];

        // Validate data

        if(empty($data['un_code'])){
            $data['un_code_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['un_code_err'])){
          // Validated
          if($this->unModel->updateUn($data)){
            flash('un_message', 'Un Updated');
            redirect('uns');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('uns/edit', $data);
        }

      } else {
        // Get existing un from model
        $un = $this->unModel->getUnById($un_code_key);

        /*/ Check for owner
        if($un->user_id != $_SESSION['user_id']){
          redirect('uns');
        }*/

        $data = [
          'un_code_key' => $un_code_key,
          'un_code' => $un->un_code,
          'un_code_description' => $un->un_code_description
        ];
  
        $this->view('uns/edit', $data);
      }
    }

    public function show($un_code_key){
      $un = $this->unModel->getUnById($un_code_key);
      //$user = $this->userModel->getUserById($un->user_id);

      $data = [
        'un' => $un,
        //'user' => $user
      ];

      $this->view('uns/show', $data);
    }

    public function delete($waste_un_code_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing un from model
        $un = $this->unModel->getUnById($un_code_key);
        
        /*/ Check for owner
        if($un->user_id != $_SESSION['user_id']){
          redirect('uns');
        }*/

        if($this->unModel->deleteUn($un_code_key)){
          flash('un_message', 'Un Removed');
          redirect('uns');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('uns');
      }
    }
  }