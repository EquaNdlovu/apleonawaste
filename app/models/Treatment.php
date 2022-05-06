<?php
  class Treatment {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTreatments(){
      $this->db->query('SELECT *
                        FROM treatment_facility
                        ORDER BY treatment_facility_name DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addTreatment($data){
      $this->db->query('INSERT INTO treatment_facility 
                    (treatment_facility_name, treatment_facility_country) 
                    VALUES(:treatment_facility_name, :treatment_facility_country)');
      // Bind values
      $this->db->bind(':treatment_facility_name', $data['treatment_facility_name']);
      $this->db->bind(':treatment_facility_country', $data['treatment_facility_country']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateTreatment($data){
      $this->db->query('UPDATE treatment_facility SET 
                        treatment_facility_name = :treatment_facility_name  
                        WHERE treatment_facility_key = :treatment_facility_key');
      // Bind values
      $this->db->bind(':treatment_facility_key', $data['treatment_facility_key']);
      $this->db->bind(':treatment_facility_name', $data['treatment_facility_name']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getTreatmentById($treatment_facility_key){
      $this->db->query('SELECT * FROM treatment_facility WHERE treatment_facility_key = :treatment_facility_key');
      $this->db->bind(':treatment_facility_key', $treatment_facility_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteTreatment($treatment_facility_key){
      $this->db->query('DELETE FROM treatment_facility WHERE treatment_facility_key = :treatment_facility_key');
      // Bind values
      $this->db->bind(':treatment_facility_key', $treatment_facility_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }