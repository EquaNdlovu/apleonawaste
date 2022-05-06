<?php
  class Ewcs extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->ewcModel = $this->model('Ewc');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Ewcs
      $ewcs = $this->ewcModel->getEwcs();

      $data = [
        'ewcs' => $ewcs
      ];

      $this->view('ewcs/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'ewc_code_numberic' => trim($_POST['ewc_code_numberic']),
            'ewc_code' => trim($_POST['ewc_code']),
            'ewc_description' => trim($_POST['ewc_description']),
            'ewc_indication_of_danger' => trim($_POST['ewc_indication_of_danger']),
            'ewc_code_err' => ''
        ];

        // Validate data

        if(empty($data['ewc_code'])){
          $data['ewc_code_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['ewc_code_err'])){
          // Validated
          if($this->ewcModel->addEwc($data)){
            flash('ewc_message', 'Ewc Added');
            redirect('ewcs');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('ewcs/add', $data);
        }

      } else {
        $data = [
            'ewc_code_numberic' => '',
            'ewc_code' => '',
            'ewc_description' => '',
            'ewc_indication_of_danger' => '',
        ];
  
        $this->view('ewcs/add', $data);
      }
    }

    public function edit($ewc_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'ewc_key' => $ewc_key,
            'ewc_code_numberic' => trim($_POST['ewc_code_numberic']),
            'ewc_code' => trim($_POST['ewc_code']),
            'ewc_description' => trim($_POST['ewc_description']),
            'ewc_indication_of_danger' => trim($_POST['ewc_indication_of_danger']),
            'user_id' => $_SESSION['user_id'],
            'ewc_code_err' => ''
        ];

        // Validate data

        if(empty($data['ewc_code'])){
            $data['ewc_code_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['ewc_code_err'])){
          // Validated
          if($this->ewcModel->updateEwc($data)){
            flash('ewc_message', 'Ewc Updated');
            redirect('ewcs');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('ewcs/edit', $data);
        }

      } else {
        // Get existing ewc from model
        $ewc = $this->ewcModel->getEwcById($ewc_key);

        /*/ Check for owner
        if($ewc->user_id != $_SESSION['user_id']){
          redirect('ewcs');
        }*/

        $data = [
            'ewc_key' => $ewc_key,
            'ewc_code_numberic' => $ewc->ewc_code_numberic,
            'ewc_code' => $ewc->ewc_code,
            'ewc_description' => $ewc->ewc_description,
            'ewc_indication_of_danger' => $ewc->ewc_indication_of_danger,
        ];
  
        $this->view('ewcs/edit', $data);
      }
    }

    public function show($ewc_key){
      $ewc = $this->ewcModel->getEwcById($ewc_key);
      //$user = $this->userModel->getUserById($ewc->user_id);

      $data = [
        'ewc' => $ewc,
        //'user' => $user
      ];

      $this->view('ewcs/show', $data);
    }

    public function delete($ewc_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing ewc from model
        $ewc = $this->ewcModel->getEwcById($ewc_key);
        
        /*/ Check for owner
        if($ewc->user_id != $_SESSION['user_id']){
          redirect('ewcs');
        }*/

        if($this->ewcModel->deleteEwc($ewc_key)){
          flash('ewc_message', 'Ewc Removed');
          redirect('ewcs');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('ewcs');
      }
    }
  }