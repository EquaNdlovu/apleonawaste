<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

      // Reset password
      public function new_password($data){
        $email=$_SESSION['email'];
        $this->db->query('UPDATE apleona_waste_users SET password=:password WHERE email=:email');
        // Bind values
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $data['password']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

    // Reset password
    public function reset_password($data){
      $this->db->query('UPDATE apleona_waste_users SET password=:password WHERE id=:id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO apleona_waste_users (name, email, password, customer_group, user_type, country) VALUES(:name, :email, :password, :customer_group, :user_type, :country)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':customer_group', $data['customer_group']);
      $this->db->bind(':user_type', $data['user_type']);
      $this->db->bind(':country', $data['country']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM apleona_waste_users WHERE email = :email');
      $this->db->bind(':email', $email);
      //$this->db->bind(':user_type', $user_type);
      //$this->db->bind(':customer_group', $customer_group);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM apleona_waste_users WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);
      //$this->db->bind(':user_type', $user_type);
      //$this->db->bind(':customer_group', $customer_group);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    public function updateUser($data){
      $this->db->query('UPDATE apleona_waste_users 
                      SET name = :name, email = :email, customer_group = :customer_group, user_type = :user_type, country = :country
                      WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':customer_group', $data['customer_group']);
      $this->db->bind(':user_type', $data['user_type']);
      $this->db->bind(':country', $data['country']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get User by ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM apleona_waste_users WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      //$this->db->bind(':user_type', $user_type);
      //$this->db->bind(':customer_group', $customer_group);

      $row = $this->db->single();

      return $row;
    }

    public function deleteUser($id){
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

     public function getUsers(){
      $this->db->query('SELECT *                     
                        FROM apleona_waste_users 
                        ORDER BY name ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }
  }