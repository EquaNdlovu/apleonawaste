<?php
  class Broker {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getBrokers(){
      $this->db->query('SELECT *
                        FROM waste_broker
                        ORDER BY waste_broker_name DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addBroker($data){
      $this->db->query('INSERT INTO waste_broker 
                    (waste_broker_name, waste_broker_country) 
                    VALUES(:waste_broker_name, :waste_broker_country)');
      // Bind values
      $this->db->bind(':waste_broker_name', $data['waste_broker_name']);
      $this->db->bind(':waste_broker_country', $data['waste_broker_country']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateBroker($data){
      $this->db->query('UPDATE waste_broker SET 
                        waste_broker_name = :waste_broker_name, waste_broker_country = :waste_broker_country  
                        WHERE waste_broker_key = :waste_broker_key');
      // Bind values
      $this->db->bind(':waste_broker_key', $data['waste_broker_key']);
      $this->db->bind(':waste_broker_name', $data['waste_broker_name']);
      $this->db->bind(':waste_broker_country', $data['waste_broker_country']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getBrokerById($waste_broker_key){
      $this->db->query('SELECT * FROM waste_broker WHERE waste_broker_key = :waste_broker_key');
      $this->db->bind(':waste_broker_key', $waste_broker_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteBroker($waste_broker_key){
      $this->db->query('DELETE FROM waste_broker WHERE waste_broker_key = :waste_broker_key');
      // Bind values
      $this->db->bind(':waste_broker_key', $waste_broker_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }