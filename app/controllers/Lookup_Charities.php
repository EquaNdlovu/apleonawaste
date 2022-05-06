<?php
  class Lookup_Charities extends Controller {
    public function __construct(){
      $this->charitiesModel = $this->model('Lookup_Charity');
    }

    public function index(){
        // Get Options
        $lookups = $this->charitiesModel->getOptions();
  
        $data = [
          'lookup' => $lookups
        ];
  
        $this->view('Lookup_Charities/index', $data);
      }

    public function add(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'description' => trim($_POST['description']),
          'customer' => trim($_POST['customer']),
        ];

        // Register User
        if($this->charitiesModel->add($data)){
            flash('addition_success', 'New description added');
            redirect('Lookup_Charities/index');
          } else {
            die('Something went wrong');
          }

      } else {
        die('Something went wrong');
        // Init data
        $data =[
          'description' => '',
          'customer' => ''
        ];

        // Load view
        $this->view('Lookup_Charities/add', $data);
      }
    }

  public function update(){

    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
    
    if(isset($_POST['updatedata'])) {
        $lookup_key = $_POST['lookup_key'];
        $description = $_POST['description'];
        $customer = $_POST['customer'];
    
        $sql = "UPDATE lookup_charities SET description = '$description', customer = '$customer' WHERE lookup_key = '$lookup_key' ";
        $result = mysqli_query($db, $sql);
    
        if($result) {
           echo '<script> alert("Data Updated"); </script>';
           redirect('Lookup_Charities/index');
        } else {
           echo '<script> alert("Data Not Updated"); </script>';
        }
    }
}

    public function delete($lookup_key){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collection from model
        $option = $this->charitiesModel->getDescriptionById($lookup_key);
        
        /* Check for owner
        if($collection->user_id != $_SESSION['user_id']){
          redirect('collections');
        }*/

        if($this->charitiesModel->deleteOption($lookup_key)){
          //flash('collection_message', 'Collection Removed');
          redirect('Lookup_Charities/index');
        } else {
          die('Something went wrong');
        }
    //   } else {
    //     redirect('users');
    //   }
    }
  }