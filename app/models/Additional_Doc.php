<?php
  class Additional_Doc {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAD(){
      $this->db->query('SELECT *
                        FROM additional_docs
                        ORDER BY additional_docs_key DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addFile($data, $arr, $i, $var){

      if($var == 'add') {
      // This section is for adding a new file e.g. no key defined yet
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'apleona_waste' AND   TABLE_NAME   = 'additional_docs';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $this->db->query('INSERT INTO additional_docs_files (additional_docs_key, file_name) VALUES(:additional_docs_key, :file_name)');
      // Bind values
      $this->db->bind(':additional_docs_key', current($row));
      $this->db->bind(':file_name', $arr[$i]);

      } else {
        // This is for updating an existing collection e.g. key is already defined
        $this->db->query('INSERT INTO additional_docs_files (additional_docs_key, file_name) VALUES(:additional_docs_key, :file_name)');
        // Bind values
        $this->db->bind(':additional_docs_key', $data['additional_docs_key']);
        $this->db->bind(':file_name', $arr[$i]);

      }

          // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }

    public function addAD($data){
    if (isset($_POST['submit'])) {

      $this->db->query("INSERT INTO additional_docs
        (additional_docs_type, additional_docs_comments, additional_docs_customer, additional_docs_country, additional_docs_files) 
        VALUES (:additional_docs_type, :additional_docs_comments, :additional_docs_customer, :additional_docs_country, :additional_docs_files)");
      $this->db->bind(':additional_docs_type', $data['additional_docs_type']);
      $this->db->bind(':additional_docs_comments', $data['additional_docs_comments']);
      $this->db->bind(':additional_docs_customer', $data['additional_docs_customer']);
      $this->db->bind(':additional_docs_country', $data['additional_docs_country']);
      $this->db->bind(':additional_docs_files', $data['additional_docs_files']);
    }

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateAD($data){
      if(isset($_POST['submit'])){
  
          $this->db->query("UPDATE additional_docs SET
          additional_docs_type = :additional_docs_type, additional_docs_comments = :additional_docs_comments, additional_docs_customer = :additional_docs_customer, additional_docs_country = :additional_docs_country, additional_docs_files = :additional_docs_files
          WHERE additional_docs_key = :additional_docs_key");
          $this->db->bind(':additional_docs_key', $data['additional_docs_key']);
          $this->db->bind(':additional_docs_type', $data['additional_docs_type']);
          $this->db->bind(':additional_docs_comments', $data['additional_docs_comments']);
          $this->db->bind(':additional_docs_customer', $data['additional_docs_customer']);
          $this->db->bind(':additional_docs_country', $data[':additional_docs_country']);
          $this->db->bind(':additional_docs_files', $data['additional_docs_files']);

        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
        
    }
  }

  public function downloadAD(){
    if(!empty($_GET['file'])){
      $filename  = basename($_GET['file']);
      $filePath = APPROOT . '/views/Additional_Docs/files/'.$filename;
      
      if(!empty($filename) && file_exists($filePath)){
          //define header
          header("Cache-Control: public");
          header("Content-Description: File Transfer");
          header("Content-Disposition: attachment; filename=$filename");
          header("Content-Type: application/zip");
          header("Content-Transfer-Encoding: binary");

          ob_clean();
          flush();
          
          //read file 
          readfile($filePath);
          exit;
      }
      else{
          echo "file not exit";
      }
  }
}

  public function deleteAD($data)
  {

    $filePath = APPROOT . '/views/Additional_Docs/files/' . $data['file_name'];
    unlink($filePath);
    //$this->db->query("UPDATE license_certificates SET license_certificates_docs = '' WHERE license_certificates_key = '".$LCKey."'");
    $this->db->query("DELETE FROM additional_docs_files WHERE additional_docs_key = '".$data['additional_docs_key']."' AND file_name = '".$data['file_name']."'");

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getADById($additional_docs_key){
      $this->db->query('SELECT * FROM additional_docs WHERE additional_docs_key = :additional_docs_key');
      $this->db->bind(':additional_docs_key', $additional_docs_key);

      $row = $this->db->single();

      return $row;
    }
}