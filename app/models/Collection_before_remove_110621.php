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

    public function addCollection($data){
      $this->db->query('INSERT INTO collections (collections_workorder, collections_customer_number, Customer_Waste_Producer, collections_address, Colletion_Date, Order_Status, Transaction_Type, Material_Description, Material_Detail, Material_UN_Code, Material_Dangerous_Goods_Label, 
                         Material_Packaging_Group, Quantity, Unit_of_Measure, Treatment_Cost, Transport_Cost, Consulting_Cost, Other_Cost, Total_Cost, Currency, EWC, Indication_of_Danger, 
                        Delivery_Number_Docket_Number, 
                        Waste_Collector, Treatment_Facility, Treatment_Method_Detail, TFS_Number, TFS_Load_Number, RD_Codes_Storage, RD_Codes_Treatment,  
                         Container_Type, Container_ID_No, Container_Quantity, collections_quantity_not_kg, collections_not_kg_UOM, 
                         colletions_WTF_number, collections_comments) 
                        VALUES(:collections_customer_number, :Customer_Waste_Producer, 
                        :collections_address, :Colletion_Date, :Order_Status, :Transaction_Type, :Material_Description, :Material_Detail, 
                        :Material_UN_Code, :Material_Dangerous_Goods_Label,  :Material_Packaging_Group, :Quantity, :Unit_of_Measure, 
                        :Treatment_Cost, :Transport_Cost, :Consulting_Cost, :Other_Cost, :Total_Cost, :Currency, :EWC, :Indication_of_Danger, 
                        :Delivery_Number_Docket_Number, :Waste_Collector, :Treatment_Facility, :Treatment_Method_Detail, :TFS_Number, 
                        :TFS_Load_Number, :RD_Codes_Storage, :RD_Codes_Treatment,  :Container_Type, :Container_ID_No, :Container_Quantity, 
                        :collections_quantity_not_kg, :collections_not_kg_UOM, :colletions_WTF_number, :collections_comments)');
      // Bind values
      $this->db->bind(':collections_workorder', $data['collections_workorder']);
      $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
      $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
      $this->db->bind(':collections_address', $data['collections_address']);
      $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
      $this->db->bind(':Order_Status', $data['Order_Status']);
      $this->db->bind(':Transaction_Type', $data['Transaction_Type']);
      $this->db->bind(':Material_Description', $data['Material_Description']);
      $this->db->bind(':Material_Detail', $data['Material_Detail']);
      $this->db->bind(':Material_UN_Code', $data['Material_UN_Code']);
      $this->db->bind(':Material_Dangerous_Goods_Label', $data['Material_Dangerous_Goods_Label']);
      $this->db->bind(':Material_Packaging_Group', $data['Material_Packaging_Group']);
      $this->db->bind(':Quantity', $data['Quantity']);
      $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
      $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
      $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
      $this->db->bind(':Consulting_Cost', $data['Consulting_Cost']);
      $this->db->bind(':Other_Cost', $data['Other_Cost']);
      $this->db->bind(':Total_Cost', $data['Total_Cost']);
      $this->db->bind(':Currency', $data['Currency']);
      $this->db->bind(':EWC', $data['EWC']);
      $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
      $this->db->bind(':Delivery_Number_Docket_Number', $data['Delivery_Number_Docket_Number']);
      $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
      $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
      $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
      $this->db->bind(':TFS_Number', $data['TFS_Number']);
      $this->db->bind(':TFS_Load_Number', $data['TFS_Load_Number']);
      $this->db->bind(':RD_Codes_Storage', $data['RD_Codes_Storage']);
      $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
      $this->db->bind(':Container_Type', $data['Container_Type']);
      $this->db->bind(':Container_ID_No', $data['Container_ID_No']);
      $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
      $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
      $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
      $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
      $this->db->bind(':collections_comments', $data['collections_comments']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


    public function updateCollection($data){
      $this->db->query('UPDATE collections 
                      SET collections_customer_number = :collections_customer_number, collections_customer_group = :collections_customer_group, collections_customer = :collections_customer, Customer_Waste_Producer = :Customer_Waste_Producer, collections_address = :collections_address, Colletion_Date = :Colletion_Date, Order_Status = :Order_Status, Transaction_Type = :Transaction_Type, Material_Description = :Material_Description, Material_Detail = :Material_Detail, Material_UN_Code = :Material_UN_Code, Material_Dangerous_Goods_Label = :Material_Dangerous_Goods_Label,  Material_Packaging_Group = :Material_Packaging_Group, Quantity = :Quantity, Unit_of_Measure = :Unit_of_Measure, Treatment_Cost = :Treatment_Cost, Transport_Cost = :Transport_Cost, Consulting_Cost = :Consulting_Cost, Other_Cost = :Other_Cost, Total_Cost = :Total_Cost, Currency = :Currency, EWC = :EWC, Indication_of_Danger = :Indication_of_Danger, Delivery_Number_Docket_Number = :Delivery_Number_Docket_Number, Waste_Collector = :Waste_Collector, Treatment_Facility = :Treatment_Facility, Treatment_Method_Detail = :Treatment_Method_Detail, TFS_Number = :TFS_Number, TFS_Load_Number = :TFS_Load_Number, RD_Codes_Storage = :RD_Codes_Storage, RD_Codes_Treatment = :RD_Codes_Treatment, Container_Type = :Container_Type, Container_ID_No = :Container_ID_No, Container_Quantity = :Container_Quantity, collections_quantity_not_kg = :collections_quantity_not_kg , collections_not_kg_UOM= :collections_not_kg_UOM ,  colletions_WTF_number= :colletions_WTF_number , collections_comments= :collections_comments ,
                      WHERE collections_key = :collections_key');
      // Bind values
      $this->db->bind(':collections_customer_number', $data['collections_customer_number']);
      $this->db->bind(':collections_customer_group', $data['collections_customer_group']);
      $this->db->bind(':collections_customer', $data['collections_customer']);
      $this->db->bind(':Customer_Waste_Producer', $data['Customer_Waste_Producer']);
      $this->db->bind(':collections_address', $data['collections_address']);
      $this->db->bind(':Colletion_Date', $data['Colletion_Date']);
      $this->db->bind(':Order_Status', $data['Order_Status']);
      $this->db->bind(':Transaction_Type', $data['Transaction_Type']);
      $this->db->bind(':Material_Description', $data['Material_Description']);
      $this->db->bind(':Material_Detail', $data['Material_Detail']);
      $this->db->bind(':Material_UN_Code', $data['Material_UN_Code']);
      $this->db->bind(':Material_Dangerous_Goods_Label', $data['Material_Dangerous_Goods_Label']);
      $this->db->bind(':Material_Packaging_Group', $data['Material_Packaging_Group']);
      $this->db->bind(':Quantity', $data['Quantity']);
      $this->db->bind(':Unit_of_Measure', $data['Unit_of_Measure']);
      $this->db->bind(':Treatment_Cost', $data['Treatment_Cost']);
      $this->db->bind(':Transport_Cost', $data['Transport_Cost']);
      $this->db->bind(':Consulting_Cost', $data['Consulting_Cost']);
      $this->db->bind(':Other_Cost', $data['Other_Cost']);
      $this->db->bind(':Total_Cost', $data['Total_Cost']);
      $this->db->bind(':Currency', $data['Currency']);
      $this->db->bind(':EWC', $data['EWC']);
      $this->db->bind(':Indication_of_Danger', $data['Indication_of_Danger']);
      $this->db->bind(':Delivery_Number_Docket_Number', $data['Delivery_Number_Docket_Number']);
      $this->db->bind(':Waste_Collector', $data['Waste_Collector']);
      $this->db->bind(':Treatment_Facility', $data['Treatment_Facility']);
      $this->db->bind(':Treatment_Method_Detail', $data['Treatment_Method_Detail']);
      $this->db->bind(':TFS_Number', $data['TFS_Number']);
      $this->db->bind(':TFS_Load_Number', $data['TFS_Load_Number']);
      $this->db->bind(':RD_Codes_Storage', $data['RD_Codes_Storage']);
      $this->db->bind(':RD_Codes_Treatment', $data['RD_Codes_Treatment']);
      $this->db->bind(':Container_Type', $data['Container_Type']);
      $this->db->bind(':Container_ID_No', $data['Container_ID_No']);
      $this->db->bind(':Container_Quantity', $data['Container_Quantity']);
      $this->db->bind(':collections_quantity_not_kg', $data['collections_quantity_not_kg']);
      $this->db->bind(':collections_not_kg_UOM', $data['collections_not_kg_UOM']);
      $this->db->bind(':colletions_WTF_number', $data['colletions_WTF_number']);
      $this->db->bind(':collections_comments', $data['collections_comments']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getCollectionById($collections_key){
      $this->db->query('SELECT * FROM collections WHERE collections_key = :collections_key');
      $this->db->bind(':collections_key', $collections_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteCollection($collections_key){
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