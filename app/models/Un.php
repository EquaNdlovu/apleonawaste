<?php
  class Un {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getUns(){
      $this->db->query('SELECT *
                        FROM un_codes
                        ORDER BY un_code_key ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addUn($data){
      $this->db->query('INSERT INTO un_codes 
                    (un_code, un_code_description) 
                    VALUES(:un_code, :un_code_description)');
      // Bind values
      $this->db->bind(':un_code', $data['un_code']);
      $this->db->bind(':un_code_description', $data['un_code_description']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateUn($data){
      $this->db->query('UPDATE un_codes SET 
                        un_code = :un_code, un_code_description = :un_code_description
                        WHERE un_code_key = :un_code_key');
      // Bind values
      $this->db->bind(':un_code', $data['un_code']);
      $this->db->bind(':un_code_description', $data['un_code_description']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getUnById($un_code_key){
      $this->db->query('SELECT * FROM un_codes WHERE un_code_key = :un_code_key');
      $this->db->bind(':un_code_key', $un_code_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteUn($un_code_key){
      $this->db->query('DELETE FROM un_codes WHERE un_code_key = :un_code_key');
      // Bind values
      $this->db->bind(':un_code_key', $un_code_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }