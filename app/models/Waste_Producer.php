<?php



  class Waste_Producer {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getWasteProducers(){
      $this->db->query("SELECT * FROM wm_waste_producer WHERE waste_producer_country = '". $_SESSION['country'] ."' ORDER BY waste_producer_key DESC");

      $results = $this->db->resultSet();

      return $results;
    }

    public function addWasteProducer($data){
      $this->db->query('INSERT INTO wm_waste_producer 
                    (waste_producer_name, waste_producer_customer, waste_producer_country) 
                    VALUES(:waste_producer_name, :waste_producer_customer, :waste_producer_country)');
      // Bind values
      $this->db->bind(':waste_producer_name', $data['waste_producer_name']);
      $this->db->bind(':waste_producer_customer', $data['waste_producer_customer']);
      $this->db->bind(':waste_producer_country', $data['waste_producer_country']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateWasteProducer($data){
      $this->db->query('UPDATE wm_waste_producer SET 
                        waste_producer_name = :waste_producer_name,
                        waste_producer_customer = :waste_producer_customer,
                        waste_producer_country = :waste_producer_country
                        WHERE waste_producer_key = :waste_producer_key');
      // Bind values
      $this->db->bind(':waste_producer_key', $data['waste_producer_key']);
      $this->db->bind(':waste_producer_name', $data['waste_producer_name']);
      $this->db->bind(':waste_producer_customer', $data['waste_producer_customer']);
      $this->db->bind(':waste_producer_country', $data['waste_producer_country']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getProducerById($waste_producer_key){
      $this->db->query('SELECT * FROM wm_waste_producer WHERE waste_producer_key = :waste_producer_key');
      $this->db->bind(':waste_producer_key', $waste_producer_key);

      $row = $this->db->single();

      return $row;
    }
}