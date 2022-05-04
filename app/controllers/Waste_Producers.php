<?php



  class Waste_Producers extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->wasteproducerModel = $this->model('Waste_Producer');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Customers
      $waste_producers = $this->wasteproducerModel->getWasteProducers();

      $data = [
        'waste_producers' => $waste_producers
      ];

      $this->view('waste_producers/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_producer_name' => trim($_POST['waste_producer_name']),
          'waste_producer_customer' => trim($_POST['waste_producer_customer']),
          'waste_producer_country' => trim($_POST['waste_producer_country'])
        ];

          // Validated
          if($this->wasteproducerModel->addWasteProducer($data)){
            flash('producer_message', 'Waste Producer Added');
            redirect('waste_producers');
          } else {
            die('Something went wrong');
          }

      } else {
        $data = [
          'waste_producer_name' => '',
          'waste_producer_customer' => '',
          'waste_producer_country' => ''
        ];
  
        $this->view('waste_producers/add', $data);
      }
    }

    public function edit($waste_producer_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'waste_producer_key' => $waste_producer_key,
          'waste_producer_name' => trim($_POST['waste_producer_name']),
          'waste_producer_customer' => trim($_POST['waste_producer_customer']),
          'waste_producer_country' => trim($_POST['waste_producer_country']),
          'user_id' => $_SESSION['user_id']
          
        ];

        // Validate data

          // Validated
          if($this->wasteproducerModel->updateWasteProducer($data)){
            flash('producer_message', 'Waste Producer Updated');
            redirect('waste_producers');
          } else {
            die('Something went wrong');
          }

      } else {
        // Get existing broker from model
        $producer = $this->wasteproducerModel->getProducerById($waste_producer_key);

        /*/ Check for owner
        if($broker->user_id != $_SESSION['user_id']){
          redirect('brokers');
        }*/

        $data = [
          'waste_producer_key' => $waste_producer_key,
          'waste_producer_name' => $producer->waste_producer_name,
          'waste_producer_customer' => $producer->waste_producer_customer,
          'waste_producer_country' => $producer->waste_producer_country,
        ];
  
        $this->view('waste_producers/edit', $data);
      }
    }

}