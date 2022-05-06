<?php
  class User_List extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->user_listModel = $this->model('User_List');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get user_list
      $user_list = $this->rdModel->getuser_list();

      $data = [
        'user_list' => $user_list
      ];

      $this->view('user_list/index', $data);
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
            redirect('user_list');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('user_list/add', $data);
        }

      } else {
        $data = [
            'rd_code' => '',
            'rd_name' => '',
            'rd_description' => '',
        ];
  
        $this->view('user_list/add', $data);
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
            redirect('user_list');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('user_list/edit', $data);
        }

      } else {
        // Get existing rd from model
        $rd = $this->rdModel->getRdById($rd_key);

        /*/ Check for owner
        if($rd->user_id != $_SESSION['user_id']){
          redirect('user_list');
        }*/

        $data = [
            'rd_key' => $rd_key,
            'rd_code' => $rd->rd_code,
            'rd_name' => $rd->rd_name,
            'rd_description' => $rd->rd_description,
        ];
  
        $this->view('user_list/edit', $data);
      }
    }

    public function show($rd_key){
      $rd = $this->rdModel->getRdById($rd_key);
      //$user = $this->userModel->getUserById($rd->user_id);

      $data = [
        'rd' => $rd,
        //'user' => $user
      ];

      $this->view('user_list/show', $data);
    }

    public function delete($rd_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing rd from model
        $rd = $this->rdModel->getRdById($rd_key);
        
        /*/ Check for owner
        if($rd->user_id != $_SESSION['user_id']){
          redirect('user_list');
        }*/

        if($this->rdModel->deleteRd($rd_key)){
          flash('rd_message', 'Rd Removed');
          redirect('user_list');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('user_list');
      }
    }
  }