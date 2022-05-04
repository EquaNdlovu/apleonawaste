<?php



  class Customer {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCustomers(){
      $this->db->query("SELECT * FROM wm_customer WHERE waste_customer_country = '". $_SESSION['country'] ."' ORDER BY waste_customer_key DESC");

      $results = $this->db->resultSet();

      return $results;
    }

    public function addCustomer($data){
      $this->db->query('INSERT INTO wm_customer 
                    (waste_customer_country, waste_customer_name, waste_customer_address, waste_customer_group) 
                    VALUES(:waste_customer_country, :waste_customer_name, :waste_customer_address, :waste_customer_group)');
      // Bind values
      $this->db->bind(':waste_customer_country', $data['waste_customer_country']);
      $this->db->bind(':waste_customer_name', $data['waste_customer_name']);
      $this->db->bind(':waste_customer_address', $data['waste_customer_address']);
      $this->db->bind(':waste_customer_group', $data['waste_customer_group']);
     


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateCustomer($data){
      $this->db->query('UPDATE wm_customer SET 
                        waste_customer_country = :waste_customer_country,
                        waste_customer_name = :waste_customer_name, 
                        waste_customer_address = :waste_customer_address, 
                        waste_customer_group = :waste_customer_group  
                        WHERE waste_customer_key = :waste_customer_key');
      // Bind values
      $this->db->bind(':waste_customer_key', $data['waste_customer_key']);
      $this->db->bind(':waste_customer_country', $data['waste_customer_country']);
      $this->db->bind(':waste_customer_name', $data['waste_customer_name']);
      $this->db->bind(':waste_customer_address', $data['waste_customer_address']);
      $this->db->bind(':waste_customer_group', $data['waste_customer_group']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getCustomerById($waste_customer_key){


      $this->db->query('SELECT * FROM wm_customer WHERE waste_customer_key = :waste_customer_key');
      $this->db->bind(':waste_customer_key', $waste_customer_key);
      //$this->db->bind(':waste_customer_country', $waste_customer_country);
      //$this->db->bind(':waste_customer_name', $waste_customer_name);
      $row = $this->db->single();
      
      return $row;
    }

    public function deleteCustomer($waste_customer_key){
      $this->db->query('DELETE FROM wm_customer WHERE waste_customer_key = :waste_customer_key');
      // Bind values
      $this->db->bind(':waste_customer_key', $waste_customer_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }