<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(!isLoggedIn()){
       redirect('users/login');
      }

      $data = [
        'title' => 'Apleona Waste Management',
        'description' => 'Waste Management - Made Simple - Collection List'
     ];
     
      $this->view('pages/index');
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to track waste'
      ];

      $this->view('pages/about', $data);
    }

    public function brokers(){
      $data = [
        'title' => 'Brokers',
        'description' => 'List of Brokers on Waste Portal'
      ];

      $this->view('pages/brokers', $data);
    }

    public function collectors(){
      $data = [
        'title' => 'Collectors',
        'description' => 'List of Collectors on Waste Portal'
      ];

      $this->view('pages/collectors', $data);
    }

    public function treatments(){
      $data = [
        'title' => 'Treatments',
        'description' => 'List of Treatments on Waste Portal'
      ];

      $this->view('pages/treatments', $data);
    }

    public function suppliers(){
      $data = [
        'title' => 'Suppliers',
        'description' => 'List of Suppliers on Waste Portal'
      ];

      $this->view('pages/suppliers', $data);
    }

    public function ewcs(){
      $data = [
        'title' => 'Ewc Codes',
        'description' => 'List of Ewc Codes on Waste Portal'
      ];

      $this->view('pages/ewcs', $data);
    }

    public function uns(){
      $data = [
        'title' => 'UN Codes',
        'description' => 'List of UN Codes on Waste Portal'
      ];

      $this->view('pages/uns', $data);
    }

    public function rds(){
      $data = [
        'title' => 'RD Codes',
        'description' => 'List of RD Codes on Waste Portal'
      ];

      $this->view('pages/rds', $data);
    }
    
    public function customers(){
      $data = [
        'title' => 'Customers',
        'description' => 'List of Customers on Waste Portal'
      ];

      $this->view('pages/customers', $data);
    }

    public function collections(){
      $data = [
        'title' => 'Collections',
        'description' => 'List of Collections on Waste Portal'
      ];

      $this->view('Collections', $data);
    }

    public function transaction(){
      $data = [
        'title' => 'Transport Chart',
        'description' => 'List of Collections on Waste Portal'
      ];

      $this->view('collections/charts/transaction', $data);
    }
  }