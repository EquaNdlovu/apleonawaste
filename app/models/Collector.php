<?php
  class collector {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getcollectors(){
      $this->db->query('SELECT *
                        FROM waste_collector
                        ORDER BY waste_collector_name DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addcollector($data){
      $this->db->query('INSERT INTO waste_collector 
                    (waste_collector_name, waste_collector_country) 
                    VALUES(:waste_collector_name, :waste_collector_country)');
      // Bind values
      $this->db->bind(':waste_collector_name', $data['waste_collector_name']);
      $this->db->bind(':waste_collector_country', $data['waste_collector_country']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updatecollector($data){
      $this->db->query('UPDATE waste_collector SET 
                        waste_collector_name = :waste_collector_name, waste_collector_country = :waste_collector_country 
                        WHERE waste_collector_key = :waste_collector_key');
      // Bind values
      $this->db->bind(':waste_collector_key', $data['waste_collector_key']);
      $this->db->bind(':waste_collector_name', $data['waste_collector_name']);
      $this->db->bind(':waste_collector_country', $data['waste_collector_country']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getcollectorById($waste_collector_key){
      $this->db->query('SELECT * FROM waste_collector WHERE waste_collector_key = :waste_collector_key');
      $this->db->bind(':waste_collector_key', $waste_collector_key);

      $row = $this->db->single();

      return $row;
    }

    public function deletecollector($waste_collector_key){
      $this->db->query('DELETE FROM waste_collector WHERE waste_collector_key = :waste_collector_key');
      // Bind values
      $this->db->bind(':waste_collector_key', $waste_collector_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }