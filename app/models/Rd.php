<?php
  class Rd {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getRds(){
      $this->db->query('SELECT *
                        FROM recovery_disposal_rd_codes
                        ORDER BY rd_name ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addRd($data){
      $this->db->query('INSERT INTO recovery_disposal_rd_codes 
                    (rd_code, rd_name, rd_description) 
                    VALUES(:rd_code, :rd_name, :rd_description)');
      // Bind values
      $this->db->bind(':rd_code', $data['rd_code']);
      $this->db->bind(':rd_name', $data['rd_name']);
      $this->db->bind(':rd_description', $data['rd_description']);



      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateRd($data){
      $this->db->query('UPDATE recovery_disposal_rd_codes SET 
                        rd_code = :rd_code, rd_name = :rd_name, rd_description = :rd_description
                        WHERE rd_key = :rd_key');
      // Bind values
      $this->db->bind(':rd_key', $data['rd_key']);
      $this->db->bind(':rd_code', $data['rd_code']);
      $this->db->bind(':rd_name', $data['rd_name']);
      $this->db->bind(':rd_description', $data['rd_description']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getRdById($rd_key){
      $this->db->query('SELECT * FROM recovery_disposal_rd_codes WHERE rd_key = :rd_key');
      $this->db->bind(':rd_key', $rd_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteRd($rd_key){
      $this->db->query('DELETE FROM recovery_disposal_rd_codes WHERE rd_key = :rd_key');
      // Bind values
      $this->db->bind(':rd_key', $rd_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }