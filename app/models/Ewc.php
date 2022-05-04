<?php
  class Ewc {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEwcs(){
      $this->db->query('SELECT *
                        FROM ewc_codes
                        ORDER BY ewc_code ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addEwc($data){
      $this->db->query('INSERT INTO ewc_codes 
                    (ewc_code_numberic, ewc_code, ewc_description, ewc_indication_of_danger) 
                    VALUES(:ewc_code_numberic, :ewc_code, :ewc_description, :ewc_indication_of_danger)');
      // Bind values
      $this->db->bind(':ewc_code_numberic', $data['ewc_code_numberic']);
      $this->db->bind(':ewc_code', $data['ewc_code']);
      $this->db->bind(':ewc_description', $data['ewc_description']);
      $this->db->bind(':ewc_indication_of_danger', $data['ewc_indication_of_danger']);



      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateEwc($data){
      $this->db->query('UPDATE ewc_codes SET 
                        ewc_code_numberic = :ewc_code_numberic, ewc_code = :ewc_code, ewc_description = :ewc_description, ewc_indication_of_danger = :ewc_indication_of_danger
                        WHERE ewc_key = :ewc_key');
      // Bind values
      $this->db->bind(':ewc_key', $data['ewc_key']);
      $this->db->bind(':ewc_code_numberic', $data['ewc_code_numberic']);
      $this->db->bind(':ewc_code', $data['ewc_code']);
      $this->db->bind(':ewc_description', $data['ewc_description']);
      $this->db->bind(':ewc_indication_of_danger', $data['ewc_indication_of_danger']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getEwcById($ewc_key){
      $this->db->query('SELECT * FROM ewc_codes WHERE ewc_key = :ewc_key');
      $this->db->bind(':ewc_key', $ewc_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteEwc($ewc_key){
      $this->db->query('DELETE FROM ewc_codes WHERE ewc_key = :ewc_key');
      // Bind values
      $this->db->bind(':ewc_key', $ewc_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }