<?php
  class Sites extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->siteModel = $this->model('Site');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Sites
      $sites = $this->siteModel->getSites();

      $data = [
        'sites' => $sites
      ];

      $this->view('sites/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_site_country' => trim($_POST['waste_site_country']),
          'waste_site_customer' => trim($_POST['waste_site_customer']),
          'waste_site_name' => trim($_POST['waste_site_name']),
          'waste_site_address' => trim($_POST['waste_site_address']),
          'waste_site_country_err' => ''
        ];

        // Validate data

        if(empty($data['waste_site_country'])){
          $data['waste_site_country_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['waste_site_country_err'])){
          // Validated
          if($this->siteModel->addSite($data)){
            flash('site_message', 'Site Added');
            redirect('sites');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('sites/add', $data);
        }

      } else {
        $data = [
          'waste_site_country' => '',
          'waste_site_customer' => '',
          'waste_site_name' => '',
          'waste_site_address' => ''
        ];
  
        $this->view('sites/add', $data);
      }
    }

    public function edit($waste_site_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_site_key' => $waste_site_key,
          'waste_site_country' => trim($_POST['waste_site_country']),
          'waste_site_customer' => trim($_POST['waste_site_customer']),
          'waste_site_name' => trim($_POST['waste_site_name']),
          'waste_site_address' => trim($_POST['waste_site_address']),
          'user_id' => $_SESSION['user_id']
          
        ];

        // Validate data

        if(empty($data['waste_site_country'])){
            $data['waste_site_country_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['waste_site_country_err'])){
          // Validated
          if($this->siteModel->updateSite($data)){
            flash('site_message', 'Site Updated');
            redirect('sites');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('sites/edit', $data);
        }

      } else {
        // Get existing broker from model
        $site = $this->siteModel->getSiteById($waste_site_key);

        /*/ Check for owner
        if($broker->user_id != $_SESSION['user_id']){
          redirect('brokers');
        }*/

        $data = [
          'waste_site_key' => $waste_site_key,
          'waste_site_country' => $site->waste_site_country,
          'waste_site_customer' => $site->waste_site_customer,
          'waste_site_name' => $site->waste_site_name,
          'waste_site_address' => $site->waste_site_address,
        ];
  
        $this->view('sites/edit', $data);
      }
    }

    public function show($waste_site_key){
      $site = $this->siteModel->getSiteById($waste_site_key);
      //$user = $this->userModel->getUserById($broker->user_id);

      $data = [
        'site' => $site,
        //'user' => $user
      ];

      $this->view('sites/show', $data);
    }

    public function delete($waste_site_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing broker from model
        $site = $this->siteModel->getSiteById($waste_site_key);
        
        /*/ Check for owner
        if($broker->user_id != $_SESSION['user_id']){
          redirect('brokers');
        }*/

        if($this->siteModel->deleteSite($waste_site_key)){
          flash('site_message', 'Site Removed');
          redirect('sites');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('sites');
      }
    }
  }