<?php
  class Lookup_Charity {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getOptions(){
        $this->db->query('SELECT *                     
                          FROM lookup_charities 
                          ORDER BY lookup_key ASC
                          ');
  
        $results = $this->db->resultSet();
  
        return $results;
      }

    public function add($data){
      $this->db->query('INSERT INTO lookup_charities (description, customer) VALUES(:description, :customer)');
      // Bind values
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':customer', $data['customer']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateDescription($data){
      $this->db->query('UPDATE lookup_charities 
                      SET description = :description
                      WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':description', $data['description']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get User by ID
    public function getDescriptionById($lookup_key){
      $this->db->query('SELECT * FROM lookup_charities WHERE lookup_key = :lookup_key');
      // Bind value
      $this->db->bind(':lookup_key', $lookup_key);
      //$this->db->bind(':user_type', $user_type);
      //$this->db->bind(':customer_group', $customer_group);

      $row = $this->db->single();

      return $row;
    }

    public function deleteOption($lookup_key){
      $this->db->query('DELETE FROM lookup_charities WHERE lookup_key = :lookup_key');
      // Bind values
      $this->db->bind(':lookup_key', $lookup_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }