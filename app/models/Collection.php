<?php
  class Collection {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCollections(){
      $this->db->query('SELECT *,
                        collections.collections_key as collections_key,
                        apleona_waste_users.id as userId,
                        collections.colletion_date as collectionDate
                        FROM collections
                        INNER JOIN apleona_waste_users
                        ON collections.collections_customer_group = apleona_waste_users.customer_group
                        ORDER BY collections.colletion_date DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addFile($data, $arr, $i, $var){

      if($var == 'add') {
      // This section is for adding a new collection e.g. no key defined yet
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'apleona_waste' AND   TABLE_NAME   = 'collections';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $this->db->query('INSERT INTO collections_files (collections_key, file_name) VALUES(:collections_key, :file_name)');
      // Bind values
      $this->db->bind(':collections_key', current($row));
      $this->db->bind(':file_name', $arr[$i]);

      } else {
        // This is for updating an existing collection e.g. key is already defined
        $this->db->query('INSERT INTO collections_files (collections_key, file_name) VALUES(:collections_key, :file_name)');
        // Bind values
        $this->db->bind(':collections_key', $data['collections_key']);
        $this->db->bind(':file_name', $arr[$i]);

      }

          // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }

    public function addCollection($data){

      $this->db->query('INSERT INTO collections (collections_customer_country, collections_customer_site, collections_workorder, collections_customer_number, collections_customer_group, Customer_Waste_Producer, Collections_Programme, collections_address, Colletion_Date, Order_Status, Transaction_Type, Material_Description, Material_Detail,  
                          Quantity, Unit_of_Measure, Treatment_Cost, Packaging_Cost, Transport_Cost, Other_Cost, Total_Cost, Currency, ewc_parent, ewc_sub, Waste_Vendor, Indication_of_Danger, 
                         Waste_Collector, Treatment_Facility, Treatment_Method_Detail, RD_Codes_Treatment,  
                         Container_Quantity, collections_quantity_not_kg, collections_not_kg_UOM, 
                         colletions_WTF_number, collections_cert_scan, charity_donated_to) 
                        VALUES(:collections_customer_country, :collections_customer_site, :collections_workorder, :collections_customer_number, :collections_customer_group, :Customer_Waste_Producer, :Collections_Programme,
                        :collections_address, :Colletion_Date, :Order_Status, :Transaction_Type, :Material_Description, :Material_Detail, 
                          :Quantity, :Unit_of_Measure, :Treatment_Cost, :Packaging_Cost, :Transport_Cost, :Other_Cost, :Total_Cost, :Currency, 
                        :ewc_parent, :ewc_sub, :Waste_Vendor, :Indication_of_Danger, :Waste_Collector, :Treatment_Facility, :Treatment_Method_Detail, :RD_Codes_Treatment,  :Container_Quantity, 
                        :collections_quantity_not_kg, :collections_not_kg_UOM, :colletions_WTF_number, :collections_cert_scan, :charity_donated_to)');
      // Bind values
      $this->db->bind(':collections_customer_country', $data['collections_customer_country']);
      $this->db->bind(':collections_customer_site', $data['collections_customer_site']);
      $this->db->bind(':collections_workorder', $data['collections_workorder']);
      $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
      $this->db->bind(':collections_customer_group', $data['collections_customer_group']);
      $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
      $this->db->bind(':Collections_Programme', $data['Collections_Programme']);
      $this->db->bind(':collections_address', $data['collections_address']);
      $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
      $this->db->bind(':Order_Status', $data['Order_Status']);
      $this->db->bind(':Transaction_Type', $data['Transaction_Type']);
      $this->db->bind(':Material_Description', $data['Material_Description']);
      $this->db->bind(':Material_Detail', $data['Material_Detail']);
      $this->db->bind(':Quantity', $data['Quantity']);
      $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
      $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
      $this->db->bind(':Packaging_Cost', $data['Packaging_Cost']);
      $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
      $this->db->bind(':Other_Cost', $data['Other_Cost']);
      $this->db->bind(':Total_Cost', $data['Total_Cost']);
      $this->db->bind(':Currency', $data['Currency']);
      $this->db->bind(':ewc_parent', $data['ewc_parent']);
      $this->db->bind(':ewc_sub', $data['ewc_sub']);
      $this->db->bind(':Waste_Vendor', $data['Waste_Vendor']);
      $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
      $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
      $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
      $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
      $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
      $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
      $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
      $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
      $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
      $this->db->bind(':collections_cert_scan', $data['collections_cert_scan']);
      $this->db->bind(':charity_donated_to', $data['charity_donated_to']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function addCollection_IE($data){

      $this->db->query("INSERT INTO collections (collections_customer_country, collections_customer_site, collections_workorder, collections_customer_number, collections_customer_group, Customer_Waste_Producer, collections_address, Colletion_Date, Order_Status, Transaction_Type, Material_Description, Material_Detail,  
                          Material_Description_Alt, Material_Detail_Alt, Material_UN_Code, Quantity, Unit_of_Measure, Treatment_Cost, Packaging_Cost, Transport_Cost, Other_Cost, Total_Cost, Currency, Material_Packaging_Group, Material_Class, Certificate_Number, ewc_parent, ewc_sub, Waste_Vendor, Indication_of_Danger, 
                         ENVision_Description, ENVision_Disposal, waste_type, weights_confirmed, Waste_Collector, Treatment_Facility, Treatment_Method_Detail, TFS_Number, RD_Codes_Treatment,
                         Container_Type, Container_Quantity, collections_quantity_not_kg, collections_not_kg_UOM, 
                         colletions_WTF_number, collections_cert_scan, collections_comments, charity_donated_to) 
                        VALUES(:collections_customer_country, :collections_customer_site, :collections_workorder, :collections_customer_number, :collections_customer_group, :Customer_Waste_Producer, 
                        :collections_address, :Colletion_Date, :Order_Status, :Transaction_Type, :Material_Description, :Material_Detail, :Material_Description_Alt, :Material_Detail_Alt, :Material_UN_Code,
                          :Quantity, :Unit_of_Measure, :Treatment_Cost, :Packaging_Cost, :Transport_Cost, :Other_Cost, :Total_Cost, :Currency, :Material_Packaging_Group, :Material_Class, :Certificate_Number,
                        :ewc_parent, :ewc_sub, :Waste_Vendor, :Indication_of_Danger, :ENVision_Description, :ENVision_Disposal, :waste_type, :weights_confirmed, :Waste_Collector, :Treatment_Facility, :Treatment_Method_Detail, :TFS_Number, :RD_Codes_Treatment, :Container_Type, :Container_Quantity, 
                        :collections_quantity_not_kg, :collections_not_kg_UOM, :colletions_WTF_number, :collections_cert_scan, :collections_comments, :charity_donated_to)");
      // Bind values
      $this->db->bind(':collections_customer_country', $data['collections_customer_country']);
      $this->db->bind(':collections_customer_site', $data['collections_customer_site']);
      $this->db->bind(':collections_workorder', $data['collections_workorder']);
      $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
      $this->db->bind(':collections_customer_group', $data['collections_customer_group']);
      $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
      $this->db->bind(':collections_address', $data['collections_address']);
      $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
      $this->db->bind(':Order_Status', $data['Order_Status']);
      $this->db->bind(':Transaction_Type', $data['Transaction_Type']);
      //$this->db->bind(':hazardous_checkbox', $data['hazardous_checkbox']);
      $this->db->bind(':Material_Description', $data['Material_Description']);
      $this->db->bind(':Material_Detail', $data['Material_Detail']);
      $this->db->bind(':Material_Description_Alt', $data['Material_Description_Alt']);
      $this->db->bind(':Material_Detail_Alt', $data['Material_Detail_Alt']);
      $this->db->bind(':Material_UN_Code', $data['Material_UN_Code']);
      $this->db->bind(':Quantity', $data['Quantity']);
      $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
      $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
      $this->db->bind(':Packaging_Cost', $data['Packaging_Cost']);
      $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
      $this->db->bind(':Other_Cost', $data['Other_Cost']);
      $this->db->bind(':Total_Cost', $data['Total_Cost']);
      $this->db->bind(':Currency', $data['Currency']);
      $this->db->bind(':Material_Packaging_Group', $data['Material_Packaging_Group']);
      $this->db->bind(':Material_Class', $data['Material_Class']);
      $this->db->bind(':Certificate_Number', $data['Certificate_Number']);
      $this->db->bind(':ewc_parent', $data['ewc_parent']);
      $this->db->bind(':ewc_sub', $data['ewc_sub']);
      $this->db->bind(':Waste_Vendor', $data['Waste_Vendor']);
      $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
      $this->db->bind(':ENVision_Description', $data['ENVision_Description']);
      $this->db->bind(':ENVision_Disposal', $data['ENVision_Disposal']);
      $this->db->bind(':waste_type', $data['waste_type']);
      $this->db->bind(':weights_confirmed', $data['weights_confirmed']);
      $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
      $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
      $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
      $this->db->bind(':TFS_Number', $data['TFS_Number']);
      $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
      $this->db->bind(':Container_Type', $data['Container_Type']);
      $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
      $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
      $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
      $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
      $this->db->bind(':collections_cert_scan', $data['collections_cert_scan']);
      $this->db->bind(':collections_comments', $data['collections_comments']);
      $this->db->bind(':charity_donated_to', $data['charity_donated_to']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        var_dump($data);
        return false;
      }
    }

    public function addWTF($data){
      $this->db->query('INSERT IGNORE INTO wtf_docs (wtf_client, wtf_site, wtf_date, wtf_file, wtf_number) 
                        VALUES(:wtf_client, :wtf_site, :wtf_date, :wtf_file, :wtf_number)');
      // Bind values
      $this->db->bind(':wtf_client', $data['Waste_Vendor']);
      $this->db->bind(':wtf_site', $data['collections_customer_site']);
      $this->db->bind(':wtf_date', NULL);
      $this->db->bind(':wtf_file', '');
      $this->db->bind(':wtf_number', $data['colletions_WTF_number']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


    public function updateCollection($data){

      //$collectionsDocs = $data['collections_cert_scan'];
      
      $this->db->query('UPDATE collections 
                      SET 
                      collections_customer_country = :collections_customer_country, 
                      collections_customer_site = :collections_customer_site,
                      collections_workorder = :collections_workorder, 
                      collections_customer_number = :collections_customer_number, 
                      Customer_Waste_Producer = :Customer_Waste_Producer,
                      Collections_Programme = :Collections_Programme,  
                      collections_address = :collections_address,
                      collections_customer_group = :collections_customer_group, 
                      Colletion_Date = :Colletion_Date,
                      Order_Status = :Order_Status,
                      Material_Description = :Material_Description, 
                      Material_Detail = :Material_Detail,
                      Quantity = :Quantity, 
                      Unit_of_Measure = :Unit_of_Measure,
                      Treatment_Cost = :Treatment_Cost,
                      Packaging_Cost = :Packaging_Cost,
                      Transport_Cost = :Transport_Cost,
                      Other_Cost = :Other_Cost,
                      Total_Cost = :Total_Cost,
                      Currency = :Currency,
                      ewc_parent = :ewc_parent,
                      ewc_sub = :ewc_sub,
                      Waste_Vendor = :Waste_Vendor, 
                      Indication_of_Danger = :Indication_of_Danger, 
                      Waste_Collector = :Waste_Collector,
                      Treatment_Facility = :Treatment_Facility, 
                      Treatment_Method_Detail = :Treatment_Method_Detail, 
                      RD_Codes_Treatment = :RD_Codes_Treatment, 
                      Container_Quantity = :Container_Quantity, 
                      collections_quantity_not_kg = :collections_quantity_not_kg , 
                      collections_not_kg_UOM= :collections_not_kg_UOM ,  
                      colletions_WTF_number= :colletions_WTF_number,
                      collections_cert_scan = :collections_cert_scan
                      WHERE collections_key = :collections_key');
      // Bind values
                    $this->db->bind(':collections_key', $data['collections_key']);
                    $this->db->bind(':collections_customer_country', $data['collections_customer_country']);
                    $this->db->bind(':collections_customer_site', $data['collections_customer_site']);
                    $this->db->bind(':collections_workorder', $data['collections_workorder']);
                    $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
                    $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
                    $this->db->bind(':Collections_Programme', $data['Collections_Programme']);
                    $this->db->bind(':collections_address', $data['collections_address']);
                    $this->db->bind(':collections_customer_group', $data['collections_customer_group']);
                    $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
                    $this->db->bind(':Order_Status', $data['Order_Status']);
                    $this->db->bind(':Material_Description', $data['Material_Description']);
                    $this->db->bind(':Material_Detail', $data['Material_Detail']);
                    $this->db->bind(':Quantity', $data['Quantity']);
                    $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
                    $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
                    $this->db->bind(':Packaging_Cost', $data['Packaging_Cost']);
                    $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
                    $this->db->bind(':Other_Cost', $data['Other_Cost']);
                    $this->db->bind(':Total_Cost', $data['Total_Cost']);
                    $this->db->bind(':Currency', $data['Currency']);   
                    $this->db->bind(':ewc_parent', $data['ewc_parent']);  
                    $this->db->bind(':ewc_sub', $data['ewc_sub']);      
                    $this->db->bind(':Waste_Vendor', $data['Waste_Vendor']);
                    $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
                    $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
                    $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
                    $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
                    $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
                    $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
                    $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
                    $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
                    $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
                    $this->db->bind(':collections_cert_scan', '');

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateCollection_IE($data){

      $this->db->query('UPDATE collections 
                      SET 
                      collections_customer_country = :collections_customer_country, 
                      collections_customer_site = :collections_customer_site,
                      collections_workorder = :collections_workorder, 
                      collections_customer_number = :collections_customer_number,
                      collections_customer_group = :collections_customer_group, 
                      Customer_Waste_Producer = :Customer_Waste_Producer,  
                      collections_address = :collections_address,
                      Colletion_Date = :Colletion_Date,
                      Order_Status = :Order_Status,
                      Material_Description = :Material_Description, 
                      Material_Detail = :Material_Detail,
                      Material_Description_Alt = :Material_Description_Alt, 
                      Material_Detail_Alt = :Material_Detail_Alt,
                      Material_UN_Code = :Material_UN_Code,
                      Quantity = :Quantity, 
                      Unit_of_Measure = :Unit_of_Measure,
                      Treatment_Cost = :Treatment_Cost,
                      Packaging_Cost = :Packaging_Cost,
                      Transport_Cost = :Transport_Cost,
                      Other_Cost = :Other_Cost,
                      Total_Cost = :Total_Cost,
                      Currency = :Currency,
                      Material_Packaging_Group = :Material_Packaging_Group,
                      Material_Class = :Material_Class,
                      Certificate_Number = :Certificate_Number,
                      ewc_parent = :ewc_parent,
                      ewc_sub = :ewc_sub,
                      Waste_Vendor = :Waste_Vendor, 
                      Indication_of_Danger = :Indication_of_Danger, 
                      ENVision_Description = :ENVision_Description,
                      ENVision_Disposal = :ENVision_Disposal,
                      waste_type = :waste_type,
                      weights_confirmed =  :weights_confirmed,
                      Waste_Collector = :Waste_Collector,
                      Treatment_Facility = :Treatment_Facility, 
                      Treatment_Method_Detail = :Treatment_Method_Detail,
                      TFS_Number = :TFS_Number, 
                      RD_Codes_Treatment = :RD_Codes_Treatment, 
                      Container_Type = :Container_Type,
                      Container_Quantity = :Container_Quantity, 
                      collections_quantity_not_kg = :collections_quantity_not_kg , 
                      collections_not_kg_UOM= :collections_not_kg_UOM ,  
                      colletions_WTF_number= :colletions_WTF_number,
                      collections_cert_scan= :collections_cert_scan,
                      collections_comments = :collections_comments,
                      charity_donated_to = :charity_donated_to 
                      WHERE collections_key = :collections_key');
      // Bind values
                    $this->db->bind(':collections_key', $data['collections_key']);
                    $this->db->bind(':collections_customer_country', $data['collections_customer_country']);
                    $this->db->bind(':collections_customer_site', $data['collections_customer_site']);
                    $this->db->bind(':collections_workorder', $data['collections_workorder']);
                    $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
                    $this->db->bind(':collections_customer_group', $data['collections_customer_group']);
                    $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
                    $this->db->bind(':collections_address', $data['collections_address']);
                    $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
                    $this->db->bind(':Order_Status', $data['Order_Status']);
                    $this->db->bind(':Material_Description', $data['Material_Description']);
                    $this->db->bind(':Material_Detail', $data['Material_Detail']);
                    $this->db->bind(':Material_Description_Alt', $data['Material_Description_Alt']);
                    $this->db->bind(':Material_Detail_Alt', $data['Material_Detail_Alt']);
                    $this->db->bind(':Material_UN_Code', $data['Material_UN_Code']);
                    $this->db->bind(':Quantity', $data['Quantity']);
                    $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
                    $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
                    $this->db->bind(':Packaging_Cost', $data['Packaging_Cost']);
                    $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
                    $this->db->bind(':Other_Cost', $data['Other_Cost']);
                    $this->db->bind(':Total_Cost', $data['Total_Cost']);
                    $this->db->bind(':Currency', $data['Currency']);
                    $this->db->bind(':Material_Packaging_Group', $data['Material_Packaging_Group']);
                    $this->db->bind(':Material_Class', $data['Material_Class']);
                    $this->db->bind(':Certificate_Number', $data['Certificate_Number']);
                    $this->db->bind(':ewc_parent', $data['ewc_parent']);
                    $this->db->bind(':ewc_sub', $data['ewc_sub']);
                    $this->db->bind(':Waste_Vendor', $data['Waste_Vendor']);
                    $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
                    $this->db->bind(':ENVision_Description', $data['ENVision_Description']);
                    $this->db->bind(':ENVision_Disposal', $data['ENVision_Disposal']);
                    $this->db->bind(':waste_type', $data['waste_type']);
                    $this->db->bind(':weights_confirmed', $data['weights_confirmed']);
                    $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
                    $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
                    $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
                    $this->db->bind(':TFS_Number', $data['TFS_Number']);
                    $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
                    $this->db->bind(':Container_Type', $data['Container_Type']);
                    $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
                    $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
                    $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
                    $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
                    //$this->db->bind(':colletions_cert_scan', $data['colletions_cert_scan']);
                    $this->db->bind(':collections_cert_scan', '');
                    $this->db->bind(':collections_comments', $data['collections_comments']);
                    $this->db->bind(':charity_donated_to', $data['charity_donated_to']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function downloadDocs(){
      if(!empty($_GET['file'])){
        $filename  = basename($_GET['file']);
        $filePath = APPROOT . '/views/collections/files/'.$filename;
        
        if(!empty($filename) && file_exists($filePath)){
            //define header
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            
            ob_clean();
            flush();
            //read file 
            readfile($filePath);
            exit;
        }
        else{
            echo "file not exit";
        }
    }
  }

  public function deleteDocs($data)
  {
    // if (!empty($_GET['file'])) {
    // $filename  = basename($_GET['file']);
    // $collectionKey = $_GET['key'];
    // $str_arr = explode (",", $filename);
    // foreach ($str_arr as $value) {
    //  $filePath = APPROOT . '/views/collections/files/' . $value;
    //   unlink($filePath);
    // }
    $filePath = APPROOT . '/views/collections/files/' . $data['file_name'];
    unlink($filePath);
    //$this->db->query("UPDATE collections SET collections_cert_scan = '' WHERE collections_key = '".$collectionKey."'");
    $this->db->query("DELETE FROM collections_files WHERE collections_key = '".$data['collections_key']."' AND file_name = '".$data['file_name']."'");
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  //}

    public function getCollectionById($collections_key){
      $this->db->query('SELECT * FROM collections WHERE collections_key = :collections_key');
      $this->db->bind(':collections_key', $collections_key);

      $row = $this->db->single();
      
      return $row;
    }

    public function deleteCollection($collections_key){

      // Remove the actual files
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT * FROM `collections_files` WHERE `collections_key` = '$collections_key'";
      $result = mysqli_query($db, $sql);
      while ($row = mysqli_fetch_array($result)) {
        $filePath = APPROOT . '/views/collections/files/' . $row['file_name'];
        unlink($filePath);
      }

      // Delete Entries from collections_files table
      $sql = "DELETE FROM `collections_files` WHERE `collections_key` = '$collections_key'";
      $result = mysqli_query($db, $sql);

      // Delete Entries from collections table
      $this->db->query('DELETE FROM collections WHERE collections_key = :collections_key');
      // Bind values
      $this->db->bind(':collections_key', $collections_key);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }