<?php
  class Suppliers extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->supplierModel = $this->model('Supplier');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Suppliers
      $suppliers = $this->supplierModel->getSuppliers();

      $data = [
        'suppliers' => $suppliers
      ];

      $this->view('suppliers/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'supplier_name' => trim($_POST['supplier_name']),
          'supplier_address' => trim($_POST['supplier_address']),
          'supplier_contact_name' => trim($_POST['supplier_contact_name']),
          'supplier_contact_number' => trim($_POST['supplier_contact_number']),
          'supplier_contact_email' => trim($_POST['supplier_contact_email']),
          'supplier_name_err' => ''
        ];

        // Validate data

        if(empty($data['supplier_name'])){
          $data['supplier_name_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['supplier_name_err'])){
          // Validated
          if($this->supplierModel->addSupplier($data)){
            flash('supplier_message', 'Supplier Added');
            redirect('suppliers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('suppliers/add', $data);
        }

      } else {
        $data = [
          'supplier_name' => '',
          'supplier_address' => '',
          'supplier_contact_name' => '',
          'supplier_contact_number' => '',
          'supplier_contact_email' => ''
        ];
  
        $this->view('suppliers/add', $data);
      }
    }

    public function edit($supplier_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'supplier_key' => $supplier_key,
          'supplier_name' => trim($_POST['supplier_name']),
          'supplier_address' => trim($_POST['supplier_address']),
          'supplier_contact_name' => trim($_POST['supplier_contact_name']),
          'supplier_contact_number' => trim($_POST['supplier_contact_number']),
          'supplier_contact_email' => trim($_POST['supplier_contact_email']),
          'user_id' => $_SESSION['user_id'],
          'supplier_name_err' => ''
        ];

        // Validate data

        if(empty($data['supplier_name'])){
            $data['supplier_name_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['supplier_name_err'])){
          // Validated
          if($this->supplierModel->updateSupplier($data)){
            flash('supplier_message', 'Supplier Updated');
            redirect('suppliers');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('suppliers/edit', $data);
        }

      } else {
        // Get existing supplier from model
        $supplier = $this->supplierModel->getSupplierById($supplier_key);

        /*/ Check for owner
        if($supplier->user_id != $_SESSION['user_id']){
          redirect('suppliers');
        }*/

        $data = [
          'supplier_key' => $supplier_key,
          'supplier_name' => $supplier->supplier_name,
          'supplier_address' => $supplier->supplier_address,
          'supplier_contact_name' => $supplier->supplier_contact_name,
          'supplier_contact_number' => $supplier->supplier_contact_number,
          'supplier_contact_email' => $supplier->supplier_contact_email
        ];
  
        $this->view('suppliers/edit', $data);
      }
    }

    public function show($supplier_key){
      $supplier = $this->supplierModel->getSupplierById($supplier_key);
      //$user = $this->userModel->getUserById($supplier->user_id);

      $data = [
        'supplier' => $supplier,
        //'user' => $user
      ];

      $this->view('suppliers/show', $data);
    }

    public function delete($supplier_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing supplier from model
        $supplier = $this->supplierModel->getSupplierById($supplier_key);
        
        /*/ Check for owner
        if($supplier->user_id != $_SESSION['user_id']){
          redirect('suppliers');
        }*/

        if($this->supplierModel->deleteSupplier($supplier_key)){
          flash('supplier_message', 'Supplier Removed');
          redirect('suppliers');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('suppliers');
      }
    }
  }