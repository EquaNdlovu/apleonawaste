<?php
  class user_list {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getuser_list(){
      $this->db->query('SELECT *
                        FROM apleona_waste_users
                        ORDER BY name ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function adduserlist($data){
      $this->db->query('INSERT INTO apleona_waste_users 
                    (name, email, password, customer_group, country, customer, primary_site, user_type, created_at) 
                    VALUES(:name, :email, :password, :customer_group, :country, :customer, :primary_site, :user_type, :created_at)');
      // Bind values
     $this->db->bind(':name', $data['name']);
     $this->db->bind(':email', $data['email']);
     $this->db->bind(':password', $data['password']);
     $this->db->bind(':customer_group', $data['customer_group']);
     $this->db->bind(':country', $data['country']);
     $this->db->bind(':customer', $data['customer']);
     $this->db->bind(':primary_site', $data['primary_site']);
     $this->db->bind(':user_type', $data['user_type']);
     $this->db->bind(':created_at', $data['created_at']);



      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateuser_list($data){
      $this->db->query('UPDATE apleona_waste_users SET 
                        id = :id, name = :name, email = :email, password = :password, customer_group = :customer_group, country = :country, customer = :customer, primary_site = :primary_site, user_type = :user_type, created_at = :created_at
                        WHERE id = :id');
      // Bind values
     $this->db->bind(':id', $data['id']);
     $this->db->bind(':name', $data['name']);
     $this->db->bind(':email', $data['email']);
     $this->db->bind(':password', $data['password']);
     $this->db->bind(':customer_group', $data['customer_group']);
     $this->db->bind(':country', $data['country']);
     $this->db->bind(':customer', $data['customer']);
     $this->db->bind(':primary_site', $data['primary_site']);
     $this->db->bind(':user_type', $data['user_type']);
     $this->db->bind(':created_at', $data['created_at']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getuser_listById($rd_key){
      $this->db->query('SELECT * FROM apleona_waste_users WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteuser_list($rd_key){
      $this->db->query('DELETE FROM apleona_waste_users WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }