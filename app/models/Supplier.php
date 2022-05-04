<?php
  class Supplier {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getSuppliers(){
      $this->db->query('SELECT *
                        FROM suppliers
                        ORDER BY supplier_name ASC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addSupplier($data){
      $this->db->query('INSERT INTO suppliers 
                    (supplier_name, supplier_address, supplier_contact_name, supplier_contact_number, supplier_contact_email) 
                    VALUES(:supplier_name, :supplier_address, :supplier_contact_name, :supplier_contact_number, :supplier_contact_email)');
      // Bind values
      $this->db->bind(':supplier_name', $data['supplier_name']);
      $this->db->bind(':supplier_address', $data['supplier_address']);
      $this->db->bind(':supplier_contact_name', $data['supplier_contact_name']);
      $this->db->bind(':supplier_contact_number', $data['supplier_contact_number']);
      $this->db->bind(':supplier_contact_email', $data['supplier_contact_email']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateSupplier($data){
      $this->db->query('UPDATE suppliers SET 
                        supplier_name = :supplier_name, supplier_address = :supplier_address, supplier_contact_name = :supplier_contact_name, supplier_contact_number = :supplier_contact_number, supplier_contact_email = :supplier_contact_email
                        WHERE supplier_key = :supplier_key');
      // Bind values
      $this->db->bind(':supplier_key', $data['supplier_key']);
      $this->db->bind(':supplier_name', $data['supplier_name']);
      $this->db->bind(':supplier_address', $data['supplier_address']);
      $this->db->bind(':supplier_contact_name', $data['supplier_contact_name']);
      $this->db->bind(':supplier_contact_number', $data['supplier_contact_number']);
      $this->db->bind(':supplier_contact_email', $data['supplier_contact_email']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getSupplierById($supplier_key){
      $this->db->query('SELECT * FROM suppliers WHERE supplier_key = :supplier_key');
      $this->db->bind(':supplier_key', $supplier_key);

      $row = $this->db->single();

      return $row;
    }

    public function deleteSupplier($supplier_key){
      $this->db->query('DELETE FROM suppliers WHERE supplier_key = :supplier_key');
      // Bind values
      $this->db->bind(':supplier_key', $supplier_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }