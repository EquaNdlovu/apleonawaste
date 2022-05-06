<?php
  class Lookup_Material_Descriptions extends Controller {
    public function __construct(){
      $this->materialsModel = $this->model('Lookup_Material_Description');
    }

    public function index(){
        // Get Options
        $lookups = $this->materialsModel->getOptions();
  
        $data = [
          'lookup' => $lookups
        ];
  
        $this->view('Lookup_Material_Descriptions/index', $data);
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
        if($this->materialsModel->add($data)){
            flash('addition_success', 'New description added');
            redirect('Lookup_Material_Descriptions/index');
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
        $this->view('Lookup_Material_Descriptions/add', $data);
      }
    }

    public function edit($lookup_key){

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Process form
 
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
        'lookup_key'=>$lookup_key,
        'description' => trim($_POST['description'])
        ];

      if($this->materialsModel->updateDescription($data)){
        //flash('user_message', 'User Updated');
        redirect('Lookup_Material_Descriptions/index');
      } else {
        die('Something went wrong');
      }

      $this->view('Lookup_Material_Descriptions/edit', $data);
    
      } else {
      $option = $this->materialsModel->getDescriptionById($lookup_key);

      $data = [
        'lookup_key' => $lookup_key,
        'description'=>$option->description
      ];

      $this->view('Lookup_Material_Descriptions/edit', $data);

    }
  }

  public function update(){

    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
    
    if(isset($_POST['updatedata'])) {
        $lookup_key = $_POST['lookup_key'];
        $description = $_POST['description'];
        $customer = $_POST['customer'];
    
        $sql = "UPDATE lookup_material_description SET description = '$description', customer = '$customer' WHERE lookup_key = '$lookup_key' ";
        $result = mysqli_query($db, $sql);
    
        if($result) {
           echo '<script> alert("Data Updated"); </script>';
           redirect('Lookup_Material_Descriptions/index');
        } else {
           echo '<script> alert("Data Not Updated"); </script>';
        }
    }
}

    public function delete($lookup_key){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collection from model
        $option = $this->materialsModel->getDescriptionById($lookup_key);
        
        /* Check for owner
        if($collection->user_id != $_SESSION['user_id']){
          redirect('collections');
        }*/

        if($this->materialsModel->deleteOption($lookup_key)){
          //flash('collection_message', 'Collection Removed');
          redirect('Lookup_Material_Descriptions/index');
        } else {
          die('Something went wrong');
        }
    //   } else {
    //     redirect('users');
    //   }
    }
  }