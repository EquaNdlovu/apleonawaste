<?php



  class Customers extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->customerModel = $this->model('Customer');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Customers
      $customers = $this->customerModel->getCustomers();

      $data = [
        'customers' => $customers
      ];

      $this->view('customers/index', $data);
    }

    public function index_old(){
      // Get Customers
      $customers = $this->customerModel->getCustomers();

      $data = [
        'customers' => $customers
      ];

      $this->view('customers/index_old', $data);
    }

  //*************************

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_customer_country' => trim($_POST['waste_customer_country']),
          'waste_customer_name' => trim($_POST['waste_customer_name']),
          'waste_customer_address' => trim($_POST['waste_customer_address']),
          'waste_customer_group' => trim($_POST['waste_customer_group']),
          'waste_customer_country_err' => ''
        ];

        // Validate data

        if(empty($data['waste_customer_country'])){
          $data['waste_customer_country_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['waste_customer_country_err'])){
          // Validated
          if($this->customerModel->addCustomer($data)){
            flash('customer_message', 'Customer Added');
            redirect('customers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('customers/add', $data);
        }

      } else {
        $data = [
          'waste_customer_country' => '',
          'waste_customer_name' => '',
          'waste_customer_address' => '',
          'waste_customer_group' => ''
        ];
  
        $this->view('customers/add', $data);
      }
    }
   

   //***************************

    public function edit($waste_customer_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_customer_key' => $waste_customer_key,
          'waste_customer_country' => trim($_POST['waste_customer_country']),
          'waste_customer_name' => trim($_POST['waste_customer_name']),
          'waste_customer_address' => trim($_POST['waste_customer_address']),
          'waste_customer_group' => trim($_POST['waste_customer_group']),
          'user_id' => $_SESSION['user_id']
         
        ];

        if(empty($data['waste_customer_country'])){
            $data['waste_customer_country_err'] = 'Please enter body text';
          }
       

        // Make sure no errors
        if(empty($data['waste_customer_country_err'])){
          // Validated
          if($this->customerModel->updateCustomer($data)){
            flash('customer_message', 'Customer Updated');
            redirect('customers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('customers/edit', $data);
        }

      } else {
        // Get existing customer from model
        $customer = $this->customerModel->getCustomerById($waste_customer_key);

       
        $data = [
          'waste_customer_key' => $waste_customer_key,
          'waste_customer_country' => $customer->waste_customer_country,
          'waste_customer_name' => $customer->waste_customer_name,
          'waste_customer_address' => $customer->waste_customer_address,
          'waste_customer_group' => $customer->waste_customer_group
                ];
  
        $this->view('customers/edit', $data);
      }
    }

   


    public function show($waste_customer_key){
     
      $customer = $this->customerModel->getCustomerById($waste_customer_key);
      //$user = $this->userModel->getUserById($customer->user_id);

      $data = [
          'customer' => $customer,
          
        //'user' => $user
      ];

      $this->view('customers/show', $data);
    }





    public function delete($customer_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing customer from model
        $customer = $this->customerModel->getCustomerById($customer_key);
        
        

        if($this->customerModel->deleteCustomer($customer_key)){
          flash('customer_message', 'Customer Removed');
          redirect('customers');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('customers');
      }
    }
  }