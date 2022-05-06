<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    

    public function forgot_password(){
      
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'email_err'=> ''
        ];

                //if user click continue button in forgot password form
                if(isset($_POST['email'])){
                  $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                  $email = mysqli_real_escape_string($db, $_POST['email']);
                  $check_email = "SELECT * FROM apleona_waste_users WHERE email='$email'";
                  $run_sql = mysqli_query($db, $check_email);
                  if(mysqli_num_rows($run_sql) > 0){
                      $code = rand(999999, 111111);
                      $insert_code = "UPDATE apleona_waste_users SET code = $code WHERE email = '$email'";
                      $run_query =  mysqli_query($db, $insert_code);
                      if($run_query){

                          $subject = "Password Reset Code";
                          $message = "Your password reset code is $code";
                          $_SESSION['message']="Your password reset code is $code";
                          $sender = "From: apleonawaste@apleona.com";

                          if(mail($email, $subject, $message, $sender)){

                              $info = "We've sent a password reset otp to your email - $email";
                              $_SESSION['info'] = $info;
                              $_SESSION['email'] = $email;
                              header('location: reset_code');
                              exit();

                          }else{
                              //$errors['otp-error'] = "Failed while sending code!";
                              $data['email_err'] = "Failed while sending code!";
                              //die('Failed while sending code!');
                              $this->view('users/forgot_password', $data);
                          }
                      }else{
                          //$errors['db-error'] = "Something went wrong!";
                          $data['email_err'] = "Something went wrong!";
                          //die('Something went wrong!');
                          $this->view('users/forgot_password', $data);
                      }
                  }else{
                      //$errors['email'] = "This email address does not exist!";
                      $data['email_err'] = "This email address does not exist!";
                      //die('email does not exist!');
                      $this->view('users/forgot_password', $data);
                  }
              } else {

        $this->view('users/forgot_password', $data);

        }

      }

      public function reset_code(){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'otp' => trim($_POST['otp']),
          'otp-error'=> ''
        ];

          //if user click check reset otp button
          if(isset($_POST['check-reset-otp'])){
            $_SESSION['info'] = "";
            $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
            $otp_code = mysqli_real_escape_string($db, $_POST['otp']);
            $check_code = "SELECT * FROM apleona_waste_users WHERE code = $otp_code";
            $code_res = mysqli_query($db, $check_code);
            if(mysqli_num_rows($code_res) > 0){
                $fetch_data = mysqli_fetch_assoc($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Please create a new password that you don't use on any other site.";
                $_SESSION['info'] = $info;
                header('location: new_password');
                exit();
            }else{
                $data['otp-error'] = "You've entered incorrect code!";
                $this->view('users/reset_code', $data);
            }
          }

        $this->view('users/reset_code', $data);

      }

      public function new_password(){
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'password' => trim($_POST['password']),
          'cpassword' => trim($_POST['cpassword']),
          'password_err'=> '',
          'cpassword_err'=> ''
        ];

            // Validate Password
            if(empty($data['password'])){
              $data['password_err'] = 'Pleae enter password';
            } elseif(strlen($data['password']) < 6){
              $data['password_err'] = 'Password must be at least 6 characters';
            }
    
            // Validate Confirm Password
            if(empty($data['cpassword'])){
              $data['cpassword_err'] = 'Pleae confirm password';
            } else {
              if($data['password'] != $data['cpassword']){
                $data['cpassword_err'] = 'Passwords do not match';
              }
            }
    
            // Make sure errors are empty
            if(empty($data['password_err']) && empty($data['cpassword_err'])){
              // Validated
              
              // Hash Password
              $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
              // Register User
              if($this->userModel->new_password($data)){
                flash('register_success', 'Your password has been reset.');
                redirect('users/login');
              } else {
                die('Something went wrong');
              }
    
            } else {
              // Load view with errors
              $this->view('users/new_password', $data);
            }

      }

    public function reset_password($id){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'id' => $id,
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->reset_password($data)){
            flash('register_success', 'Your password has been reset.');
            redirect('users/index');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/reset_password', $data);
        }

      } else {
        // Init data
        // $data =[
        //   'id' => '',
        //   'password' => '',
        //   'confirm_password' => '',
        //   'password_err' => '',
        //   'confirm_password_err' => ''
        // ];

        $user = $this->userModel->getUserById($id);

        $data = [
          'id' => $id,
          'password' => '',
          'confirm_password' => ''
        ];

        // Load view
        $this->view('users/reset_password', $data);
      }
    }

    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'customer_group' => trim($_POST['customer_group']),
          'user_type' => trim($_POST['user_type']),
          'country' => trim($_POST['country']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'customer_group_err' => '',
          'user_type_err' => '',
          'country_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/index');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'customer_group' => '',
          'user_type' => '',
          'country' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'country_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function edit($id){

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Process form
 
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
        'id'=>$id,
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'customer_group' => trim($_POST['customer_group']),
        'user_type' => trim($_POST['user_type']),
        'country' => trim($_POST['country']),
        ];

      if($this->userModel->updateUser($data)){
        //flash('user_message', 'User Updated');
        redirect('users');
      } else {
        die('Something went wrong');
      }

      $this->view('users/edit', $data);
    
      } else {
      $user = $this->userModel->getUserById($id);

      $data = [
        'id' => $id,
        'name'=>$user->name,
        'email'=> $user->email,
        'customer_group'=> $user->customer_group,
        'user_type'=>$user->user_type,
        'country'=>$user->country
      ];

      $this->view('users/edit', $data);

    }
  }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      if ($user->country == 'Workspace') {
      $_SESSION['customer_group'] = $user->country;
      } else {
      $_SESSION['customer_group'] = $user->customer_group;
      }
      $_SESSION['user_type'] = $user->user_type;
      $_SESSION['country'] = $user->country;
      $_SESSION['collectorKey'] = '';
      $_SESSION['doc_error'] = '';
      if ($_SESSION['customer_group'] !== '' && $_SESSION['customer_group'] !== 'Workspace') {
      //redirect('collections/add_IE');
      redirect('pages/index?mySite=ALL&myCustomer=' . $_SESSION['customer_group'] . '');
      } else {
        redirect('pages/index');
      }
    }


    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['customer_group']);
      unset($_SESSION['user_type']);
      unset($_SESSION['country']);
      unset($_SESSION['collectorKey']);
      unset($_SESSION['doc_error']);
      session_destroy();
      redirect('users/login');
    }

    public function delete($id){
      // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collection from model
        $user = $this->userModel->getUserById($id);
        
        /* Check for owner
        if($collection->user_id != $_SESSION['user_id']){
          redirect('collections');
        }*/

        if($this->userModel->deleteUser($id)){
          //flash('collection_message', 'Collection Removed');
          redirect('users');
        } else {
          die('Something went wrong');
        }
      // } else {
      //   redirect('users');
      // }
    }

     public function index(){
      // Get Users
      $users = $this->userModel->getUsers();

      $data = [
        'users' => $users
      ];

      $this->view('users/index', $data);
    }
  }