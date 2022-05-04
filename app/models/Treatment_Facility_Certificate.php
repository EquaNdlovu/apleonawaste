<?php
  class Treatment_Facility_Certificate {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTFC(){
      $this->db->query('SELECT *
                        FROM treatment_facility_certificates
                        ORDER BY treatment_facility_certificates_key DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addFile($data, $arr, $i, $var){

      if($var == 'add') {
      // This section is for adding a new collection e.g. no key defined yet
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'apleona_waste' AND   TABLE_NAME   = 'treatment_facility_certificates';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $this->db->query('INSERT INTO tfc_docs (treatment_facility_certificates_key, file_name) VALUES(:treatment_facility_certificates_key, :file_name)');
      // Bind values
      $this->db->bind(':treatment_facility_certificates_key', current($row));
      $this->db->bind(':file_name', $arr[$i]);

      } else {
        // This is for updating an existing collection e.g. key is already defined
        $this->db->query('INSERT INTO tfc_docs (treatment_facility_certificates_key, file_name) VALUES(:treatment_facility_certificates_key, :file_name)');
        // Bind values
        $this->db->bind(':treatment_facility_certificates_key', $data['treatment_facility_certificates_key']);
        $this->db->bind(':file_name', $arr[$i]);

      }


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function addTFC($data){
    if (isset($_POST['submit'])) {

      $this->db->query("INSERT INTO treatment_facility_certificates
      (treatment_facility_certificates_facility_key, treatment_facility_certificates_date, treatment_facility_certificates_docs, treatment_facility_certificates_customer, treatment_facility_certificates_owner, treatment_facility_certificates_country) 
      VALUES (:treatment_facility_certificates_facility_key, :treatment_facility_certificates_date, :treatment_facility_certificates_docs, :treatment_facility_certificates_customer, :treatment_facility_certificates_owner, :treatment_facility_certificates_country)");
      $this->db->bind(':treatment_facility_certificates_facility_key', $data['treatment_facility_certificates_facility_key']);
      $this->db->bind(':treatment_facility_certificates_date', $data['treatment_facility_certificates_date']);
      $this->db->bind(':treatment_facility_certificates_docs', $data['treatment_facility_certificates_docs']);
      $this->db->bind(':treatment_facility_certificates_customer', $data['treatment_facility_certificates_customer']);
      $this->db->bind(':treatment_facility_certificates_owner', $data['treatment_facility_certificates_owner']);
      $this->db->bind(':treatment_facility_certificates_country', $data['treatment_facility_certificates_country']);
    }

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateTFC($data){
      if(isset($_POST['submit'])){
      // Count total files
      if (empty($_FILES['file']['name'][0])){

          $TFCKey = $_POST['treatment_facility_certificates_key'];
          $TFCFacilityKey = $_POST['treatment_facility_certificates_facility_key'];
          $TFCDate = $_POST['treatment_facility_certificates_date'];
          $TFCDocs = $data['treatment_facility_certificates_docs'];
  
          $this->db->query("UPDATE treatment_facility_certificates SET
          treatment_facility_certificates_facility_key = '$TFCFacilityKey', treatment_facility_certificates_date = '$TFCDate', treatment_facility_certificates_docs = '$TFCDocs'
          WHERE treatment_facility_certificates_key = '$TFCKey'");
          $this->db->bind('$TFCKey', $data['treatment_facility_certificates_key']);
          $this->db->bind('$TFCFacilityKey', $data['treatment_facility_certificates_facility_key']);
          $this->db->bind('$TFCDate', $data['treatment_facility_certificates_date']);
          $this->db->bind('$TFCDocs', $data['treatment_facility_certificates_docs']);

      } else {

          $countfiles = count($_FILES['file']['name']);
          $values = "";
          // Looping all files
          for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $values != "" && $values .= ",";
            $values .= $filename;
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/treatment_facility_certificates/files/'.$filename);
          } 
            //$fileName = $_FILES['file']['name'];
            //$filename = $_FILES['file']['name'][$i];
            //$fileTmpName = $_FILES['file']['tmp_name'];
            //$path = APPROOT . '/views/WTF_Docs/files/'.$fileName;
            //move_uploaded_file($fileTmpName,$path);
            $TFCKey = $_POST['treatment_facility_certificates_key'];
            $TFCFacilityKey = $_POST['treatment_facility_certificates_facility_key'];
            $TFCDate = $_POST['treatment_facility_certificates_date'];
    
            $this->db->query("UPDATE treatment_facility_certificates SET
            treatment_facility_certificates_facility_key = '$TFCFacilityKey', treatment_facility_certificates_date = '$TFCDate', treatment_facility_certificates_docs = '$values' 
            WHERE treatment_facility_certificates_key = '$TFCKey'");
            $this->db->bind('$TFCKey', $data['treatment_facility_certificates_key']);
            $this->db->bind('$TFCFacilityKey', $data['treatment_facility_certificates_facility_key']);
            $this->db->bind('$TFCDate', $data['treatment_facility_certificates_date']);
            $this->db->bind('$values', $data['treatment_facility_certificates_docs']);

      }

        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
        
    }
  }

  public function downloadTFC(){
    if(!empty($_GET['file'])){
      $filename  = basename($_GET['file']);
      $filePath = APPROOT . '/views/treatment_facility_certificates/files/'.$filename;
      
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

  public function deleteTFC($data)
  {
    // if (!empty($_GET['file'])) {
    // $filename  = basename($_GET['file']);
    // $TFCKey = $_GET['key'];
    // $str_arr = explode (",", $filename);
    // foreach ($str_arr as $value) {
    //  $filePath = APPROOT . '/views/treatment_facility_certificates/files/' . $value;
    //   unlink($filePath);
    // }
    $filePath = APPROOT . '/views/treatment_facility_certificates/files/' . $data['file_name'];
    unlink($filePath);
    //$this->db->query("UPDATE treatment_facility_certificates SET treatment_facility_certificates_docs = '' WHERE treatment_facility_certificates_key = '".$TFCKey."'");
    $this->db->query("DELETE FROM tfc_docs WHERE treatment_facility_certificates_key = '".$data['treatment_facility_certificates_key']."' AND file_name = '".$data['file_name']."'");
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    //}
  }

    public function getTFCById($treatment_facility_certificates_key){
      $this->db->query('SELECT * FROM treatment_facility_certificates WHERE treatment_facility_certificates_key = :treatment_facility_certificates_key');
      $this->db->bind(':treatment_facility_certificates_key', $treatment_facility_certificates_key);

      $row = $this->db->single();

      return $row;
    }
}