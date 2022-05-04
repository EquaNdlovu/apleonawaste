<?php
  class Site {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getSites(){
      $this->db->query("SELECT * FROM wm_site WHERE waste_site_country = '". $_SESSION['country'] ."' ORDER BY waste_site_customer DESC");

      $results = $this->db->resultSet();

      return $results;
    }

    public function addSite($data){
      $this->db->query('INSERT INTO wm_site 
                    (waste_site_country, waste_site_customer, waste_site_name, waste_site_address) 
                    VALUES(:waste_site_country, :waste_site_customer, :waste_site_name, :waste_site_address)');
      // Bind values
      $this->db->bind(':waste_site_country', $data['waste_site_country']);
      $this->db->bind(':waste_site_customer', $data['waste_site_customer']);
      $this->db->bind(':waste_site_name', $data['waste_site_name']);
      $this->db->bind(':waste_site_address', $data['waste_site_address']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateSite($data){
      $this->db->query('UPDATE wm_site SET 
                        waste_site_country = :waste_site_country,
                        waste_site_customer = :waste_site_customer,
                        waste_site_name = :waste_site_name,
                        waste_site_address = :waste_site_address
                        WHERE waste_site_key = :waste_site_key');
      // Bind values
      $this->db->bind(':waste_site_key', $data['waste_site_key']);
      $this->db->bind(':waste_site_country', $data['waste_site_country']);
      $this->db->bind(':waste_site_customer', $data['waste_site_customer']);
      $this->db->bind(':waste_site_name', $data['waste_site_name']);
      $this->db->bind(':waste_site_address', $data['waste_site_address']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getSiteById($waste_site_key){
      $this->db->query('SELECT * FROM wm_site WHERE waste_site_key = :waste_site_key');
      $this->db->bind(':waste_site_key', $waste_site_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteSite($waste_site_key){
      $this->db->query('DELETE FROM wm_site WHERE waste_site_key = :waste_site_key');
      // Bind values
      $this->db->bind(':waste_site_key', $waste_site_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }