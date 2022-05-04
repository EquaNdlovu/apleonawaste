<?php

  class Collections extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->collectionModel = $this->model('Collection');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Collections
      $collections = $this->collectionModel->getCollections();

      $data = [
        'collections' => $collections
      ];

      $this->view('collections/index', $data);
    }

    public function transaction(){
      // Get Collections
      $collections = $this->collectionModel->getCollections();

      $data = [
        'collections' => $collections
      ];

      $this->view('collections/transaction', $data);
    }

    public function getSites(){
      

    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'collections_customer'=> trim($_POST['collections_customer']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Transaction_Type'=> trim($_POST['Transaction_Type']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          'Material_UN_Code'=> trim($_POST['Material_UN_Code']),
          'Material_Dangerous_Goods_Label'=> trim($_POST['Material_Dangerous_Goods_Label']),
          'Material_Packaging_Group'=> trim($_POST['Material_Packaging_Group']),
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Consulting_Cost'=> trim($_POST['Consulting_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'EWC'=> trim($_POST['EWC']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'Delivery_Number_Docket_Number'=> trim($_POST['Delivery_Number_Docket_Number']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'TFS_Number'=> trim($_POST['TFS_Number']),
          'TFS_Load_Number'=> trim($_POST['TFS_Load_Number']),
          'RD_Codes_Storage'=> trim($_POST['RD_Codes_Storage']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          'Container_Type'=> trim($_POST['Container_Type']),
          'Container_ID_No'=> trim($_POST['Container_ID_No']),
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_comments'=> trim($_POST['collections_comments']),
          'user_id' => $_SESSION['user_id'],
          'collections_comments_err' => '',
          'collections_customer_err' => ''
        ];

        // Validate data
        if(empty($data['collections_comments'])){
          $data['collections_comments_err'] = 'Please enter comments';
        }
        if(empty($data['collections_customer'])){
          $data['collections_customer_err'] = 'Please enter Customer';
        }

        // Make sure no errors
        if(empty($data['collections_comments_err']) && empty($data['collections_customer_err'])){
          // Validated
          if($this->collectionModel->addCollection($data)){
            flash('collection_message', 'Collection Added');
            redirect('collections');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('collections/add', $data);
        }

      } else {
        $data = [
          'collections_customer_number'=> '',
          'collections_customer_group'=> '',
          'collections_customer'=> '',
          'Customer_Waste_Producer'=> '',
          'collections_address'=> '',
          'Colletion_Date'=> '',
          'Order_Status'=> '',
          'Transaction_Type'=> '',
          'Material_Description'=> '',
          'Material_Detail'=> '',
          'Material_UN_Code'=> '',
          'Material_Dangerous_Goods_Label'=> '',
          'Material_Packaging_Group'=> '',
          'Quantity'=> '',
          'Unit_of_Measure'=> '',
          'Treatment_Cost'=> '',
          'Transport_Cost'=> '',
          'Consulting_Cost'=> '',
          'Other_Cost'=> '',
          'Total_Cost'=> '',
          'Currency'=> '',
          'EWC'=> '',
          'Indication_of_Danger'=> '',
          'Delivery_Number_Docket_Number'=> '',
          'Waste_Collector'=> '',
          'Treatment_Facility'=> '',
          'Treatment_Method_Detail'=> '',
          'TFS_Number'=> '',
          'TFS_Load_Number'=> '',
          'RD_Codes_Storage'=> '',
          'RD_Codes_Treatment'=> '',
          'Container_Type'=> '',
          'Container_ID_No'=> '',
          'Container_Quantity'=> '',
          'collections_quantity_not_kg'=> '',
          'collections_not_kg_UOM'=> '',
          'colletions_WTF_number'=> '',
          'collections_comments'=> ''

        ];
  
        $this->view('collections/add', $data);
      }
    }

    public function edit($collections_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          //'collections_key' => trim($_POST['collections_key']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'collections_customer'=> trim($_POST['collections_customer']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Transaction_Type'=> trim($_POST['Transaction_Type']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          'Material_UN_Code'=> trim($_POST['Material_UN_Code']),
          'Material_Dangerous_Goods_Label'=> trim($_POST['Material_Dangerous_Goods_Label']),
          'Material_Packaging_Group'=> trim($_POST['Material_Packaging_Group']),
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Consulting_Cost'=> trim($_POST['Consulting_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'EWC'=> trim($_POST['EWC']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'Delivery_Number_Docket_Number'=> trim($_POST['Delivery_Number_Docket_Number']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'TFS_Number'=> trim($_POST['TFS_Number']),
          'TFS_Load_Number'=> trim($_POST['TFS_Load_Number']),
          'RD_Codes_Storage'=> trim($_POST['RD_Codes_Storage']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          'Container_Type'=> trim($_POST['Container_Type']),
          'Container_ID_No'=> trim($_POST['Container_ID_No']),
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_comments'=> trim($_POST['collections_comments']),
          'user_id' => $_SESSION['user_id'],
          'collections_comments_err' => '',
          'collections_customer_err' => ''
        ];

        // Validate data
        if(empty($data['collections_comments'])){
          $data['collections_comments_err'] = 'Please enter comments';
        }
        if(empty($data['collections_customer'])){
          $data['collections_customer_err'] = 'Please enter Customer';
        }

        // Make sure no errors
        if(empty($data['collections_comments_err']) && empty($data['collections_customer_err'])){
          // Validated
          if($this->collectionModel->updateCollection($data)){
            flash('collection_message', 'Collection Updated');
            redirect('collections');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('collections/edit', $data);
        }

      } else {
        // Get existing collection from model
        $collection = $this->collectionModel->getCollectionById($collections_key);

        // Check for admin or group **NEEDS WORK**
        /*if($collection->user_id != $_SESSION['user_id']){
          redirect('collections');
        }*/

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_number'=> $collection->collections_customer_number,
          'collections_customer_group'=> $collection->collections_customer_group,
          'collections_customer' => $collection->collections_customer,
          'Customer_Waste_Producer' => $collection->Customer_Waste_Producer,
          'collections_address' => $collection->collections_address,
          'Colletion_Date' => $collection->Colletion_Date,
          'Order_Status' => $collection->Order_Status,
          'Transaction_Type' => $collection->Transaction_Type,
          'Material_Description' => $collection->Material_Description,
          'Material_Detail' => $collection->Material_Detail,
          'Material_UN_Code' => $collection->Material_UN_Code,
          'Material_Dangerous_Goods_Label' => $collection->Material_Dangerous_Goods_Label,
          'Material_Packaging_Group' => $collection->Material_Packaging_Group,
          'Quantity' => $collection->Quantity,
          'Unit_of_Measure' => $collection->Unit_of_Measure,
          'Treatment_Cost' => $collection->Treatment_Cost,
          'Transport_Cost' => $collection->Transport_Cost,
          'Consulting_Cost' => $collection->Consulting_Cost,
          'Other_Cost' => $collection->Other_Cost,
          'Total_Cost' => $collection->Total_Cost,
          'Currency' => $collection->Currency,
          'EWC' => $collection->EWC,
          'Indication_of_Danger' => $collection->Indication_of_Danger,
          'Delivery_Number_Docket_Number' => $collection->Delivery_Number_Docket_Number,
          'Treatment_Facility' => $collection->Treatment_Facility,
          'Treatment_Method_Detail' => $collection->Treatment_Method_Detail,
          'TFS_Number' => $collection->TFS_Number,
          'TFS_Load_Number' => $collection->TFS_Load_Number,
          'RD_Codes_Storage' => $collection->RD_Codes_Storage,
          'RD_Codes_Treatment' => $collection->RD_Codes_Treatment,
          'Container_Type' => $collection->Container_Type,
          'Container_ID_No' => $collection->Container_ID_No,
          'Container_Quantity' => $collection->Container_Quantity,
          'collections_quantity_not_kg' => $collection->collections_quantity_not_kg,
          'collections_not_kg_UOM' => $collection->collections_not_kg_UOM,
          'colletions_WTF_number' => $collection->colletions_WTF_number,
          'collections_comments' => $collection->collections_comments
        ];
  
        $this->view('collections/edit', $data);
      }
    }

    public function show($collections_key){
      $collection = $this->collectionModel->getCollectionById($collections_key);
      //$user = $this->userModel->getUserById($collection->user_id);

      $data = [
        'collection' => $collection
        //'user' => $user
      ];

      $this->view('collections/show', $data);
    }

    public function delete($collections_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing collection from model
        $collection = $this->collectionModel->getCollectionById($collections_key);
        
        /* Check for owner
        if($collection->user_id != $_SESSION['user_id']){
          redirect('collections');
        }*/

        if($this->collectionModel->deleteCollection($collections_key)){
          flash('collection_message', 'Collection Removed');
          redirect('collections');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('collections');
      }
    }
  }