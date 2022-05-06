<?php
  class License_Certificate {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getLC(){
      $this->db->query('SELECT *
                        FROM license_certificates
                        ORDER BY license_certificates_key DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addFile($data, $arr, $i, $var){

      if($var == 'add') {
      // This section is for adding a new collection e.g. no key defined yet
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'apleona_waste' AND   TABLE_NAME   = 'license_certificates';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $this->db->query('INSERT INTO license_certificates_files (license_certificates_key, file_name) VALUES(:license_certificates_key, :file_name)');
      // Bind values
      $this->db->bind(':license_certificates_key', current($row));
      $this->db->bind(':file_name', $arr[$i]);

      } else {
        // This is for updating an existing collection e.g. key is already defined
        $this->db->query('INSERT INTO license_certificates_files (license_certificates_key, file_name) VALUES(:license_certificates_key, :file_name)');
        // Bind values
        $this->db->bind(':license_certificates_key', $data['license_certificates_key']);
        $this->db->bind(':file_name', $arr[$i]);

      }

          // Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }

    public function addLC($data){
    if (isset($_POST['submit'])) {

      $countfiles = count($_FILES['file']['name']);
      $values = "";
      // Looping all files
      for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['file']['name'][$i];
        $values != "" && $values .= ",";
        $values .= $filename;
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/License_Certificates/files/' . $filename);
      }
      $LCVendor = $_POST['license_certificates_vendor'];
      $LCDate = $_POST['license_certificates_date'];
      $LCType = $_POST['license_certificates_type'];
      $LCCustomer = $_POST['license_certificates_customer'];
      $LCOwner = $_POST['license_certificates_owner'];
      $LCCountry = $_POST['license_certificates_country'];

      $this->db->query("INSERT INTO license_certificates
        (license_certificates_vendor, license_certificates_date, license_certificates_type, license_certificates_docs, license_certificates_customer, license_certificates_owner, license_certificates_country) 
        VALUES ('$LCVendor', '$LCDate', '$LCType', '$values', '$LCCustomer', '$LCOwner', '$LCCountry')");
      $this->db->bind('$LCVendor', $data['license_certificates_vendor']);
      $this->db->bind('$LCDate', $data['license_certificates_date']);
      $this->db->bind('$LCType', $data['license_certificates_type']);
      $this->db->bind('$values', $data['license_certificates_docs']);
      $this->db->bind('$LCCustomer', $data['license_certificates_customer']);
      $this->db->bind('$LCOwner', $data['license_certificates_owner']);
      $this->db->bind('$LCCountry', $data['license_certificates_country']);
    }

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateLC($data){
      if(isset($_POST['submit'])){
      // Count total files
      if (empty($_FILES['file']['name'][0])){

          $LCKey = $_POST['license_certificates_key'];
          $LCVendor = $_POST['license_certificates_vendor'];
          $LCDate = $_POST['license_certificates_date'];
          $LCType = $_POST['license_certificates_type'];
          $LCDocs = $data['license_certificates_docs'];
          $LCCustomer = $_POST['license_certificates_customer'];
          $LCOwner = $_POST['license_certificates_owner'];
  
          $this->db->query("UPDATE license_certificates SET
          license_certificates_vendor = '$LCVendor', license_certificates_date = '$LCDate', license_certificates_type = '$LCType', license_certificates_docs = ':license_certificates_docs', license_certificates_customer = '$LCCustomer', license_certificates_owner = '$LCOwner'
          WHERE license_certificates_key = '$LCKey'");
          $this->db->bind('$LCKey', $data['license_certificates_key']);
          $this->db->bind('$LCVendor', $data['license_certificates_vendor']);
          $this->db->bind('$LCDate', $data['license_certificates_date']);
          $this->db->bind('$LCType', $data['license_certificates_type']);
          $this->db->bind(':license_certificates_docs', $data['license_certificates_docs']);
          $this->db->bind('$LCCustomer', $data['license_certificates_customer']);
          $this->db->bind('$LCOwner', $data['license_certificates_owner']);

      } else {

          $countfiles = count($_FILES['file']['name']);
          $values = "";
          // Looping all files
          for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $values != "" && $values .= ",";
            $values .= $filename;
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/License_Certificates/files/'.$filename);
          } 
            $LCKey = $_POST['license_certificates_key'];
            $LCVendor = $_POST['license_certificates_vendor'];
            $LCDate = $_POST['license_certificates_date'];
            $LCType = $_POST['license_certificates_type'];
            $LCCustomer = $_POST['license_certificates_customer'];
            $LCOwner = $_POST['license_certificates_owner'];
    
            $this->db->query("UPDATE license_certificates SET
            license_certificates_vendor = '$LCVendor', license_certificates_date = '$LCDate', license_certificates_type = '$LCType', license_certificates_docs = '$values', license_certificates_customer = '$LCCustomer', license_certificates_owner = '$LCOwner' 
            WHERE license_certificates_key = '$LCKey'");
            $this->db->bind('$LCKey', $data['license_certificates_key']);
            $this->db->bind('$LCVendor', $data['license_certificates_vendor']);
            $this->db->bind('$LCDate', $data['license_certificates_date']);
            $this->db->bind('$LCType', $data['license_certificates_type']);
            $this->db->bind('$values', $data['license_certificates_docs']);
            $this->db->bind('$LCCustomer', $data['license_certificates_customer']);
            $this->db->bind('$LCOwner', $data['license_certificates_owner']);

      }

        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
        
    }
  }

  public function downloadLC(){
    if(!empty($_GET['file'])){
      $filename  = basename($_GET['file']);
      $filePath = APPROOT . '/views/License_Certificates/files/'.$filename;
      
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

  public function deleteLC($data)
  {
    // if (!empty($_GET['file'])) {
    // $filename  = basename($_GET['file']);
    // $LCKey = $_GET['key'];
    // $str_arr = explode (",", $filename);
    // foreach ($str_arr as $value) {
    //  $filePath = APPROOT . '/views/License_Certificates/files/' . $value;
    //   unlink($filePath);
    // }
    $filePath = APPROOT . '/views/License_Certificates/files/' . $data['file_name'];
    unlink($filePath);
    //$this->db->query("UPDATE license_certificates SET license_certificates_docs = '' WHERE license_certificates_key = '".$LCKey."'");
    $this->db->query("DELETE FROM license_certificates_files WHERE license_certificates_key = '".$data['license_certificates_key']."' AND file_name = '".$data['file_name']."'");

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getLCById($license_certificates_key){
      $this->db->query('SELECT * FROM license_certificates WHERE license_certificates_key = :license_certificates_key');
      $this->db->bind(':license_certificates_key', $license_certificates_key);

      $row = $this->db->single();

      return $row;
    }
}