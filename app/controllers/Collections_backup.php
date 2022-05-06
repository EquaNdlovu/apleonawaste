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

   
//++++++++++++++++++++++++++++++++++++++++++++++++



//+++++++++++++++++++++++++++++++++++++++++++++++++










    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'Collections_Programme'=> trim($_POST['Collections_Programme']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Transaction_Type'=> trim($_POST['Transaction_Type']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          //'collections_cert_scan'=> $_FILES['file']['name'],
          'collections_cert_scan'=> '',
          'charity_donated_to'=> trim($_POST['charity_donated_to']),
          'collections_cert_scan_err' => ''
          
        ];

        $_SESSION['doc_error'] = '';
        // Make sure no errors
        if (empty($_FILES['file']['name'][0])) {
          
        } else {
          $str = implode(",", $_FILES['file']['name']);
          $str_arr = explode(",", $str);
          foreach ($str_arr as $value) {
            if (file_exists(APPROOT . '/views/collections/files/' . $value)) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File Already Exists';
              $_SESSION['doc_error'] = 'Documentation Error: File Already Exists';
            }
          }
          foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $filesize = $_FILES['file']['size'][$key];
            if ($filesize >= 10485760) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File size is too large, 10MB Maximum';
              $_SESSION['doc_error'] = 'Documentation Error: File size is too large, 10MB Maximum'; 
            }
          }
        }

       

        // Make sure no errors
        if(empty($data['collections_comments_err']) && empty($data['collections_customer_err']) && empty($data['collections_cert_scan_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $_FILES['file']['name']);
            $str_arr = explode(",", $str);
            $var = 'add';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->collectionModel->addFile($data, $arr, $i, $var);
            }
          } 
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
          'collections_customer_country'=> '',
          'collections_customer_site'=> '',
          'collections_workorder'=> '',
          'collections_customer_number'=> '',
          'collections_customer_group'=> '',
          'Customer_Waste_Producer'=> '',
          'Collections_Programme' => '',
          'collections_address'=> '',
          'Colletion_Date'=> '',
          'Order_Status'=> '',
          'Transaction_Type'=> '',
          'Material_Description'=> '',
          'Material_Detail'=> '',       
         
          'Quantity'=> '',
          'Unit_of_Measure'=> '',
          'Treatment_Cost'=> '',
          'Packaging_Cost'=> '',
          'Transport_Cost'=> '',
          'Other_Cost' => '',
          'Total_Cost' => '',
          'Currency' => '',
          'ewc_parent'=> '',
          'ewc_sub'=> '',
          'Waste_Vendor'=> '',
          'Indication_of_Danger'=> '',
          'Waste_Collector'=> '',
          'Treatment_Facility'=> '',
          'Treatment_Method_Detail'=> '',
          'RD_Codes_Treatment'=> '',
          'Container_Quantity'=> '',
          'collections_quantity_not_kg'=> '',
          'collections_not_kg_UOM'=> '',
          'colletions_WTF_number'=> '',
          'collections_cert_scan'=> '',
          'charity_donated_to'=> ''         

        ];
  
        $this->view('collections/add', $data);
      }
    }

    public function add_IE(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Transaction_Type'=> trim($_POST['Transaction_Type']),
          //'hazardous_checkbox'=> trim($_POST['hazardous_checkbox']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          'Material_Description_Alt'=> trim($_POST['Material_Description_Alt']),
          'Material_Detail_Alt'=> trim($_POST['Material_Detail_Alt']),
          'Material_UN_Code'=> trim($_POST['Material_UN_Code']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'Material_Packaging_Group'=> trim($_POST['Material_Packaging_Group']),
          'Material_Class'=> trim($_POST['Material_Class']),
          'Certificate_Number' => trim($_POST['Certificate_Number']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'ENVision_Description'=> trim($_POST['ENVision_Description']),
          'ENVision_Disposal'=> trim($_POST['ENVision_Disposal']),
          'waste_type'=> trim($_POST['waste_type']),
          'weights_confirmed'=> trim($_POST['weights_confirmed']),
          'Waste_Collector'=> $_POST['Waste_Collector'],
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'TFS_Number'=> trim($_POST['TFS_Number']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Type'=> trim($_POST['Container_Type']),
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_cert_scan'=> '',
          'collections_comments'=> trim($_POST['collections_comments']),
          'charity_donated_to' => trim($_POST['charity_donated_to']),
          'collections_cert_scan_err' => ''
          
        ];

       
       
        $_SESSION['doc_error'] = '';
        // Make sure no errors
        if (empty($_FILES['file']['name'][0])) {
          
        } else {
          $str = implode(",", $_FILES['file']['name']);
          $str_arr = explode(",", $str);
          foreach ($str_arr as $value) {
            if (file_exists(APPROOT . '/views/collections/files/' . $value)) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File Already Exists';
              $_SESSION['doc_error'] = 'Documentation Error: File Already Exists';
            }
          }
          foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $filesize = $_FILES['file']['size'][$key];
            if ($filesize >= 10485760) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File size is too large, 10MB Maximum';
              $_SESSION['doc_error'] = 'Documentation Error: File size is too large, 10MB Maximum'; 
            }
          }
        }

        if(empty($data['collections_comments_err']) && empty($data['collections_customer_err']) && empty($data['collections_cert_scan_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $_FILES['file']['name']);
            $str_arr = explode(",", $str);
            $var = 'add';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->collectionModel->addFile($data, $arr, $i, $var);
            }
            $countfiles = count($_FILES['file']['name']);
            $values = "";
            //Looping all files
            for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $values != "" && $values .= ",";
            $values .= $filename;
            //Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/collections/files/' . $filename);
            }
          } 
          if($this->collectionModel->addCollection_IE($data)){
            //$this->collectionModel->addWTF($data);
            flash('collection_message', 'Collection Added');
            redirect('collections');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('collections/add_IE', $data);
        }

      } else {
        $data = [
          'collections_customer_country'=> '',
          'collections_customer_site'=> '',
          'collections_workorder'=> '',
          'collections_customer_number'=> '',
          'collections_customer_group'=> '',
          'Customer_Waste_Producer'=> '',
          'collections_address'=> '',
          'Colletion_Date'=> '',
          'Order_Status'=> '',
          'Transaction_Type'=> '',
          //'hazardous_checkbox'=> '',
          'Material_Description'=> '',
          'Material_Detail'=> '',
          'Material_Description_Alt'=> '',
          'Material_Detail_Alt'=> '',
          'Material_UN_Code' => '',
         
          'Quantity'=> '',
          'Unit_of_Measure'=> '',
          'Treatment_Cost'=> '',
          'Packaging_Cost'=> '',
          'Transport_Cost'=> '',
          'Other_Cost' => '',
          'Total_Cost' => '',
          'Currency' => '',
          'Material_Packaging_Group' => '',
          'Material_Class' => '',
          'Certificate_Number' => '',
          'ewc_parent'=> '',
          'ewc_sub' => '',
          'Waste_Vendor'=> '',
          'Indication_of_Danger'=> '',
          'ENVision_Description'=> '',
          'ENVision_Disposal'=> '',
          'waste_type'=> '',
          'weights_confirmed'=> '',
          'Waste_Collector'=> '',
          'Treatment_Facility'=> '',
          'Treatment_Method_Detail'=> '',
          'TFS_Number' => '',
          'RD_Codes_Treatment'=> '',

          'Container_Type' => '',
          'Container_Quantity'=> '',
          'collections_quantity_not_kg'=> '',
          'collections_not_kg_UOM'=> '',
          'colletions_WTF_number'=> '',
          'collections_cert_scan'=> '',
          'collections_comments' => '',
          'charity_donated_to' => '',
          

        ];
  
        $this->view('collections/add_IE', $data);
      }
    }

    public function edit($collections_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $collections_cert_scan = $this->collectionModel->getCollectionById($collections_key);
        $var = $collections_cert_scan->collections_cert_scan;
        //die($var);

        if (empty($_FILES['file']['name'][0])) {

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'Collections_Programme'=> trim($_POST['Collections_Programme']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_cert_scan'=> $var   
          
        ];
      } else {

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'Collections_Programme'=> trim($_POST['Collections_Programme']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_cert_scan'=>  $_FILES['file']['name']
        ];  

        // Make sure no errors
        // Validate data

        $_SESSION['doc_error'] = '';
        // Make sure no errors
        if (empty($_FILES['file']['name'][0])) {
          
        } else {
          $str = implode(",", $data['collections_cert_scan']);
          $str_arr = explode(",", $str);
          foreach ($str_arr as $value) {
            if (file_exists(APPROOT . '/views/collections/files/' . $value)) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File Already Exists';
              $_SESSION['doc_error'] = 'Documentation Error: File Already Exists';
            }
          }
          foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $filesize = $_FILES['file']['size'][$key];
            if ($filesize >= 10485760) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File size is too large, 10MB Maximum';
              $_SESSION['doc_error'] = 'Documentation Error: File size is too large, 10MB Maximum'; 
            }
          }
        }
      }

        // Make sure no errors
        // Validate data

        if(empty($data['collections_key'])){
            $data['collections_key_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['collections_key_err']) && empty($data['collections_cert_scan_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $_FILES['file']['name']);
            $str_arr = explode(",", $str);
            $var = '';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->collectionModel->addFile($data, $arr, $i, $var);
            }
          }
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
     

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> $collection->collections_customer_country,
          'collections_customer_site'=> $collection->collections_customer_site,
          'collections_workorder'=> $collection->collections_workorder,
          'collections_customer_number'=> $collection->collections_customer_number,
          'Customer_Waste_Producer' => $collection->Customer_Waste_Producer,
          'Collections_Programme' => $collection->Collections_Programme,
          'collections_address' => $collection->collections_address,
          'Colletion_Date' => $collection->Colletion_Date,
          'Order_Status' => $collection->Order_Status,
          'Material_Description' => $collection->Material_Description,
          'Material_Detail' => $collection->Material_Detail,
          'Quantity' => $collection->Quantity,
          'Unit_of_Measure' => $collection->Unit_of_Measure,
          'Treatment_Cost'=> $collection->Treatment_Cost,
          'Packaging_Cost'=> $collection->Packaging_Cost,
          'Transport_Cost'=> $collection->Transport_Cost,
          'Other_Cost'=> $collection->Other_Cost,
          'Total_Cost'=> $collection->Total_Cost,
          'Currency'=> $collection->Currency,
          'ewc_parent' => $collection->ewc_parent,
          'ewc_sub' => $collection->ewc_sub,
          'Waste_Vendor'=> $collection->Waste_Vendor,
          'Indication_of_Danger' => $collection->Indication_of_Danger,
          'Waste_Collector'=> $collection->Waste_Collector,
          'Treatment_Facility' => $collection->Treatment_Facility,
          'Treatment_Method_Detail' => $collection->Treatment_Method_Detail,
          'RD_Codes_Treatment' => $collection->RD_Codes_Treatment,
          'Container_Quantity' => $collection->Container_Quantity,
          'collections_quantity_not_kg' => $collection->collections_quantity_not_kg,
          'collections_not_kg_UOM' => $collection->collections_not_kg_UOM,
          'colletions_WTF_number' => $collection->colletions_WTF_number
          
        ];
  
        $this->view('collections/edit', $data);
      }
    }

    public function edit_IE($collections_key){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $collections_cert_scan = $this->collectionModel->getCollectionById($collections_key);
        $var = $collections_cert_scan->collections_cert_scan;
        //die($var);

        if (empty($_FILES['file']['name'][0])) {

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          //'hazardous_checkbox'=> trim($_POST['hazardous_checkbox']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          'Material_Description_Alt'=> trim($_POST['Material_Description_Alt']),
          'Material_Detail_Alt'=> trim($_POST['Material_Detail_Alt']),
          'Material_UN_Code'=> trim($_POST['Material_UN_Code']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'Material_Packaging_Group'=> trim($_POST['Material_Packaging_Group']),
          'Material_Class'=> trim($_POST['Material_Class']),
          'Certificate_Number'=> trim($_POST['Certificate_Number']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'ENVision_Description'=> trim($_POST['ENVision_Description']),
          'ENVision_Disposal'=> trim($_POST['ENVision_Disposal']),
          'waste_type'=> trim($_POST['waste_type']),
          'weights_confirmed'=> trim($_POST['weights_confirmed']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'TFS_Number'=> trim($_POST['TFS_Number']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Type'=> trim($_POST['Container_Type']),
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_cert_scan'=> $var,
          'collections_comments'=> trim($_POST['collections_comments']),
          'charity_donated_to' => trim($_POST['charity_donated_to'])
        
          
        ];
      } else {

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> trim($_POST['collections_customer_country']),
          'collections_customer_site'=> trim($_POST['collections_customer_site']),
          'collections_workorder'=> trim($_POST['collections_workorder']),
          'collections_customer_number'=> trim($_POST['collections_customer_number']),
          'collections_customer_group'=> trim($_POST['collections_customer_group']),
          'Customer_Waste_Producer'=> trim($_POST['Customer_Waste_Producer']),
          'collections_address'=> trim($_POST['collections_address']),
          'Colletion_Date'=> trim($_POST['Colletion_Date']),
          'Order_Status'=> trim($_POST['Order_Status']),
          //'hazardous_checkbox'=> trim($_POST['hazardous_checkbox']),
          'Material_Description'=> trim($_POST['Material_Description']),
          'Material_Detail'=> trim($_POST['Material_Detail']),
          'Material_Description_Alt'=> trim($_POST['Material_Description_Alt']),
          'Material_Detail_Alt'=> trim($_POST['Material_Detail_Alt']),
          'Material_UN_Code'=> trim($_POST['Material_UN_Code']),
          
          'Quantity'=> trim($_POST['Quantity']),
          'Unit_of_Measure'=> trim($_POST['Unit_of_Measure']),
          'Treatment_Cost'=> trim($_POST['Treatment_Cost']),
          'Packaging_Cost'=> trim($_POST['Packaging_Cost']),
          'Transport_Cost'=> trim($_POST['Transport_Cost']),
          'Other_Cost'=> trim($_POST['Other_Cost']),
          'Total_Cost'=> trim($_POST['Total_Cost']),
          'Currency'=> trim($_POST['Currency']),
          'Material_Packaging_Group'=> trim($_POST['Material_Packaging_Group']),
          'Material_Class'=> trim($_POST['Material_Class']),
          'Certificate_Number'=> trim($_POST['Certificate_Number']),
          'ewc_parent'=> trim($_POST['ewc_parent']),
          'ewc_sub'=> trim($_POST['ewc_sub']),
          'Waste_Vendor'=> trim($_POST['Waste_Vendor']),
          'Indication_of_Danger'=> trim($_POST['Indication_of_Danger']),
          'ENVision_Description'=> trim($_POST['ENVision_Description']),
          'ENVision_Disposal'=> trim($_POST['ENVision_Disposal']),
          'waste_type'=> trim($_POST['waste_type']),
          'weights_confirmed'=> trim($_POST['weights_confirmed']),
          'Waste_Collector'=> trim($_POST['Waste_Collector']),
          'Treatment_Facility'=> trim($_POST['Treatment_Facility']),
          'Treatment_Method_Detail'=> trim($_POST['Treatment_Method_Detail']),
          'TFS_Number'=> trim($_POST['TFS_Number']),
          'RD_Codes_Treatment'=> trim($_POST['RD_Codes_Treatment']),
          
          'Container_Type'=> trim($_POST['Container_Type']),
          'Container_Quantity'=> trim($_POST['Container_Quantity']),
          'collections_quantity_not_kg'=> trim($_POST['collections_quantity_not_kg']),
          'collections_not_kg_UOM'=> trim($_POST['collections_not_kg_UOM']),
          'colletions_WTF_number'=> trim($_POST['colletions_WTF_number']),
          'collections_cert_scan'=> $_FILES['file']['name'],
          'collections_comments'=> trim($_POST['collections_comments']),
          'charity_donated_to' => trim($_POST['charity_donated_to'])

        ];

        // Make sure no errors
        // Validate data

        $_SESSION['doc_error'] = '';
        // Make sure no errors
        if (empty($_FILES['file']['name'][0])) {
          
        } else {
          $str = implode(",", $data['collections_cert_scan']);
          $str_arr = explode(",", $str);
          foreach ($str_arr as $value) {
            if (file_exists(APPROOT . '/views/collections/files/' . $value)) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File Already Exists';
              $_SESSION['doc_error'] = 'Documentation Error: File Already Exists';
            }
          }
          foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $filesize = $_FILES['file']['size'][$key];
            if ($filesize >= 10485760) {
              $data['collections_cert_scan_err'] = 'Documentation Error: File size is too large, 10MB Maximum';
              $_SESSION['doc_error'] = 'Documentation Error: File size is too large, 10MB Maximum'; 
            }
          }
        }
      }

        if(empty($data['collections_key'])){
            $data['collections_key_err'] = 'Please enter body text';
          }

        // Make sure no errors
        if(empty($data['collections_key_err']) && empty($data['collections_cert_scan_err'])){
          // Validated
          if (!empty($_FILES['file']['name'][0])) {
            $i = 0;
            $arr = array();
            $str = implode(",", $_FILES['file']['name']);
            $str_arr = explode(",", $str);
            $var = '';
            foreach ($str_arr as $value) {
              $arr[$i] = $value;
              //$key = $data['treatment_facility_certificates_key'];
              $this->collectionModel->addFile($data, $arr, $i, $var);
            }
          } 
          if($this->collectionModel->updateCollection_IE($data)){
            flash('collection_message', 'Collection Updated');
            redirect('collections');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
            $this->view('collections/edit_IE', $data);
        }     

      } else {
        // Get existing collection from model
        
        $collection = $this->collectionModel->getCollectionById($collections_key);
     

        $data = [
          'collections_key' => $collections_key,
          'collections_customer_country'=> $collection->collections_customer_country,
          'collections_customer_site'=> $collection->collections_customer_site,
          'collections_workorder'=> $collection->collections_workorder,
          'collections_customer_number'=> $collection->collections_customer_number,
          'collections_customer_group'=>$collection->collections_customer_group,
          'Customer_Waste_Producer' => $collection->Customer_Waste_Producer,
          'collections_address' => $collection->collections_address,
          'Colletion_Date' => $collection->Colletion_Date,
          'Order_Status' => $collection->Order_Status,
          //'hazardous_checkbox' => $collection->hazardous_checkbox,
          'Material_Description' => $collection->Material_Description,
          'Material_Detail' => $collection->Material_Detail,
          'Material_Description_Alt' => $collection->Material_Description_Alt,
          'Material_Detail_Alt' => $collection->Material_Detail_Alt,
          'Material_UN_Code' => $collection->Material_UN_Code,
          'Quantity' => $collection->Quantity,
          'Unit_of_Measure' => $collection->Unit_of_Measure,
          'Treatment_Cost'=> $collection->Treatment_Cost,
          'Packaging_Cost'=> $collection->Packaging_Cost,
          'Transport_Cost'=> $collection->Transport_Cost,
          'Other_Cost' => $collection->Other_Cost,
          'Total_Cost' => $collection->Total_Cost,
          'Currency' => $collection->Currency,
          'Material_Packaging_Group' => $collection->Material_Packaging_Group,
          'Material_Class' => $collection->Material_Class,
          'Certificate_Number' => $collection->Certificate_Number,
          'ewc_parent' => $collection->ewc_parent,
          'ewc_sub' => $collection->ewc_sub,
          'Waste_Vendor'=> $collection->Waste_Vendor,
          'Indication_of_Danger' => $collection->Indication_of_Danger,
          'ENVision_Description' => $collection->ENVision_Description,
          'ENVision_Disposal' => $collection->ENVision_Disposal,
          'Waste_Collector'=> $collection->Waste_Collector,
          'Treatment_Facility' => $collection->Treatment_Facility,
          'Treatment_Method_Detail' => $collection->Treatment_Method_Detail,
          'TFS_Number' => $collection->TFS_Number,
          'RD_Codes_Treatment' => $collection->RD_Codes_Treatment,
          'Container_Type' => $collection->Container_Type,
          'Container_Quantity' => $collection->Container_Quantity,
          'collections_quantity_not_kg' => $collection->collections_quantity_not_kg,
          'collections_not_kg_UOM' => $collection->collections_not_kg_UOM,
          'colletions_WTF_number' => $collection->colletions_WTF_number,
          'collections_comments' => $collection->collections_comments,
          'charity_donated_to' => $collection->charity_donated_to

          
          
        ];
  
        $this->view('collections/edit_IE', $data);
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

    public function download(){
      $data = [
        'collections_cert_scan' => $_GET['file']
      ];
      $this->collectionModel->downloadDocs($data);
    }

    public function delete_file(){
      $data = [
        'collections_cert_scan' => $_GET['file'],
        'collections_key' => $_GET['key']
      ];

      if($this->collectionModel->deleteDocs($data)){
        if ($_SESSION['country'] == 'IE') {
        redirect('collections/edit_IE/'.$data['collections_key']);
        } else {
          redirect('collections/edit/'.$data['collections_key']);
        }
      } else {
        die('Something went wrong');
      }
    }

    public function delete($collections_key){
      //if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
      // } else {
      //   redirect('collections');
      // }
    }
  }


  //require APPROOT . '/views/inc/sweetalerts.js'; 
  ?>

  <!-- SWEET ALERT JS -->
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  
  